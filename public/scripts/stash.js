document.addEventListener('DOMContentLoaded', () => {
  const sumGoldEl = document.getElementById('sum-gold');
  const sumTracksEl = document.getElementById('sum-tracks');
  const itemsBody = document.getElementById('items-summary-body');
  const btnRars = document.getElementById('show-rars');
  const btnSyngs = document.getElementById('show-syngs');
  const btnDrifs = document.getElementById('show-drifs');
  const modalContainer = document.getElementById('modal-container');


  let selectedBoss = null;
  let selectedCharacter = null;

 
  function escapeHtml(s) {
    return ('' + s).replace(/[&<>"']/g, c => ({
      '&': '&amp;',
      '<': '&lt;',
      '>': '&gt;',
      '"': '&quot;',
      "'": '&#39;'
    }[c]));
  }

  function showModal(title, rowsHtml) {
    const modalHtml = `
      <div class="modal-overlay">
        <div class="modal">
          <button class="modal-close">&times;</button>
          <h3>${escapeHtml(title)}</h3>
          <div class="modal-body">${rowsHtml}</div>
        </div>
      </div>`;
    modalContainer.innerHTML = modalHtml;
    modalContainer.querySelector('.modal-close').addEventListener('click', () => modalContainer.innerHTML = '');
  }


  async function fetchStats() {
    if (!selectedBoss || !selectedCharacter) return;

    const payload = {
      boss_id: selectedBoss.boss_id ?? selectedBoss.id ?? null,
      character_id: selectedCharacter.id ?? selectedCharacter.character_id ?? null,
      difficulty: selectedBoss.difficulty ?? null
    };

    try {
      const res = await fetch('/get_boss_stats', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        credentials: 'same-origin',
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (data.status !== 'ok') return console.error('Błąd pobierania statystyk:', data.msg);

      // wyświetl złoto i tropy
      sumGoldEl.textContent = data.gold;
      sumTracksEl.textContent = data.tracks_total;

      // items
      itemsBody.innerHTML = '';
      (data.items || []).forEach(it => {
        const tr = document.createElement('tr');
        tr.innerHTML = `<td>${escapeHtml(it.name)}</td><td>${it.total}</td>`;
        itemsBody.appendChild(tr);
      });

      // zapisz dane do modali
      modalContainer.dataset.rars = JSON.stringify(data.rars || []);
      modalContainer.dataset.syngs = JSON.stringify(data.syngs || []);
      modalContainer.dataset.drifs = JSON.stringify(data.drifs || []);

    } catch (err) {
      console.error('Fetch error', err);
    }
  }

  // --- aktualizacja wyboru i fetch ---
  function updateSelectionAndFetch() {
    // pobierz zaznaczoną postać
    const charEl = document.querySelector('.card2.selected');
    selectedCharacter = charEl ? {
      id: parseInt(charEl.dataset.id),
      nickname: charEl.dataset.nickname,
      profession: charEl.dataset.profession,
      level: charEl.dataset.level,
      server: charEl.dataset.server
    } : null;

    // pobierz zaznaczonego bossa
    const bossEl = document.querySelector('.difficulty-icons img.selected');
    selectedBoss = bossEl ? {
      boss_id: parseInt(bossEl.dataset.boss_id),
      boss: bossEl.dataset.boss,
      difficulty: bossEl.dataset.difficulty,
      difficulty_img: bossEl.dataset.difficultyImg
    } : null;

    fetchStats();
  }

  // --- obsługa kliknięcia postaci ---
  document.querySelectorAll('.card2').forEach(card => {
    card.addEventListener('click', () => {
      document.querySelectorAll('.card2').forEach(c => c.classList.remove('selected'));
      card.classList.add('selected');
      updateSelectionAndFetch();
    });
  });

  // --- obsługa kliknięcia bossa ---
  document.querySelectorAll('.difficulty-icons img').forEach(img => {
    img.addEventListener('click', () => {
      // usuń zaznaczenie wszystkich bossów na stronie
      document.querySelectorAll('.difficulty-icons img').forEach(i => i.classList.remove('selected'));
      // zaznacz kliknięty
      img.classList.add('selected');
      updateSelectionAndFetch();
    });
  });

  // --- modale ---
  btnRars?.addEventListener('click', () => {
    const rars = JSON.parse(modalContainer.dataset.rars || '[]');
    const rows = rars.map(r => `<p>${escapeHtml(r.name)} — ilość: ${r.total || 0}</p>`).join('');
    showModal('Rary', rows || '<p>Brak</p>');
  });

  btnSyngs?.addEventListener('click', () => {
    const syngs = JSON.parse(modalContainer.dataset.syngs || '[]');
    const rows = syngs.map(s => `<p>Tier ${s.quality} — ilość: ${s.total || 0}</p>`).join('');
    showModal('Synergetyki', rows || '<p>Brak</p>');
  });

  btnDrifs?.addEventListener('click', () => {
    const drifs = JSON.parse(modalContainer.dataset.drifs || '[]');
    const rows = drifs.map(d => `<p>${escapeHtml(d.name)} — ilość: ${d.total || 0}</p>`).join('');
    showModal('Drify', rows || '<p>Brak</p>');
  });

  
  updateSelectionAndFetch();
});
