document.addEventListener('DOMContentLoaded', function () {
    const musicKey = 'music';
    const toggleMusicButton = document.getElementById('toggle-music');
    const backgroundMusic = document.getElementById('background-music');

    // play music in the background
    function updateMusicState() {
        const isMusicEnabled = localStorage.getItem(musicKey) !== 'false';
        backgroundMusic.muted = !isMusicEnabled;
    }

    updateMusicState();

    // toggle option
    toggleMusicButton.addEventListener('click', function () {
        const isCurrentlyEnabled = localStorage.getItem(musicKey) !== 'false';

        localStorage.setItem(musicKey, !isCurrentlyEnabled);

        updateMusicState();
    });
});
