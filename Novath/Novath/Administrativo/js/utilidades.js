// function manejarBotonesCollapse() {
//     const botones = document.querySelectorAll('.boton-filtro-evento');

//     botones.forEach((boton) => {
//         boton.addEventListener('click', () => {
//             // Ocultar todos los colapsos
//             const colapsos = document.querySelectorAll('.collapse');
//             colapsos.forEach((colapso) => {
//                 colapso.classList.remove('show');
//             });

//             // Mostrar el colapso asociado al botón actual
//             const targetId = boton.getAttribute('data-target').substring(1); // Eliminar el "#" del ID
//             const targetColapso = document.getElementById(targetId);
//             targetColapso.classList.add('show');
//         });
//     });
// }

// // Llamar a la función cuando se cargue el documento
// document.addEventListener('DOMContentLoaded', manejarBotonesCollapse);





function manejarBotonesCollapse() {
    const botones = document.querySelectorAll('[data-toggle="collapse"]');

    botones.forEach((boton) => {
        boton.addEventListener('click', () => {
            const targetId = boton.getAttribute('href').substring(1);
            const targetColapso = document.getElementById(targetId);

            if (targetColapso.classList.contains('show')) {
                targetColapso.classList.remove('show');
            } else {
                targetColapso.classList.add('show');
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', manejarBotonesCollapse);
