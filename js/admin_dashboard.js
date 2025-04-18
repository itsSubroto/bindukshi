const dropdownBtn = document.querySelectorAll(".dropdown-btn");
const toggleButton = document.getElementById("toggle-btn");
const sidebar = document.getElementById("sidebar");

// for the update product page . It changes the image when the sub image is clicked
let mainImage = document.querySelector(".main-image-img");
let subImages = document.querySelectorAll(".each-sub-image");

subImages.forEach((images) => {
  images.onclick = () => {
    src = images.getAttribute("src");
    mainImage.src = src;
  };
});

// function

// add event listener to open the submenu

// for (let i = 0; i < dropdownBtn.length; i++) {
//   const eachDropdown = dropdownBtn[i];
//   eachDropdown.addEventListener("click", () => {
//     eachDropdown.nextElementSibling.classList.toggle("show");
//   });
// }

// taken by the yt video .In html code there is inline event listener named toggleSubMenu

function toggleSidebar() {
  sidebar.classList.toggle("close");
  toggleButton.classList.toggle("rotate");

  closeAllSubMenus();
}

function toggleSubMenu(button) {
  if (!button.nextElementSibling.classList.contains("show")) {
    closeAllSubMenus();
  }

  button.nextElementSibling.classList.toggle("show");
  button.classList.toggle("rotate");

  if (sidebar.classList.contains("close")) {
    sidebar.classList.toggle("close");
    toggleButton.classList.toggle("rotate");
  }
}

function closeAllSubMenus() {
  Array.from(sidebar.getElementsByClassName("show")).forEach((ul) => {
    ul.classList.remove("show");
    ul.previousElementSibling.classList.remove("rotate");
  });
}
