document.addEventListener("DOMContentLoaded", () => {
    const difficultyIcons = document.querySelectorAll(".difficulty-icons img");
    const bossSelect = document.querySelector(".boss-select");

    difficultyIcons.forEach(icon => {
        icon.addEventListener("click", () => {
            const bossName = icon.dataset.boss;
            const difficulty = icon.dataset.difficulty;
            const difficultyImg = icon.dataset.difficultyImg;

            // znajdź obrazek bossa w tej samej karcie
            const bossCard = icon.closest(".boss-card");
            const bossImg = bossCard.querySelector("img").src;

            // nadpisz zawartość sekcji wyboru
            bossSelect.innerHTML = `
                <img src="${bossImg}" alt="boss">
                <p>${bossName}</p>
                <img src="${difficultyImg}" alt="${difficulty}">
            `;

            // zapisz wybór w localStorage (żeby móc użyć w looting.php)
            localStorage.setItem("selectedBoss", JSON.stringify({
                boss: bossName,
                difficulty: difficulty,
                bossImg: bossImg,
                difficultyImg: difficultyImg
            }));
        });
    });
});
