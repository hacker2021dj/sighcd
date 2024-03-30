( function () {
    //****************************
    //   VARIABLES DEL MODULO
    //****************************
    var grupoRuta = 'seguridad/submodulos/', data = [], id = '', idmenu = '',tipo = '';

    //********************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL LISTADO DE REGISTROS  *
    //********************************************************
    lista_submenus();
    function lista_submenus(idmenu) {
        $('#tblista-'+ modulo).on('preXhr.dt', function () {
            $('#tblista-' + modulo +' tbody').empty();
        }).DataTable({
            autoWidth: false,
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: general.ruta(grupoRuta + 'lista-' + modulo),
                type: 'GET',
                data: {
                    id_menu : idmenu,
                    _token : general.token(),
                },
            },
            columns: [
                {data: 'codigo', name: 'codigo'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'indice', name: 'indice'},
                {data: 'ruta', name: 'ruta'},
                {data: 'grupo', name: 'grupo'},
                {data: 'icono', render: function(data, type, row, meta) {
                    return '<i class="centro '+ data +'"></i>';
                }, orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            language: general.idioma(),
            pageLength: 10,
            order: [[2, "desc"]],
        });
    }

    //************************************************************
    //   FUNCION QUE PERMITE CARGAR LA LISTA DE ACUERDO EL MENU  *
    //************************************************************
    $('#cb_modulos').on('change', function(e) {
        e.preventDefault();
        idmenu = this.value;
        $('#tblista-' + modulo).DataTable().destroy();
        if (idmenu != '') {
            lista_submenus(idmenu);
            $('#btn_agregar-' + modulo).prop('disabled',false);
            if (tipo == 'C') {
                $('#val_menu').val($('#cb_modulos option:selected').text());
            } else {
                $('#modal-' + modulo).modal('hide');
            }
        } else {
            lista_submenus();
            $('#btn_agregar-' + modulo).prop('disabled',true);
            $('#modal-' + modulo).modal('hide');
        }
    });

    //*****************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL MODAL PARA AGREGAR *
    //*****************************************************
    $('#btn_agregar-'+ modulo).on('click', function(e) {
        e.preventDefault();
        limpiar();
        tipo = 'C';
        var url = general.ruta(grupoRuta + 'crear-' + modulo);
        data.push({name: 'id_menu', value: idmenu});
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
        tipo = 'E';
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
        data.push({name:'id_menus', value: idmenu});
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
            {name:'id', value:id},
            {name:'id_menus', value: idmenu}
        );
        ajaxForm(url, data);
    });

    //****************************************************
    //  FUNCION QUE PERMITE MOSTRAR EL ICONO EN LA VISTA *
    //****************************************************
    function mostraricon() {
        $('#val_menu').val($('#cb_modulos option:selected').text());

        $('#icono').on('blur', function(e) {
            e.preventDefault();
            $('#mostrar_icon').removeClass().addClass(this.value);
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
