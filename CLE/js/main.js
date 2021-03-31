window.addEventListener("load", init);

let currentSlide;
let slides;

function init() {
    currentSlide = 1;
    slides = document.getElementsByClassName("mySlides");
    document.getElementById("prev").addEventListener("click", prevImg);
    document.getElementById("next").addEventListener("click", nextImg);
    slideShow();
}

//function for prev img
function prevImg(){
    currentSlide--
    if (currentSlide < 1){
        currentSlide = slides.length;
    }
    slideShow();
}

//function for next img
function nextImg(){
    currentSlide++
    if (currentSlide > slides.length){
        currentSlide = 1
    }
    slideShow();
}

//show img based on currentSlide
function slideShow(){
    for (let i = 0; i < slides.length; i++){
        slides[i].classList.remove("block");
        slides[i].classList.add("none");
    }
    slides[currentSlide-1].classList.remove("none");
    slides[currentSlide-1].classList.add("block");
}