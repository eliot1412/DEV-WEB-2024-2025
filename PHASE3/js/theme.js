function toggleTheme() {
    const body = document.body;
    const videoSource = document.querySelector('.video-background source');
    
    if (body.classList.contains('light-theme')) {
        // Switch to dark theme
        body.classList.remove('light-theme');
        body.classList.add('dark-theme');
        videoSource.src = "volcan-night.mp4";
        localStorage.setItem('theme', 'dark');
    } else {
        // Switch to light theme
        body.classList.remove('dark-theme');
        body.classList.add('light-theme');
        videoSource.src = "volcan-day.mp4";
        localStorage.setItem('theme', 'light');
    }
    
    // Reload video
    const video = videoSource.parentElement;
    video.load();
    video.play().catch(e => console.log("Video play prevented:", e));
}

document.addEventListener('DOMContentLoaded', function() {
    // Set saved theme or default to dark
    const savedTheme = localStorage.getItem('theme') || 'dark';
    document.body.classList.add(savedTheme + '-theme');
    
    // Initialize video
    const videoSource = document.querySelector('.video-background source');
    if (videoSource) {
        videoSource.src = savedTheme === 'light' ? "volcan-day.mp4" : "volcan-night.mp4";
        videoSource.parentElement.load();
    }
    
    // Create theme toggle button
    const themeBtn = document.createElement('button');
    themeBtn.className = 'theme-btn';
    themeBtn.innerHTML = '🌓';
    themeBtn.title = 'Changer de thème';
    themeBtn.onclick = toggleTheme;
    document.body.appendChild(themeBtn);
});