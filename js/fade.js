// Get the header element
const header = document.getElementById("header");

// Add an event listener for the scroll event
window.addEventListener("scroll", function() {
  // Get the current scroll position
  const scroll = window.scrollY;

  // Check if the scroll position is greater than 50
  if (scroll > 50) {
    // If it is, set the opacity of the header to 0.5
    header.style.opacity = 0.5;
  } else {
    // If it's not, set the opacity of the header to 1
    header.style.opacity = 1;
  }
});