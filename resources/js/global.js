// Archvio global para scripts

//Se maneja el Sidebar
document.addEventListener("DOMContentLoaded", function () {
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebar = document.getElementById("sidebar");

    if (sidebarToggle && sidebar) {
        // Listener para mostrar/ocultar el sidebar al hacer clic en el botón
        sidebarToggle.addEventListener("click", function (event) {
            event.stopPropagation(); // Evita que el clic se propague al documento
            sidebar.classList.toggle("-translate-x-full");
        });

        // Listener para cerrar el sidebar si se hace clic fuera de él
        document.addEventListener("click", function (event) {
            // Verifica que el sidebar esté visible (sin la clase -translate-x-full)
            if (!sidebar.classList.contains("-translate-x-full")) {
                // Si el clic se realiza fuera del sidebar y del botón toggle
                if (
                    !sidebar.contains(event.target) &&
                    !sidebarToggle.contains(event.target)
                ) {
                    sidebar.classList.add("-translate-x-full");
                }
            }
        });
    }

    // Se añade la Funcionalidad de búsqueda en el sidebar
    const sidebarSearch = document.getElementById("sidebarSearch");
    const sidebarList = document.getElementById("sidebarList");

    if (sidebarSearch && sidebarList) {
        sidebarSearch.addEventListener("input", function () {
            let filter = sidebarSearch.value.toLowerCase();
            let items = sidebarList.getElementsByTagName("li");

            // Itera sobre cada item y filtra según el texto
            for (let i = 0; i < items.length; i++) {
                let text = items[i].textContent.toLowerCase();
                if (text.indexOf(filter) > -1) {
                    items[i].style.display = "";
                } else {
                    items[i].style.display = "none";
                }
            }
        });
    }
});
