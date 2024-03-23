<?php

namespace App\Models\configuracionSunat;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class empresas extends Model
{
    use HasFactory;
    protected $table = 'empresas';
    protected $fillable = ['razon_social','nombre_comercial','ruc','domicilio_fiscal','telefono_fijo','telefono_fijo2','telefono_movil','telefono_movil2','logo','correo','ubigeo','codigo_sucursal_sunat','regimen_id','urbanizacion','usuario_emisor','clave_emisor','certificado','clave_certificado','id_personal'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

}
