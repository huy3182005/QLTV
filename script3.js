document.getElementById('tim-kiem').addEventListener('keyup', function() {
    let query = this.value.trim();
    if (query.length < 2) {
        document.getElementById('tim-kiem-kq').innerHTML = "";
        return;
    }

    fetch("search.php?q=" + encodeURIComponent(query))
        .then(response => response.text())
        .then(data => {
            document.getElementById('tim-kiem-kq').innerHTML = data;
        });
});
