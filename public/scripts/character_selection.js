document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.card2').forEach(card => {
        card.addEventListener('click', () => {
            const selectedCharacter = {
                id: card.dataset.id,
                nickname: card.dataset.nickname,
                profession: card.dataset.profession,
                level: card.dataset.level,
                server: card.dataset.server
            };

            // Wyświetlenie w podglądzie
            const select = document.querySelector('.card-select');
            select.innerHTML = `
                <p>${selectedCharacter.nickname}</p>
                <p>${selectedCharacter.profession}</p>
                <p>${selectedCharacter.level}</p>
                <p>${selectedCharacter.server}</p>
            `;

            // Wyślij dane do save_selection.php razem z obecnym wybranym bossem (jeśli istnieje)
            const boss = window.selectedBoss || null;
            fetch("/public/save_selection.php", {
                method: "POST",
                headers: {"Content-Type": "application/json"},
                credentials: "same-origin",
                body: JSON.stringify({character: selectedCharacter, boss})
            })
            .then(res => res.json())
            .then(data => {
                console.log("Save selection response:", data);
            });
            
            // Zachowaj lokalnie na wypadek użycia w innym miejscu
            window.selectedCharacter = selectedCharacter;
        });
    });
});
