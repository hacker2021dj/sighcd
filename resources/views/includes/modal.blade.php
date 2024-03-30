<form class="form-horizontal" id="form-modal-{{$modulo}}" method="POST" autocomplete="off">
    <div class="modal fade" id="modal-{{$modulo}}">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable {{$tamanio}}">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mtitulo-{{$modulo}}"> </h5>
                    {{--  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>  --}}
                </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        @include('includes.btn-formgrabar')
                    </div>
            </div>
        </div>
    </div>
</form>
