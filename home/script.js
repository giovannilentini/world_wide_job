const body = document.querySelector("body"),
      sidebar = document.querySelector(".sidebar"),
      searchBtn = document.querySelector(".search-box"),
      modeSwitch = document.querySelector(".toggle-switch"),
      modeText = document.querySelector(".mode-text"),
      mobile_toggle = document.querySelector(".mobile-toggle");

const hideSidebar = () => {
    sidebar.classList.add("close");
}
const showSidebar = () => {
    sidebar.classList.remove("close");
}

mobile_toggle.addEventListener("click", (e) => {
    if (sidebar.classList.contains("close")) {
        sidebar.classList.remove("close");
    } else {
        sidebar.classList.add("close");
    }
});

sidebar.addEventListener("mouseleave", hideSidebar);
sidebar.addEventListener("mouseenter", showSidebar);

    modeSwitch.addEventListener("click", (e) => {
        body.classList.toggle("dark");

        if(body.classList.contains("dark")) {
            modeText.innerText = "Light Mode";
        } else {
            modeText.innerText = "Dark Mode";
        }
    });