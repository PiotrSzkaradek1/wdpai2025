document.addEventListener("DOMContentLoaded", () => {
    const section = document.getElementById("looting-info");

    const bossData = localStorage.getItem("selectedBoss");
    const charData = localStorage.getItem("selectedCharacter");

    if (!bossData || !charData) {
        section.innerHTML = "<p>Brak wybranych danych. Wróć do wyboru bossa i postaci.</p>";
        return;
    }

    const boss = JSON.parse(bossData);
    const character = JSON.parse(charData);

    section.innerHTML = `
        <h3 class="extra-title">Twój wybór:</h3>
        <div class="boss-select">
            <img src="${boss.bossImg}" alt="${boss.boss}">
            <p>${boss.boss}</p>
            <img src="${boss.difficultyImg}" alt="${boss.difficulty}">
        </div>
        <div class="card-select">
            <p>${character.nickname}</p>
            <p>${character.profession}</p>
            <p>${character.level}</p>
            <p>${character.server}</p>
        </div>
    `;
});
