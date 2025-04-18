const headerAccount = document.querySelector(".header-account");
const accountDropdownBox = document.querySelector(".account-dropdown-box");

let clicked = 0;
// account button click function
headerAccount.addEventListener("click", () => {
  // if (clicked == 0) {
  //   accountDropdownBox.classList.add("account-dropdown-box-active");
  //   accountDropdownBox.style.animation = "fadeIn 0.2s linear;";
  //   clicked = 1;
  // } else {
  //   accountDropdownBox.classList.remove("account-dropdown-box-active");
  //   clicked = 0;
  // }

  accountDropdownBox.classList.toggle("account-dropdown-box-active");
});

window.onscroll = () => {
  accountDropdownBox.classList.remove("account-dropdown-box-active");
  accountDropdownBox.style.animation = "fadeIn 0.2s linear;";
};
