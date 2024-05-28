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

document.addEventListener('DOMContentLoaded', function() {
  function loadPosts(query) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `./methods/search_posts.php?query=${encodeURIComponent(query)}`, true);
      xhr.onload = function() {
          if (xhr.status === 200) {
              const data = JSON.parse(xhr.responseText);
              const postsContainer = document.getElementById('posts-container');
              postsContainer.innerHTML = '';

              if (data.length === 0) {
                  postsContainer.innerHTML = '<p>No posts found.</p>';
                  return;
              }

              data.forEach(post => {
                  const postElement = document.createElement('div');
                  postElement.classList.add('post');

                  postElement.innerHTML = `
                      <div class="post-header">
                          <div class="author-info">
                              <div class="profile-info">
                                  <div class="profile-img">
                                      <img src="${post.profile_image}" alt="${post.name} ${post.surname}">
                                  </div>
                                  <div class="profile-details">
                                      <span class="username">
                                          <form id="visita${post.id}" name="form" action="methods/user_profile.php" method="POST">
                                              <input type="hidden" name="other_user_id" value="${post.user_id}">
                                              <button type="submit" class="user-profile">${post.name} ${post.surname}</button>
                                          </form>
                                      </span>
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div class="post-content">
                          <h3>${post.title}</h3>
                          <div class="comment-box">
                              <p>${post.campo}</p>
                          </div>
                      </div>
                  `;
                  postsContainer.appendChild(postElement);
              });
          } 
      };
      xhr.send();
  }

  loadPosts('');

  document.getElementById('search-input').addEventListener('input', function() {
      const query = this.value;
      loadPosts(query);
  });
});

