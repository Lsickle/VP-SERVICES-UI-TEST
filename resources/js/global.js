// Archivo global para scripts

// Función para normalizar el texto: elimina acentos, espacios y pasa a minúsculas
function normalizeText(text) {
    return text
        .normalize("NFD") // descompone caracteres acentuados
        .replace(/[\u0300-\u036f]/g, "") // elimina marcas de acentos
        .replace(/\s+/g, "") // elimina espacios
        .toLowerCase();
}

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

    // Funcionalidad de búsqueda en el sidebar
    const sidebarSearch = document.getElementById("sidebarSearch");
    const sidebarList = document.getElementById("sidebarList");

    if (sidebarSearch && sidebarList) {
        sidebarSearch.addEventListener("input", function () {
            // Normaliza el filtro de búsqueda
            let filter = normalizeText(sidebarSearch.value);

            // Itera sobre cada <li> para filtrar
            let items = sidebarList.getElementsByTagName("li");
            for (let i = 0; i < items.length; i++) {
                let text = normalizeText(items[i].textContent);
                items[i].style.display =
                    text.indexOf(filter) > -1 ? "" : "none";
            }

            // Para los <h2>: si se está buscando (filter distinto de vacío), se ocultan
            // De lo contrario se muestran
            let headings = sidebarList.getElementsByTagName("h2");
            for (let i = 0; i < headings.length; i++) {
                headings[i].style.display = filter === "" ? "" : "none";
            }
        });
    }
});
