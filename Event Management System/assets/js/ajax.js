document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search");
    const resultBox = document.getElementById("result");

    if (!searchInput || !resultBox) return;

    searchInput.addEventListener("keyup", () => {
        const query = searchInput.value.trim();

        if (query === "") {
            resultBox.innerHTML = "";
            return;
        }

        // ✅ correct path (from /public/)
        fetch("../ajax/search_autocomplete.php?q=" + encodeURIComponent(query))
            .then(res => res.text())
            .then(data => {
                resultBox.innerHTML = data;
            })
            .catch(() => {
                resultBox.innerHTML = "";
            });
    });

    resultBox.addEventListener("click", (e) => {
        if (e.target.classList.contains("search-item")) {
            const eventName = e.target.dataset.name;
            window.location.href =
                "search.php?q=" + encodeURIComponent(eventName) + "&search=1";
        }
    });
});
