@extends("theme.$theme.layout")

@section('title', 'Sub Módulos')

@section('styles')
    <link href="{{asset("assets/theme/$theme/libs/select2/css/select2.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/theme/$theme/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/theme/$theme/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset("assets/theme/$theme/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css")}}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{asset("assets/theme/$theme/libs/toastr/build/toastr.min.css")}}">
    <link rel="stylesheet" href="{{asset("assets/theme/$theme/libs/sweetalert2/sweetalert2.min.css")}}">
@endsection

@section('scripts')
    @php $modulo = modulo(); @endphp
    <script src="{{asset("assets/theme/$theme/libs/select2/js/select2.min.js")}}"></script>
    <script src="{{asset("assets/theme/$theme/libs/datatables.net/js/jquery.dataTables.min.js")}}"></script>
    <script src="{{asset("assets/theme/$theme/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/theme/$theme/libs/datatables.net-responsive/js/dataTables.responsive.min.js")}}"></script>
    <script src="{{asset("assets/theme/$theme/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js")}}"></script>
    <script src="{{asset("assets/theme/$theme/libs/toastr/build/toastr.min.js")}}"></script>
    <script src="{{asset("assets/theme/$theme/libs/sweetalert2/sweetalert2.min.js")}}"></script>



    <script type="text/javascript">var modulo = "{{$modulo}}";</script>
    <script src="{{asset("js/general.js")}}"></script>
    <script src="{{asset("js/seguridad/submodulos.js")}}"></script>
    <script>select2()</script>
@endsection

@section('header')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Lista Sub Módulos</h4>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-transparent border-bottom">
                    <div class="row mb-2">
                        <div class="col-md-9 col-lg-10">
                            <div class="mb-3 row">
                                <label class="col-md-2 col-form-label">Módulo</label>
                                <div class="col-md-5">
                                    <select class="form-control select2" id="cb_modulos">
                                        <option></option>
                                        @foreach ($menus as $m)
                                            <option value="{{$m->id}}">{{$m->descripcion}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class=" col-md-3 col-lg-2">
                            <button type="button" class="btn btn-info btn-width" id="btn_agregar-{{$modulo}}" disabled>
                                <i class="far fa-plus-square"></i> &nbsp;&nbsp; Nuevo Sub Módulo
                            </button>
                        </div>
                    </div>
                    @include('includes.modal', ['modulo' => $modulo, 'tamanio' => ''])
                </div>
                <div class="card-body">
                    <div class="table-rep-plugin">
                        <div class="table-responsive mb-0" data-pattern="priority-columns">
                            <table id="tblista-{{$modulo}}" class="table table-bordered dt-responsive nowrap w-100 table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Código</th>
                                        <th>Descripción</th>
                                        <th>Orden</th>
                                        <th>Ruta</th>
                                        <th>Grupo</th>
                                        <th style="width: 4rem;">Icono</th>
                                        <th class="btndos">Acción</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
