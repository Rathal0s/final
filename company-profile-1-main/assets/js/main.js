AOS.init();

const stringsArray = [
    "Insanity",
    "Ferocity",
    "Anxiety",
    "Cruelty",
    "Disparity",
    "Impurity",
    "Insecurity",
    "Adversity",
];

// Shuffle the array using Fisher-Yates algorithm
function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
    return array;
}

// Shuffle the strings array
const shuffledStrings = shuffleArray(stringsArray);

// Initialize Typed.js with the shuffled strings
new Typed("#typed", {
    strings: shuffledStrings,
    typeSpeed: 100,
    delaySpeed: 300,
    loop: true,
});

$("#btn-nav").click(function () {
    $(".nav-menu").toggleClass("active");
});
$("#btn-menu").click(function () {
    $(".nav-menu").removeClass("active");
});
$("#nav-link").click(function () {
    $(".nav-menu").removeClass("active");
});
$("#nav-link1").click(function () {
    $(".nav-menu").removeClass("active");
});
$("#nav-link2").click(function () {
    $(".nav-menu").removeClass("active");
});
$("#nav-link3").click(function () {
    $(".nav-menu").removeClass("active");
});
$("#nav-link4").click(function () {
    $(".nav-menu").removeClass("active");
});
$("#nav-link5").click(function () {
    $(".nav-menu").removeClass("active");
});

$(".carousel").flickity({
    cellAlign: "left",
    contain: true,
    autoPlay: true,
    wrapAround: true,
    pageDots: false,
});
$(".main-carousel").flickity({
    cellAlign: "left",
    contain: true,
    autoPlay: 2000,
    wrapAround: true,
    prevNextButtons: false,
    pageDots: false,
    draggable: false,
});
var scroll = new SmoothScroll('a[href*="#"]', {
    speed: 300,
    speedAsDuration: true
});
var easeInQuint = new SmoothScroll('[data-easing="easeInQuint"]', { easing: 'easeInQuint' });

document.addEventListener('DOMContentLoaded', function() {
    var addModal = document.getElementById('addReviewModal');
    var editModal = document.getElementById('editReviewModal');
    var closeBtns = document.getElementsByClassName('close');

    // Open add review modal
    document.querySelector('.add-btn').onclick = function() {
        addModal.style.display = 'block';
    };

    function openReviewModal() {
        document.getElementById('reviewModal').style.display = 'block';
      }
      
      function closeReviewModal() {
        document.getElementById('reviewModal').style.display = 'none';
      }
      
      // Close the modal when clicking outside of it
      window.onclick = function(event) {
        const modal = document.getElementById('reviewModal');
        if (event.target == modal) {
          modal.style.display = 'none';
        }
      }
      

    // Close modals
    Array.from(closeBtns).forEach(function(btn) {
        btn.onclick = function() {
            addModal.style.display = 'none';
            editModal.style.display = 'none';
        };
    });

    // Close modals when clicking outside of the modal content
    window.onclick = function(event) {
        if (event.target == addModal) {
            addModal.style.display = 'none';
        }
        if (event.target == editModal) {
            editModal.style.display = 'none';
        }
    };
});

