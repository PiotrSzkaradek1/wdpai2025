document.addEventListener("DOMContentLoaded", () => {
    const cart = [];
    const lootCartEl = document.getElementById("loot-cart");

    function renderCart() {
        lootCartEl.innerHTML = "";
        cart.forEach((entry, index) => {
            const li = document.createElement("li");
            li.textContent = entry.label;

            const btn = document.createElement("button");
            btn.type = "button";
            btn.textContent = "Usuń";
            btn.onclick = () => {
                cart.splice(index, 1);
                renderCart();
            };

            li.appendChild(btn);
            lootCartEl.appendChild(li);
        });
    }

    // Dodawanie Rara
    document.getElementById("addRar").addEventListener("click", () => {
        const rarId = document.getElementById("rarSelect").value;
        const rarName = document.getElementById("rarSelect").selectedOptions[0]?.text;
        const quality = document.getElementById("rarQuality").value;
        if (rarId) {
            cart.push({type: "rar", id: rarId, quality, label: `${rarName} (jakość ${quality})`});
            renderCart();
        }
    });

    // Dodawanie Synergetyka
    document.getElementById("addSyng").addEventListener("click", () => {
        const quality = document.getElementById("syngQuality").value;
        cart.push({type: "syng", quality, label: `Synergetyk (jakość ${quality})`});
        renderCart();
    });

    // Dodawanie Drifa
    document.getElementById("addDrif").addEventListener("click", () => {
        const drifId = document.getElementById("drifType").value;
        const drifName = document.getElementById("drifType").selectedOptions[0]?.text;
        const tier = document.getElementById("drifTier").value;
        if (drifId) {
            cart.push({type: "drif", id: drifId, tier, label: `${drifName} (tier ${tier})`});
            renderCart();
        }
    });

    // Zapis loot
    document.getElementById("lootForm").addEventListener("submit", (e) => {
        e.preventDefault();

        const gold = parseInt(document.querySelector('[name="gold"]').value, 10) || 0;
        const tracks = {1: parseInt(document.querySelector('[name="tracks"]').value, 10) || 0};


        // Itemy
        const items = {};
        document.querySelectorAll('[name^="items"]').forEach(input => {
            const idMatch = input.name.match(/\d+/);
            if (!idMatch) return;
            items[idMatch[0]] = parseInt(input.value, 10) || 0;
        });

        // Rary, syngi, drify z koszyka
        const rars = [];
        const syngs = [];
        const drifs = [];

        cart.forEach(entry => {
            if (entry.type === "rar") rars.push({id: entry.id, quality: entry.quality});
            if (entry.type === "syng") syngs.push({quality: entry.quality});
            if (entry.type === "drif") drifs.push({id: entry.id, tier: entry.tier});
        });

        const payload = { gold, tracks, items, rars, syngs, drifs };

        fetch("/save_loot", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(payload),
            credentials: "same-origin"
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === "ok") {
                alert("Loot zapisany!");
                cart.length = 0;
                renderCart();
            } else {
                alert("Błąd zapisu: " + (data.msg || "Nieznany błąd"));
            }
        })
        .catch(err => console.error("Błąd fetch:", err));
    });
});
