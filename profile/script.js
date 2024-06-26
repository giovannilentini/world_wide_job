const body = document.querySelector("body"),
      sidebar = document.querySelector(".sidebar"),
      searchBtn = document.querySelector(".search-box"),
      modeSwitch = document.querySelector(".toggle-switch"),
      modeText = document.querySelector(".mode-text"),
      mobile_toggle = document.querySelector(".mobile-toggle"),
      exit_button = document.querySelector(".exitbutton");

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

function checkAge(tempdate) {
    var today = tempdate;
    var birthdate = new Date(document.reg.birthdate.value);
    var age = today.getFullYear() - birthdate.getFullYear();
    var m = today.getMonth() - birthdate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
        age--;
    }
    return age;
}

/* ===== finestra modale Delete ===== */
var modal = document.getElementById("myModal");

var btnsOpenModal = document.querySelectorAll(".delete-btn");
var btnCloseModal = document.getElementById("btnNo");

btnsOpenModal.forEach(function(btn) {
    btn.onclick = function(event) {
        event.preventDefault();
        modal.style.display = "block";
        var postId = this.parentNode.querySelector('input[name="post_id"]').value;
        document.getElementById("btnYes").setAttribute("data-post-id", postId);
    }
});

btnCloseModal.onclick = function() {
    modal.style.display = "none";
}

var btnYes = document.getElementById("btnYes");
btnYes.onclick = function() {
    var postId = this.getAttribute("data-post-id");

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    };
    xhr.send("post_id=" + postId);
    modal.style.display = "none";
}
/* ===== Fine finestra modale Delete ===== */



/* ===== Finestra modale Edit ===== */
var editModal = document.getElementById("editModal");
var editModalClose = document.getElementById("editModalClose");

var editBtns = document.querySelectorAll(".edit-btn");
editBtns.forEach(function(btn) {
    btn.onclick = function(event) {
        event.preventDefault();
        
        var form = this.closest('form');
        var postTitle = form.querySelector('input[name="post_title"]').value;
        var postCampo = form.querySelector('input[name="post_campo"]').value;
        var postId = form.querySelector('input[name="post_id"]').value;

        document.getElementById("editTitle").value = postTitle;
        document.getElementById("editContent").value = postCampo;
        document.getElementById("editPostId").value = postId;

        editModal.style.display = "block";
    }
});

editModalClose.onclick = function(event) {
    event.preventDefault();
    document.getElementById("editTitle").value = '';
    document.getElementById("editContent").value = '';
    editModal.style.display = "none";
}

var saveBtn = document.getElementById("savePost");
saveBtn.onclick = function(event) {
    event.preventDefault();
    var postId = document.getElementById("editPostId").value;
    var editTitle = document.getElementById("editTitle").value;
    var editContent = document.getElementById("editContent").value;

    if (editTitle.trim() === '' || editContent.trim() === '') {
        alert("All fields are required");
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "edit.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            location.reload();
        }
    };
    xhr.send("post_id=" + postId + "&editTitle=" + encodeURIComponent(editTitle) + "&editContent=" + encodeURIComponent(editContent));
    editModal.style.display = "none";
}
/* ===== Fine finestra modale Edit ===== */
