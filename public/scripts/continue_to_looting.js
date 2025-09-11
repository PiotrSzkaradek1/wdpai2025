document.addEventListener("DOMContentLoaded", () => {
    const goBtn = document.getElementById("goToLooting");
    if (!goBtn) return;

    goBtn.addEventListener("click", () => {
        // Używamy danych z window.selectedCharacter i window.selectedBoss
        const character = window.selectedCharacter || null;
        const boss = window.selectedBoss || null;

        if (!character || !boss) {
            alert("Musisz wybrać postać oraz bossa z poziomem trudności!");
            return;
        }

        fetch("/public/save_selection.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            credentials: "same-origin",
            body: JSON.stringify({character, boss})
        })
        .then(r => r.json())
        .then(data => {
            if (data.status === "ok") {
                window.location.href = "looting";
            } else {
                alert("Błąd zapisu do sesji");
            }
        });
    });
});
