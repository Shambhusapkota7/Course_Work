document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search");
    const resultBox = document.getElementById("result");

    if (!searchInput || !resultBox) return;

    // Live typing search
    searchInput.addEventListener("keyup", () => {
        const query = searchInput.value.trim();

        if (query === "") {
            resultBox.innerHTML = "";
            return;
        }

        fetch("../ajax/search_autocomplete.php?q=" + encodeURIComponent(query))
            .then(res => res.text())
            .then(data => {
                resultBox.innerHTML = data;
            });
    });

    // ✅ CLICK RESULT → REDIRECT WITH FILTER
    resultBox.addEventListener("click", (e) => {
        if (e.target.classList.contains("search-item")) {
            const eventName = e.target.dataset.name;
            if (!eventName) return;

            window.location.href =
                "search.php?q=" + encodeURIComponent(eventName) + "&search=1";
        }
    });
});
