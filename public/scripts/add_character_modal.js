document.addEventListener("DOMContentLoaded", () => {
    const openBtn = document.getElementById("openAddCharacterModal");
    const modal = document.getElementById("character-modal");

    // otwarcie modala
    openBtn.addEventListener("click", () => {
        modal.classList.add("show");
    });

    // zamknięcie modala po kliknięciu w tło
    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("show");
        }
    });

    // obsługa wysyłki formularza przez fetch
    const form = document.getElementById("add-character-form");
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        const response = await fetch("add_character_post", {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            alert("Postać dodana!");
            modal.classList.remove("show");
            window.location.reload();
        } else {
            alert(data.message || "Błąd przy dodawaniu postaci");
        }
    });
});
