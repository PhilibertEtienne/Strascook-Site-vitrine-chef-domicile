const ratio = 0.1;
const options = {
    root: null,
    rootMargin: "0px",
    threshold: ratio,
};

const handleIntersect = function (entries, observer) {
    entries.forEach(function (entry) {
        if (entry.intersectionRatio > ratio) {
            entry.target.classList.add("reveal-visible");
            observer.unobserve(entry.target);
        } else {
        }
    });
};

document.documentElement.classList.add("reveal-loaded");
const observer = new IntersectionObserver(handleIntersect, options);
document.querySelectorAll('[class*="reveal-"]').forEach(function (r) {
    observer.observe(r);
});
