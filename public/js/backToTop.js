document.addEventListener("DOMContentLoaded", function () {
    const backToTopBtn = document.getElementById('back-to-top');
    let scrollTimer;

    window.addEventListener('scroll', function () {
        backToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
        backToTopBtn.classList.add('opacity-100');
        clearTimeout(scrollTimer);
        
        scrollTimer = setTimeout(() => {            
            backToTopBtn.classList.remove('opacity-100');
            backToTopBtn.classList.add('opacity-0', 'pointer-events-none');
        }, 2000);
    });

    backToTopBtn.addEventListener('click', function () {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
});
