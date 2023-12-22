function alertaConfirmarAccion(titulo, mensaje, accion, atributo = null) {
    Swal.fire({
        title:titulo,
        text:mensaje,
        icon:'warning',
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#9076f8',
        cancelButtonColor: '#C70039',
    }).then(e => {
        if (e.isConfirmed) {
            window.livewire.emit(accion, atributo, true);
        }
    });
}

window.addEventListener('alertaConfirmarAccion', function (e) {
    data = e.detail
    alertaConfirmarAccion(data.titulo, data.mensaje, data.accion, data.atributo);
})