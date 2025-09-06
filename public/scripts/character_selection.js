document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.card2').forEach(card => {
        card.addEventListener('click', () => {
            const select = document.querySelector('.card-select');
            select.innerHTML = `
                <p>${card.dataset.nickname}</p>
                <p>${card.dataset.profession}</p>
                <p>${card.dataset.level}</p>
                <p>${card.dataset.server}</p>
            `;
        });
    });
});
