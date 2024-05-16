const body = document.querySelector("body"),
      sidebar = document.querySelector(".sidebar"),
      searchBtn = document.querySelector(".search-box"),
      modeSwitch = document.querySelector(".toggle-switch"),
      modeText = document.querySelector(".mode-text"),
      mobile_toggle = document.querySelector(".mobile-toggle");
      exit_button= document.querySelector(".exitbutton");

const hideSidebar = () => {
    sidebar.classList.add("close");
}
const showSidebar = () => {
    sidebar.classList.remove("close");
}

mobile_toggle.addEventListener("click", (e) => {
    if (sidebar.classList.contains("close")) {
        sidebar.classList.remove("close");
    } 
});

exit_button.addEventListener("click", (e) => {
        sidebar.classList.add("close");
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


/* ===== Modal Window ===== */
var modal = document.getElementById("myModal");
var btn = document.getElementById("openModalBtn");
var span = document.getElementsByClassName("close")[0];

btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

document.getElementById("postBtn").addEventListener("click", function() {
  var postContent = document.getElementById("postContent").value;
  console.log("Hai postato: " + postContent);
  modal.style.display = "none";
});

/* ===== Close Button =====*/
var closeModalBtn = document.querySelector(".close-win");
closeModalBtn.addEventListener("click", function() {
  modal.style.display = "none";
});