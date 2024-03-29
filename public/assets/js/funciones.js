var general = function () {
    return {
        notificaciones: function (mensaje, titulo, tipo){
            toastr.options = {
                closeButton: true,
                newestOnTop: true,
                positionClass: 'toast-top-right',
                preventDuplicates: true,
                timeOut: '5000'
            };

            switch (tipo) {
                case 'error': toastr.error(mensaje, titulo); break;
                case 'success': toastr.success(mensaje, titulo); break;
                case 'info': toastr.info(mensaje, titulo); break;
                case 'warning': toastr.warning(mensaje, titulo); break;
            }
        },

        idioma: function (ntabla = '') {
            return {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en "+ ((ntabla == '') ? "esta tabla." : ntabla),
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        },
        ruta : function (url) {
            return base_url + '/' + url;


            // var enlace = ''; // EL SEGUNDO SEGMENTO DE LA RUTA
            // var pathname = window.location.pathname; //OBTIENE LOS SEGMENTOS DE LA RUTA
            // var pos = pathname.indexOf("/", 1); // BUSCA EL INDICE DE ARREGLO
            // var parte1 = pathname.substring(1,pos); // SE OBTIENE EL SEGMENTO DEL GRUPO
            // if(parte1 !== enlace){
            //     return rutaUrl = location.protocol + '//' + window.location.hostname + '/' + url;
            // } else {
            //     return rutaUrl = location.protocol + '//' + window.location.hostname + '/' + enlace + '/' + url;
            // }
        },
        token: function () {
            return $('meta[name="csrf-token"]').attr('content');
        }
    }
}();

//**********************************************
//  FUNCION QUE SE LLAMA PARA GRABAR LOS DATOS *
//**********************************************
function ajaxForm(url,data,respuesta = '') {
    $('#vl').addClass('loader');
    data.push({name:'_token',value: general.token()});
    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        beforeSend: function (event) {
            if ($(document).find('span.error-text').text(''))
                $(document).find('span.error-text').text('');
        },
        success: function(r) {
            (respuesta != '') ? respuesta(r) : '';
            if (r.status == 200) {
                general.notificaciones(r.mensaje, r.validacion, 'success');
                if (r.ntabla)
                    actualizatabla(r.ntabla);
            } else if(r.status == 500) {
                general.notificaciones(r.mensaje,r.validacion,'error');
            }
            $(r.modal).modal('toggle');
        },
        error: function (e) {
            $.each(e.responseJSON.errors, function (fieldName, errorBag) {
                $('span.'+fieldName+'-error').text(errorBag[0]);
            });
        },
    });
}

//**********************************************
//   FUNCION QUE PERMITE ELIMINAR LOS REGISTROS
//**********************************************
function eliminar(url,data) {
    Swal.fire({
        title: '¿Está seguro que desea eliminar el registro?',
        text: "Esta acción no se puede deshacer!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: 'Crimson',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, Eliminar!'
    }).then((result) => {
        if (result.value) {
            data.push({name:'_method', value:'DELETE'})
            ajaxForm(url,data);
        }
    });
}

//*****************************************************
//  FUNCION QUE PERMITE ACTUALIZAR LA TABLA PRINCIPAL
//*****************************************************
function actualizatabla(ntabla) {
    var page_dt = $(ntabla).DataTable();
    function reloadList() {
        if (typeof (page_dt) == "undefined") return;
        page_dt.ajax.reload(null, false);// ** Vuelve a cargar la página actual, llama a la API ajax.reload ()
    }
    reloadList();
}

//*******************************************************
//   FUNCION QUE PERMITE Q EL MODAL TENGA EL MOVIMIENTO
//*******************************************************
function draggable(modals) {
    $.widget.bridge('uibutton', $.ui.button)
    $('#modal-'+modals).draggable({
        handle: ".modal-header",
    });
}
