function mostrarModal(tipo, modulo, titulo, ruta, datos, func = '') {
    $('#form-modal-' + modulo).removeClass('form-actualizar-' + modulo);
    $('#form-modal-' + modulo).removeClass('form-agregar-' + modulo);
    if (tipo == 'C') {
        // $('#vl').removeClass('loader');
        $('#form-modal-' + modulo).addClass('form-agregar-' + modulo);
        $('#mtitulo-' + modulo).text('Nuevo ' + titulo);
        document.getElementById('spanBtnGrabar').innerHTML = 'Grabar';
    } else {
        // $('#vl').removeClass('loader');
        $('#form-modal-' + modulo).addClass('form-actualizar-' + modulo);
        $('#mtitulo-' + modulo).text('Editar ' + titulo);
        document.getElementById('spanBtnGrabar').innerHTML = 'Actualizar';
    }
    ajaxForm(ruta, datos, modal);
    function modal(response) {
        $('#modal-' + modulo+' .modal-body').html((response.vista) ? response.vista : response);
        $('#modal-' + modulo).modal('show');
        (func != '') ? func(response) : '';
    }
}

function select2() {
    $('.select2').select2({
        placeholder: 'Seleccione Opción',
        allowClear: true,
        //minimumInputLength: 1,
    });
}
