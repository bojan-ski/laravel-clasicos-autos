document.addEventListener('DOMContentLoaded', function () {
    let musicMuted = false;

    const toggleMusicButton = document.getElementById('toggle-music');
    const backgroundMusic = document.getElementById('background-music');

    toggleMusicButton.addEventListener('click', function () {
        musicMuted = !musicMuted;
        
        backgroundMusic.muted = musicMuted;
        console.log(musicMuted);
    });
});
