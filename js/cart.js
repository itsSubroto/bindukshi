const wishlistBox = document.querySelectorAll(".wishlist-box");
const cartCount = document.querySelector("#cart-count");

let numberOfCartElement = wishlistBox.length;

// function to count the number of element in cart and show in the header cart icon
const countCartElement = () => {
  cartCount.innerHTML = `${numberOfCartElement}`;
};

//call countCartElement
countCartElement();
