document.addEventListener("DOMContentLoaded", function () {
    var backToTop = document.getElementById("back-to-top");

    // Afficher/masquer la flèche en fonction du défilement
    window.addEventListener("scroll", function () {
        if (window.pageYOffset > 100) {
            backToTop.style.display = "block";
        } else {
            backToTop.style.display = "none";
        }
    });

    // Animer le défilement vers le haut
    backToTop.addEventListener("click", function (event) {
        event.preventDefault();
        window.scrollTo({ top: 0, behavior: "smooth" });
    });
});
