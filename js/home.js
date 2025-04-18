const left = document.querySelector(".left");
const right = document.querySelector(".right");
const slider = document.querySelector(".slider");
const images = document.querySelectorAll(".image");
const bottom = document.querySelector(".bottom");

const length = images.length;
let slideNumber = 1;

// dots navigation button

for (let i = 0; i < length; i++) {
  const div = document.createElement("div");
  div.className = "button";
  bottom.appendChild(div);
}

const buttons = document.querySelectorAll(".button");
buttons[0].style.backgroundColor = "gray";
const resetBg = () => {
  buttons.forEach((button) => {
    button.style.backgroundColor = "transparent";
    button.addEventListener("mouseover", stopSlideShow);
    button.addEventListener("mouseout", startSlideShow);
  });
};

buttons.forEach((button, i) => {
  button.addEventListener("click", () => {
    slider.style.transform = `translateX(-${i * 100}vw)`;
    slideNumber = i + 1;
    resetBg();
    button.style.backgroundColor = "gray";
  });
});

const changeColor = () => {
  resetBg();
  buttons[slideNumber - 1].style.backgroundColor = "gray";
};
//   end dots nav

// functions
const nextSlide = () => {
  slider.style.transform = `translateX(-${slideNumber * 100}vw)`;
  slideNumber++;
};
const prevSlide = () => {
  slider.style.transform = `translateX(-${(slideNumber - 2) * 100}vw)`;
  slideNumber--;
};
const getFirstSlide = () => {
  slider.style.transform = `translateX(-0px)`;
  slideNumber = 1;
};
const getLastSlide = () => {
  slider.style.transform = `translateX(-${(length - 1) * 100}vw)`;
  slideNumber = length;
};

// right arrow functionality
right.addEventListener("click", () => {
  slideNumber < length ? nextSlide() : getFirstSlide();
  changeColor();
});
// left arrow functionality
left.addEventListener("click", () => {
  slideNumber > 1 ? prevSlide() : getLastSlide();
  changeColor();
});

// autoplay slides
let slideInterval;

const startSlideShow = () => {
  slideInterval = setInterval(() => {
    slideNumber < length ? nextSlide() : getFirstSlide();
    changeColor();
  }, 3000);
};
const stopSlideShow = () => {
  clearInterval(slideInterval);
};

startSlideShow();

// slider.addEventListener("mouseover", stopSlideShow);
// slider.addEventListener("mouseout", startSlideShow);
// right.addEventListener("mouseover", stopSlideShow);
// right.addEventListener("mouseout", startSlideShow);
// left.addEventListener("mouseover", stopSlideShow);
// left.addEventListener("mouseout", startSlideShow);
