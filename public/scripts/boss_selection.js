document.addEventListener("DOMContentLoaded", () => {
    const difficultyIcons = document.querySelectorAll(".difficulty-icons img");
    const bossSelect = document.querySelector(".boss-select");

    difficultyIcons.forEach(icon => {
        icon.addEventListener("click", () => {
            const selectedBoss = {
                id: icon.dataset.boss_id,
                boss: icon.dataset.boss,
                difficulty: icon.dataset.difficulty,
                bossImg: icon.closest(".boss-card").querySelector("img").src,
                difficultyImg: icon.dataset.difficultyImg
            };

            // Wyświetlenie w podglądzie
            bossSelect.innerHTML = `
                <img src="${selectedBoss.bossImg}" alt="${selectedBoss.boss}">
                <p>${selectedBoss.boss}</p>
                <img src="${selectedBoss.difficultyImg}" alt="${selectedBoss.difficulty}">
            `;

            // Wyślij dane do save_selection.php razem z obecnie wybraną postacią (jeśli istnieje)
            const character = window.selectedCharacter || null;
            fetch("/public/save_selection.php", {
                method: "POST",
                headers: {"Content-Type": "application/json"},
                credentials: "same-origin",
                body: JSON.stringify({character, boss: selectedBoss})
            })
            .then(res => res.json())
            .then(data => {
                console.log("Save selection response:", data);
            });

            // Zachowaj lokalnie na wypadek użycia w innym miejscu
            window.selectedBoss = selectedBoss;
        });
    });
});
