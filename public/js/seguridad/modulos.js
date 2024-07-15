( function () {
    //****************************
    //   VARIABLES DEL MODULO
    //****************************
    var grupoRuta = 'seguridad/modulos/', data = [], id = '';

    //********************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL LISTADO DE REGISTROS  *
    //********************************************************
    $('#tblista-' + modulo).DataTable({
        autoWidth: false,
        processing: true,
        serverSide: true,
        responsive: true,
        ajax: {
            url: general.ruta(grupoRuta + 'lista-' + modulo),
            type: 'GET',
            data: {
                _token : general.token(),
            },
        },
        columns: [
            {data: 'codigo', name: 'codigo'},
            {data: 'descripcion', name: 'descripcion'},
            {data: 'indice', name: 'indice'},
            {data: 'icono', render: function(data, type, row, meta) {
                return '<i class="centro '+ data +'"></i>';
            }, orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        language: general.idioma(),
        pageLength: 10,
        order: [[2, "desc"]],
    });


    //*****************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL MODAL PARA AGREGAR *
    //*****************************************************
    $('#btn_agregar-'+ modulo).on('click', function(e) {
        e.preventDefault();
        limpiar();
        var url = general.ruta(grupoRuta + 'crear-' + modulo);
        mostrarModal('C',modulo,'Modulo',url,data,opcion);
        function opcion() {
            mostraricon();
        }
    })

    //****************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL MODAL PARA EDITAR *
    //****************************************************
    $(document).on('click', '.btn_editar-'+ modulo, function(e) {
        e.preventDefault();
        limpiar();
        id =this.value;
        var url = general.ruta(grupoRuta + 'editar-' + modulo);
        data.push({name:'id', value: id});
        mostrarModal('E',modulo,'Modulo',url,data,opcion);
        function opcion() {
            mostraricon();
        }
    })

    //****************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL MODAL PARA EDITAR *
    //****************************************************
    $(document).on('click', '.btn_eliminar-'+ modulo, function(e) {
        e.preventDefault();
        limpiar();
        id =this.value;
        var url = general.ruta(grupoRuta + 'eliminar-' + modulo);
        data.push({name:'id', value: id});
        eliminar(url,data);
    })

    //*********************************************
    //  FUNCION QUE PERMITE GRABAR LOS REGISTROS  *
    //*********************************************
    $(document).on('submit', '.form-agregar-' + modulo, function(e) {
        e.preventDefault();
        var url = general.ruta(grupoRuta + 'grabar-' + modulo);
        var data = $(this).serializeArray();
        ajaxForm(url, data);
    });

    //*************************************************
    //  FUNCION QUE PERMITE ACTUALIZAR LOS REGISTROS  *
    //*************************************************
    $(document).on('submit', '.form-actualizar-' + modulo, function(e) {
        e.preventDefault();
        var url = general.ruta(grupoRuta + 'actualizar-' + modulo);
        var data = $(this).serializeArray();
        data.push(
            {name:'_method', value:'PUT'},
            {name:'id', value:id}
        );
        ajaxForm(url, data);
    });

    //****************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL ICONO EN LA VISTA *
    //****************************************************
    function mostraricon() {
        $('#icono').on('blur', function(e) {
            e.preventDefault();
            var icono = ((this.value).split('-')[0] == 'mdi') ? 'mdi ' + this.value : this.value;
            this.value = icono;
            $('#mostrar_icon').removeClass().addClass(icono);
        });
    }

    //*********************************************
    //   FUNCION QUE PERMITE LIMPIAR LOS VALORES  *
    //*********************************************
    function limpiar() {
        data = [];
        id = '';
    }

    draggable(modulo);
}) ();
