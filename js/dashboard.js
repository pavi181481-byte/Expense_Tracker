const search = document.getElementById("search");
const category = document.getElementById("category");
const table = document.getElementById("transactionTable");

function filterTransactions() {

    const searchText = search.value.toLowerCase();
    const selectedCategory = category.value;

    const rows = table.getElementsByTagName("tr");

    for (let i = 1; i < rows.length; i++) {

        const rowText = rows[i].innerText.toLowerCase();
        const rowCategory = rows[i].cells[1].innerText;

        const matchesSearch = rowText.includes(searchText);

        const matchesCategory =
            selectedCategory === "all" ||
            rowCategory === selectedCategory;

        if (matchesSearch && matchesCategory) {
            rows[i].style.display = "";
        } else {
            rows[i].style.display = "none";
        }
    }
}

search.addEventListener("keyup", filterTransactions);
category.addEventListener("change", filterTransactions);