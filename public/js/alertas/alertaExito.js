function alertaExito(titulo, mensaje, html, tiempo = 2500) {
    Swal.fire({
        title:titulo,
        text:mensaje,
        html:html,
        icon:'success',
        timer:tiempo,
        showConfirmButton: true,
    });
}

window.addEventListener('alertaExito', function (e) {
    data = e.detail;
    alertaExito(data.titulo, data.mensaje, data.html, data.tiempo);
})