// for the product preview
const previewImage = document.querySelectorAll(".preview-image");
const imagePreview = document.querySelector(".image-preview");
const productImage = document.querySelector(".product-image");
// for the similar product section
const left = document.querySelector(".left");
const right = document.querySelector(".right");
const productBox = document.querySelectorAll(".product-box");
const slider = document.querySelector(".similar-product-container");

const length = productBox.length;
console.log(productBox);

let slideNumber = 1;

//
let InitialProductImageSrc = productImage.src;
// console.log(previewImage);

// for the similar product section
// functions
const nextSlide = () => {
  slider.style.transform = `translateX(-${slideNumber * 11}rem)`;
  slideNumber++;
};
const prevSlide = () => {
  slider.style.transform = `translateX(-${(slideNumber - 2) * 11}rem)`;
  slideNumber--;
};
const getFirstSlide = () => {
  slider.style.transform = `translateX(-0px)`;
  slideNumber = 1;
};
const getLastSlide = () => {
  slider.style.transform = `translateX(-${(length - 1) * 11}rem)`;
  slideNumber = length;
};

// right arrow functionality
right.addEventListener("click", () => {
  console.log("right");

  slideNumber < length ? nextSlide() : getFirstSlide();
});
// left arrow functionality
left.addEventListener("click", () => {
  console.log("right");

  slideNumber > 1 ? prevSlide() : getLastSlide();
});
// for the product preview section . Change the images as we hover on the img.

for (let i = 0; i < previewImage.length; i++) {
  const EachPreviewImage = previewImage[i];
  EachPreviewImage.addEventListener("mouseover", (e) => {
    EachPreviewImage.style.border = "2px solid #55a0f1";
    let imgSrc = EachPreviewImage.src;
    productImage.src = imgSrc;
  });
  EachPreviewImage.addEventListener("mouseout", (e) => {
    EachPreviewImage.style.border = "none";
    let imgSrc = EachPreviewImage.src;
    productImage.src = imgSrc;
  });
}
