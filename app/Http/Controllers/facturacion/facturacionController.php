<?php

namespace App\Http\Controllers\facturacion;

use App\Clases\Signature;
use App\Http\Controllers\Controller;
use App\Models\configuracionSunat\empresas;
use App\Traits\xml;
use DOMDocument;
// use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SimpleXMLElement;
use ZipArchive;

class facturacionController extends Controller
{
    use xml;

    public function facturacion(Request $request)
    {
        // dd($request->all());
        // $arnom = $_FILES['file']['name'];
        // $arctipo = $_FILES['file']['type'];
        // $arctemp = $_FILES['file']['tmp_name'];

        // $arc_bin = file_get_contents($arctemp);

        // header('Content-type: text/xml');

        // echo $arc_bin;
        // header('Content-Disposition: attachment; filename="', $arnom.'"');
        // echo $arc_bin;


        // dd($arc_bin);
        // $nombre = asset("prueba/xml/20607599727-01-F001-00123.XML");
        // $fp = fopen($nombre,'rb');
        // $contenido = fread($fp);
        // dd($fp);
        // $contenido = addslashes($contenido);
        // dd($contenido);
        // fclose($fp);

        // header('Content-type: text/xml');
        // print ($contenido);



        // header('Content-Type: xml');

        // // echo $imagen;
        // dd(file_get_contents(asset('prueba/xml/20607599727-01-F001-00123.XML')));



        // echo '<img src = "data:image/png;base64,' . base64_encode(file_get_contents("https://i.imgur.com/cCc9Gw9.png")) . '" width = "50px" height = "50px"/>';
        // <img src="data:image/png;base64,'.base64_encode(file_get_contents("https://i.imgur.com/cCc9Gw9.png")).'/>');



        $rpta = $this->crear_xml();
        $idVenta = $rpta['idventa'];
        $nombreArchivo = $rpta['nombre_archivo'];
        $certificado = $rpta['empresa']['certificado'];
        $pwCerti = $rpta['empresa']['clave_certificado'];
        $empresa = $rpta['empresa'];

        $this->firmar_xml($nombreArchivo,$certificado,$pwCerti);
        $r_sunat = $this->ws_sunat($idVenta,$empresa,$nombreArchivo);
        echo $r_sunat;
    }
}
