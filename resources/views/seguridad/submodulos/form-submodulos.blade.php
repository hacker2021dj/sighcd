<div class="row">
    <div id="vl"></div>
    <div class="callout callout-info">
        <div class="row">
            <div class="card-title text-info text-uppercase font-weight-bold"></div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Módulo:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" id="val_menu" required readonly>
                <span class="text-danger error-text id_menus-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Código:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" name="codigo" value="{{old('codigo', $smenu->codigo ?? '')}}" maxlength="15" required>
                <span class="text-danger error-text codigo-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Descripción:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" name="descripcion" value="{{old('descripcion', $smenu->descripcion ?? '')}}" maxlength="100" required>
                <span class="text-danger error-text descripcion-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Ruta:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" name="ruta" value="{{old('ruta', $smenu->ruta ?? 'develop')}}" maxlength="100" required placeholder="develop">
                <span class="text-danger error-text ruta-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label">Grupo:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" name="grupo" value="{{old('grupo', $smenu->grupo ?? '')}}" maxlength="100">
                <span class="text-danger error-text grupo-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Orden:</label>
            <div class="col-md-2">
                <input class="form-control numeric" type="number" name="indice" value="{{old('indice', $smenu->indice ?? ($vorden + 1) )}}" min="1" required readonly>
                <span class="text-danger error-text indice-error text-person"></span>
            </div>

            <label class="col-md-2 col-form-label">Icono:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="icono" id="icono" value="{{old('icono', $smenu->icono ?? '')}}" maxlength="50">
                <span class="text-danger error-text icono-error text-person"></span>
            </div>
            <div class="col-md-1">
                <i class="{{old('icono', $smenu->icono ?? '')}}" id="mostrar_icon"></i>
            </div>
        </div>
    </div>
</div>
