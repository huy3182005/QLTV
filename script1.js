function theloai() {
      const dropdown = document.getElementById("menuan");
      dropdown.style.display = dropdown.style.display === "grid" ? "none" : "grid";
    }



    input.addEventListener("input", function() {
      const query = this.value.toLowerCase();
      results.innerHTML = "";
      if (query) {
        const filtered = data.filter(item => item.toLowerCase().includes(query));
        filtered.forEach(item => {
          const div = document.createElement("div");
          div.textContent = item;
          div.onclick = () => alert("Chuyển đến trang: " + item);
          results.appendChild(div);
        });
        results.style.display = "flex";
      } else {
        results.style.display = "none";
      }
    });

    // Ẩn dropdown khi click ra ngoài
    window.onclick = function(event) {
      if (!event.target.matches('.menu-an-btn')) {
        document.getElementById("dropdownContent").style.display = "none";
      }
    }