// Ajout du comportement de l'indicateur de scroll
window.addEventListener("scroll", function () {
    var scrollIndicator = document.querySelector(".scroll-indicator");
    var presentation = document.querySelector(".presentation");
    var presentationHeight = presentation.offsetHeight;
    var scrollPosition = window.pageYOffset;

    // Ajout de la logique pour faire disparaître l'indicateur de scroll lorsque l'utilisateur commence à scroller
    if (scrollPosition > presentationHeight) {
        scrollIndicator.style.opacity = "0";
    } else {
        scrollIndicator.style.opacity = "1";
    }
});

// Ajout d'un événement de chargement pour afficher l'indicateur de scroll dès que la page est chargée
window.addEventListener("load", function () {
    var scrollIndicator = document.querySelector(".scroll-indicator");
    scrollIndicator.style.opacity = "1";
});
