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

    document.addEventListener('DOMContentLoaded', function() {
        const profilePic = document.getElementById('profile-image');
        profilePic.addEventListener('click', function() {
            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.accept = 'image/*'; 
            fileInput.addEventListener('change', function(event) {
                const file = event.target.files[0]; 
                const reader = new FileReader();
                
                reader.onload = function() {
                    profilePic.src = reader.result;
                }
                
                if (file && file.type.startsWith('image/')) {
                    reader.readAsDataURL(file); 
                    uploadImage(file);
                } else {
                    document.getElementById("uploadResult").style.color = "red";
                    document.getElementById("uploadResult").innerHTML="Estensione non consentita, scegliere un file JPEG o PNG.";
                }
            });
            fileInput.click();
        });
    });
    
    function uploadImage(imageFile) {
        document.getElementById("uploadResult").style.color = "green";
        var formData = new FormData();
        formData.append("profileImage", imageFile);
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "methods/upload_image.php", true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                if(xhr.responseText!="Immagine caricata con successo.")
                {
                    document.getElementById("uploadResult").style.color = "red";
                }
                document.getElementById("uploadResult").innerHTML=xhr.responseText;
            
            } else {
                document.getElementById("uploadResult").style.color = "red";
                document.getElementById("uploadResult").innerHTML="Errore durante l'upload dell'immagine.";
                
            }
        };
        xhr.send(formData);
    }
    
    function getFileExtension(filename) {
        return filename.split('.').pop().toLowerCase();
    }