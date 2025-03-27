// Archvio global para scripts
document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');

    if(sidebarToggle && sidebar && mainContent) {
        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('hidden'); // Muestra u oculta el sidebar
            mainContent.classList.toggle('ml-64'); // Desplaza el contenido cuando el sidebar está visible
        });
    }
});
