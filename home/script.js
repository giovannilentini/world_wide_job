const body = document.querySelector("body"),
      sidebar = document.querySelector(".sidebar"),
      toggle = document.querySelector(".toggle"),
      searchBtn = document.querySelector(".search-box"),
      modeSwitch = document.querySelector(".toggle-switch"),
      modeText = document.querySelector(".mode-text");

    toggle.addEventListener("click", (e) => {
        sidebar.classList.toggle("close");
    });

    searchBtn.addEventListener("click", (e) => {
        sidebar.classList.remove("close");
    });

    modeSwitch.addEventListener("click", (e) => {
        body.classList.toggle("dark");

        if(body.classList.contains("dark")) {
            modeText.innerText = "Light Mode";
        } else {
            modeText.innerText = "Dark Mode";
        }
    });