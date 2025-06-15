document.addEventListener('DOMContentLoaded', () => {
    var carrousel = document.getElementById('carrousel');
    // Asegurarse de que el carrusel existe antes de intentar manipularlo
    if (!carrousel) {
        console.error("El elemento con ID 'carrousel' no fue encontrado.");
        return; // Salir si el elemento no existe
    }

    var imgs = carrousel.querySelectorAll('img');
    var prevBtn = document.getElementById('prev');
    var nextBtn = document.getElementById('next');

    // Asegurarse de que los botones existen
    if (!prevBtn || !nextBtn) {
        console.error("Los botones 'prev' o 'next' no fueron encontrados.");
        return; // Salir si los botones no existen
    }

    var index = 0;
    var intervalo;

    function mostrarImagen(i) {
        imgs.forEach((img, idx) => {
            img.classList.toggle('active', idx === i);
        });
    }

    function siguiente() {
        index = (index + 1) % imgs.length;
        mostrarImagen(index);
    }

    function anterior() {
        index = (index - 1 + imgs.length) % imgs.length;
        mostrarImagen(index);
    }

    function reiniciarIntervalo() {
        clearInterval(intervalo);
        intervalo = setInterval(siguiente, 3000); // 3 segundos
    }

    // Mostrar la primera imagen al cargar
    if (imgs.length > 0) {
        mostrarImagen(index);
    }

    prevBtn.addEventListener('click', () => {
        anterior();
        reiniciarIntervalo();
    });

    nextBtn.addEventListener('click', () => {
        siguiente();
        reiniciarIntervalo();
    });

    // Iniciar el carrusel automático
    intervalo = setInterval(siguiente, 3000);

    // Opcional: Pausar/Reanudar el carrusel al pasar el ratón
    carrousel.addEventListener('mouseenter', () => {
        clearInterval(intervalo);
    });

    carrousel.addEventListener('mouseleave', () => {
        reiniciarIntervalo();
    });

});