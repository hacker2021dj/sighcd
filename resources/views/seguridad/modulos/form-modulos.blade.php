<div class="row">
    <div id="vl"></div>
    <div class="callout callout-info">
        <div class="row">
            <div class="card-title text-info text-uppercase font-weight-bold"></div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Código:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" name="codigo" value="{{old('codigo', $menu->codigo ?? '')}}" maxlength="15" required>
                <span class="text-danger error-text codigo-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Descripción:</label>
            <div class="col-md-9">
                <input class="form-control" type="text" name="descripcion" value="{{old('descripcion', $menu->descripcion ?? '')}}" maxlength="100" required>
                <span class="text-danger error-text descripcion-error text-person"></span>
            </div>
        </div>

        <div class="mb-3 row">
            <label class="col-md-3 col-form-label requerido">Orden:</label>
            <div class="col-md-2">
                <input class="form-control numeric" type="number" name="indice" value="{{old('indice', $menu->indice ?? ($vorden + 1) )}}" min="1" required readonly>
                <span class="text-danger error-text indice-error text-person"></span>
            </div>

            <label class="col-md-2 col-form-label">Icono:</label>
            <div class="col-md-4">
                <input class="form-control" type="text" name="icono" id="icono" value="{{old('icono', $menu->icono ?? '')}}" maxlength="50">
                <span class="text-danger error-text icono-error text-person"></span>
            </div>
            <div class="col-md-1">
                <i class="{{old('icono', $menu->icono ?? '')}}" id="mostrar_icon"></i>
            </div>
        </div>
    </div>
</div>
