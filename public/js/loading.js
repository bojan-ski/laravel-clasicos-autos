document.addEventListener('DOMContentLoaded', function () {
    // display loading on form submission
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function () {
            document.getElementById('loading').classList.remove('hidden');
        });
    });

    // display loading on page navigation
    document.querySelectorAll('a:not([target="_blank"])').forEach(link => {
        link.addEventListener('click', function () {
            document.getElementById('loading').classList.remove('hidden');
        });
    });
});