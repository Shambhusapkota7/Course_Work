document.addEventListener("DOMContentLoaded", () => {

    const searchInput = document.getElementById("search");
    const resultBox   = document.getElementById("result");

    if (!searchInput || !resultBox) return;

    // Live search
    searchInput.addEventListener("keyup", () => {

        const query = searchInput.value.trim();
        if (query === "") {
            resultBox.innerHTML = "";
            return;
        }

        fetch("../ajax/search_autocomplete.php?q=" + encodeURIComponent(query))
            .then(res => res.text())
            .then(html => {
                resultBox.innerHTML = html;
            })
            .catch(() => {
                resultBox.innerHTML = "";
            });
    });

    // Click result
    resultBox.addEventListener("click", e => {
        if (e.target.classList.contains("search-item")) {
            window.location.href =
                "search.php?q=" +
                encodeURIComponent(e.target.dataset.name) +
                "&search=1";
        }
    });
});
