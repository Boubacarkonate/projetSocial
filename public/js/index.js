

const conteneurMenu = document.querySelector('#conteneur-menu');
const btnMenu = document.querySelector('#bouton-menu');
const btnFlottant = document.querySelectorAll('.boule');
const texte = document.querySelector('.selectionEspace');



btnMenu.addEventListener('click', () => {

    conteneurMenu.classList.toggle('active');

    if ( conteneurMenu.style.backgroundColor=='transparent') {
        conteneurMenu.style.backgroundColor='white' ;
    } 
    
    else {
        conteneurMenu.style.backgroundColor='transparent';
    }

     
  });



const carousel = document.querySelector('#comment-carousel');
const carouselInner = carousel.querySelector('.carousel-inner');
const carouselItems = carousel.querySelectorAll('.carousel-item');

let currentIndex = 0;
const itemWidth = carouselItems[0].offsetWidth;

carousel.style.width = itemWidth * 3 + 'px'; // Show 3 items at a time, adjust as needed

function slideTo(index) {
  carouselInner.style.transform = 'translateX(' + (-itemWidth * index) + 'px)';
  currentIndex = index;
}

function slideNext() {
  const nextIndex = currentIndex + 1;
  if (nextIndex >= carouselItems.length) {
    slideTo(0);
  } else {
    slideTo(nextIndex);
  }
}

function slidePrev() {
  const prevIndex = currentIndex - 1;
  if (prevIndex < 0) {
    slideTo(carouselItems.length - 1);
  } else {
    slideTo(prevIndex);
  }
}

carousel.querySelector('.carousel-control-prev').addEventListener('click', () => {
  slidePrev();
});

carousel.querySelector('.carousel-control-next').addEventListener('click', () => {
  slideNext();
});



