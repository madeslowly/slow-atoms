/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */


const mediaQuery = window.matchMedia('(max-width: 768px)')
// Only load if we are on mobile
if (mediaQuery.matches) {
  
  const navSlide = ()=>{
    const burger = document.querySelector('.burger');
    const navSlider = document.querySelector('.menu-navbar-container');
    const navLinks = document.querySelectorAll('.navbar--list > li');
    const navBar = document.querySelector('.main-navigation');

    // Return early if the navigation doesn't exist.
    if ( ! navLinks ) {
      return;
    }

    // watch for touch clicks on the whole navbar
    navBar.addEventListener('click', () => {
      // animate accordinaly
      navSlider.classList.toggle('nav-active');
      burger.classList.toggle('burger-active');
      navLinks.forEach((link, index) => {
        if ( link.style.animation ) {
          link.style.animation = ``
        } else {
          link.style.animation = `navLinksFade .25s ease-out forwards ${index * .1  }s`
        }
      });
      burger.classList.toggle('toggle');
    });
  }
  navSlide();
}

