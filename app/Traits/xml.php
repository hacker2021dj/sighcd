<?php
namespace App\Traits;

use App\Clases\Signature;
use Carbon\Carbon;
use DOMDocument;
use Illuminate\Support\Facades\Http;
use ZipArchive;

trait xml {
    public $carpeta = '';
    public function crear_xml($idVenta = false /**SE RECIBE EL ID DE VENTA*/) {
        $doc = new DOMDocument();
        $certi = file_get_contents(asset("prueba/certificado_prueba.pfx"));

        $empresa = array(
                    'ruc'		        => '20607599727',
                    'razon_social'      => 'INSTITUTO INTERNACIONAL DE SOFTWARE S.A.C.',
                    'nombre_comercial'  => 'INSTITUTO INTERNACIONAL DE SOFTWARE S.A.C.',
                    'domicilio_fiscal'	=> '8 DE OCTUBRE N 123 - LAMBAYEQUE - LAMBAYEQUE - LAMBAYEQUE',
                    'usuario_emisor'	=> 'MODDATOS',
                    'clave_emisor'		=> 'MODDATOS',
                    'certificado'       => base64_encode($certi),
                    'clave_certificado' => 'institutoisi',
                    'ubigeo'            =>  '140101',
                    'distrito'          => 'LAMBAYEQUE',
                    'provincia'         => 'LAMBAYEQUE',
                    'departamento'      => 'LAMBAYEQUE',
                    'sede'              => '0000',
                    'contacto'          => '',
                );
        $venta = array(
                'tipo_operacion'        => '0101',
                'serie'		            => 'F001',
                'correlativo'           => '00123',
                'fecha_emision'         => Carbon::now()->format('Y-m-d'),
                'hora_emision'          => date('H:m:s'), // TAMBIEN ESTE PUEDE TENER EL VALOR DE 00:00:00
                'fecha_vencimiento'     => date('Y-m-d'),
                'cod_tipo_documento'    => '01',
                'abrstandar'            => 'PEN',
                'cod_tipo_entidad'      => '6',   // considerar del catalogo 6 tipos de documentos del cliente
                'numero_documento'      => '20605145648',
                'cliente'               => 'AGROINVERSIONES Y SERVICIOS AJINOR S.R.L. - AGROSERVIS AJINOR S.R.L.',
                'ubigeo_clinete'        => '',
                'direccion_cliente'     => 'MZA. C LOTE. 46 URB. SAN ISIDRO LA LIBERTAD - TRUJILLO - TRUJILLO'

            );
        $detallev =  array(

        );

        $nombreArchivo = $empresa['ruc'].'-'.$venta['cod_tipo_documento'].'-'.$venta['serie'].'-'.$venta['correlativo'];
        //SE LLAMA EL METODO DESARROLLO XML
        $xml = $this->desarrollo_xml($empresa, $venta, $detallev,$nombreArchivo);
        $nombreArchivo = $empresa['ruc'].'-'.$venta['cod_tipo_documento'].'-'.$venta['serie'].'-'.$venta['correlativo'];
        $this->carpeta = public_path('storage\facturacionElectronica/');
        $nombre = $this->carpeta.'xml/'.$nombreArchivo.'.XML';

        $archivo = fopen($nombre, 'w+');
        fwrite($archivo, utf8_decode($xml));
        fclose($archivo);


        // $nmobrexml = $nombreArchivo.'.xml';

         // header('Content-type: text/xml');
        // // $pruebat = $xml;
        // echo $xml;
        // return false;


        // dd(tempnam(sys_get_temp_dir(), $pruebaarvchivo));

        // $archivo = tempnam(public_path('prueba/'),$pruebaarvchivo);
        // $archivo1 = fopen($archivo,'w+');
        // fwrite($archivo1, utf8_decode($xml));
        // fclose($archivo);
        // echo fread($archivo, filesize($pruebaarvchivo));


        // $archivo = fopen($pruebaarvchivo, "w+");
        // fwrite($archivo, utf8_decode($xml));
        // fread($archivo,filesize($pruebaarvchivo));
        // fclose($archivo);


        // $prueba_xml = var_dump($archivo);



        // dd($prueba_xml);



        return [
            'nombre_archivo' => $nombreArchivo,
            'idventa'        => $idVenta,
            'empresa'        => $empresa,
        ];
    }

    private function desarrollo_xml($empresa, $venta, $detalle,$nomArc) {
        $doc = new DOMDocument();

        //VARIABES ADICIONALES
        $ublVersionId = '2.1';
        $costumezationId = '2.0';
        $numItems = count($detalle);

        //================================  ELABORACION DE XML =====================================================
        $xml = '<?xml version="1.0" encoding="utf-8"?>
            <Invoice xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ccts="urn:un:unece:uncefact:documentation:2" xmlns:ds="http://www.w3.org/2000/09/xmldsig#" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2">
            <ext:UBLExtensions>
                <ext:UBLExtension>
                    <ext:ExtensionContent/>
                </ext:UBLExtension>
            </ext:UBLExtensions>
            <cbc:UBLVersionID>'. $ublVersionId .'</cbc:UBLVersionID>
            <cbc:CustomizationID schemeAgencyName="PE:SUNAT">'. $costumezationId .'</cbc:CustomizationID>
            <cbc:ProfileID schemeName="Tipo de Operacion" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo51">'. $venta['tipo_operacion'] .'</cbc:ProfileID>
            <cbc:ID>'.$venta['serie'].'-'.$venta['correlativo'].'</cbc:ID>
            <cbc:IssueDate>'.$venta['fecha_emision'].'</cbc:IssueDate>
            <cbc:IssueTime>'.$venta['hora_emision'].'</cbc:IssueTime>
            <cbc:DueDate>'.$venta['fecha_vencimiento'].'</cbc:DueDate>
            <cbc:InvoiceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01" listID="'.$venta['tipo_operacion'].'" name="Tipo de Operacion">'.$venta['cod_tipo_documento'].'</cbc:InvoiceTypeCode>
            <cbc:DocumentCurrencyCode listID="ISO 4217 Alpha" listName="Currency" listAgencyName="United Nations Economic Commission for Europe">'.$venta['abrstandar'].'</cbc:DocumentCurrencyCode>
            <cbc:LineCountNumeric>'.$numItems.'</cbc:LineCountNumeric>
            <cac:Signature>
                <cbc:ID>'.$venta['serie'].'-'.$venta['correlativo'].'</cbc:ID>
                <cac:SignatoryParty>
                    <cac:PartyIdentification>
                        <cbc:ID>'.$empresa['ruc'].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name><![CDATA['.$empresa['razon_social'].']]></cbc:Name>
                    </cac:PartyName>
                </cac:SignatoryParty>
                <cac:DigitalSignatureAttachment>
                    <cac:ExternalReference>
                        <cbc:URI>#facCopyCen</cbc:URI>
                    </cac:ExternalReference>
                </cac:DigitalSignatureAttachment>
            </cac:Signature>
            <cac:AccountingSupplierParty>
                <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeID="6">'.$empresa['ruc'].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name><![CDATA['.$empresa['nombre_comercial'].']]></cbc:Name>
                    </cac:PartyName>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA['.$empresa['razon_social'].']]></cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI">'.$empresa['ubigeo'].'</cbc:ID>
                            <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">'.$empresa['sede'].'</cbc:AddressTypeCode>
                            <cbc:CityName>'.$empresa['provincia'].'</cbc:CityName>
                            <cbc:CountrySubentity>'.$empresa['departamento'].'</cbc:CountrySubentity>
                            <cbc:District>'.$empresa['distrito'].'</cbc:District>
                            <cac:AddressLine>
                                <cbc:Line>'.$empresa['domicilio_fiscal'].'</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country">PE</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                    <cac:Contact>
                        <cbc:Name><![CDATA['.$empresa['contacto'].']]></cbc:Name>
                    </cac:Contact>
                </cac:Party>
            </cac:AccountingSupplierParty>
            <cac:AccountingCustomerParty>
                <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeID="'.$venta['cod_tipo_entidad'].'" schemeName="Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$venta['numero_documento'].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name><![CDATA['.$venta['cliente'].']]></cbc:Name>
                    </cac:PartyName>
                    <cac:PartyTaxScheme>
                        <cbc:RegistrationName><![CDATA['.$venta['cliente'].']]></cbc:RegistrationName>
                        <cbc:CompanyID schemeID="'.$venta['cod_tipo_entidad'].'" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$venta['numero_documento'].'</cbc:CompanyID>
                        <cac:TaxScheme>
                            <cbc:ID schemeID="'.$venta['cod_tipo_entidad'].'" schemeName="SUNAT:Identificador de Documento de Identidad" schemeAgencyName="PE:SUNAT" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$venta['numero_documento'].'</cbc:ID>
                        </cac:TaxScheme>
                    </cac:PartyTaxScheme>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName><![CDATA['.$venta['cliente'].']]></cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:ID schemeName="Ubigeos" schemeAgencyName="PE:INEI"/>
                            <cbc:CityName><![CDATA[]]></cbc:CityName>
                            <cbc:CountrySubentity><![CDATA[]]></cbc:CountrySubentity>
                            <cbc:District><![CDATA[]]></cbc:District>
                            <cac:AddressLine>
                                <cbc:Line><![CDATA['.$venta['direccion_cliente'].']]></cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listID="ISO 3166-1" listAgencyName="United Nations Economic Commission for Europe" listName="Country"/>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:AccountingCustomerParty>
            <cac:PaymentTerms>
                <cbc:ID>FormaPago</cbc:ID>
                <cbc:PaymentMeansID>Contado</cbc:PaymentMeansID>
            </cac:PaymentTerms>
            <cac:TaxTotal>
                <cbc:TaxAmount currencyID="'.$venta['abrstandar'].'">28.22</cbc:TaxAmount>
                <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID="PEN">156.78</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID="PEN">28.22</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">S</cbc:ID>
                        <cac:TaxScheme>
                            <cbc:ID schemeID="UN/ECE 5153" schemeAgencyID="6">1000</cbc:ID>
                            <cbc:Name>IGV</cbc:Name>
                            <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                </cac:TaxSubtotal>
            </cac:TaxTotal>
            <cac:LegalMonetaryTotal>
                <cbc:LineExtensionAmount currencyID="'.$venta['abrstandar'].'">156.78</cbc:LineExtensionAmount>
                <cbc:TaxInclusiveAmount currencyID="'.$venta['abrstandar'].'">185.00</cbc:TaxInclusiveAmount>
                <cbc:PayableAmount currencyID="'.$venta['abrstandar'].'">185.00</cbc:PayableAmount>
            </cac:LegalMonetaryTotal>
            <cac:InvoiceLine>
                <cbc:ID>1</cbc:ID>
                <cbc:InvoicedQuantity unitCode="NIU" unitCodeListID="UN/ECE rec 20" unitCodeListAgencyName="United Nations Economic Commission for Europe">1</cbc:InvoicedQuantity>
                <cbc:LineExtensionAmount currencyID="'.$venta['abrstandar'].'">156.78</cbc:LineExtensionAmount>
                <cac:PricingReference>
                    <cac:AlternativeConditionPrice>
                        <cbc:PriceAmount currencyID="'.$venta['abrstandar'].'">185.00</cbc:PriceAmount>
                        <cbc:PriceTypeCode listName="Tipo de Precio" listAgencyName="PE:SUNAT" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                    </cac:AlternativeConditionPrice>
                </cac:PricingReference>
                <cac:TaxTotal>
                    <cbc:TaxAmount currencyID="'.$venta['abrstandar'].'">28.22</cbc:TaxAmount>
                    <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$venta['abrstandar'].'">156.78</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$venta['abrstandar'].'">28.22</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cbc:ID schemeID="UN/ECE 5305" schemeName="Tax Category Identifier" schemeAgencyName="United Nations Economic Commission for Europe">S</cbc:ID>
                            <cbc:Percent>18</cbc:Percent>
                            <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                            <cac:TaxScheme>
                                <cbc:ID schemeID="UN/ECE 5153" schemeName="Codigo de tributos" schemeAgencyName="PE:SUNAT">1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                    </cac:TaxSubtotal>
                </cac:TaxTotal>
                <cac:Item>
                    <cbc:Description><![CDATA[FENA X L]]></cbc:Description>
                    <cac:SellersItemIdentification>
                        <cbc:ID><![CDATA[195]]></cbc:ID>
                    </cac:SellersItemIdentification>
                    <cac:CommodityClassification>
                        <cbc:ItemClassificationCode listID="UNSPSC" listAgencyName="GS1 US" listName="Item Classification">10191509</cbc:ItemClassificationCode>
                    </cac:CommodityClassification>
                </cac:Item>
                <cac:Price>
                    <cbc:PriceAmount currencyID="'.$venta['abrstandar'].'">156.78</cbc:PriceAmount>
                </cac:Price>
            </cac:InvoiceLine>
        </Invoice>';
        return $xml;
    }

    public function firmar_xml($nombreArchivo, $certificado, $pwcertificado, $baja = '') { // $ENTORNO ES SI LA EMPRESA ES BETA O DE PRODUCCION
        // $modo = ($modo == 1)
        // $carpeta = public_path('storage\facturacionElectronica/');
        $objSignature = new Signature();
        $flg_firma = "0";
        $rutaxml = $this->carpeta.'xml/'.$nombreArchivo.'.XML';
        $ruta_firma = base64_decode($certificado);
        $pass_firma = $pwcertificado;

        $objSignature->signature_xml($flg_firma, $rutaxml, $ruta_firma, $pass_firma);
    }

    public function ws_sunat($idVenta, $empresa, $nombreArchivo) {
        $zip = new ZipArchive();
        $nombrezip = $nombreArchivo.'.ZIP';
        $rutazip = $this->carpeta.'xml/'.$nombreArchivo.'.ZIP';
        $rutaxml = $this->carpeta.'xml/'.$nombreArchivo.'.XML';
        if($zip->open($rutazip, ZIPARCHIVE::CREATE) === true){
            $zip->addFile($rutaxml, $nombreArchivo.'.XML');
            $zip->close();
        }
        $contenido_zip = base64_encode(file_get_contents($rutazip));
        $xml_envio = $this->evelope($nombrezip,$contenido_zip,$empresa);
        $respuesta_s = $this->api_sunat($xml_envio,$nombreArchivo);
        return $respuesta_s;
    }

    private function evelope($nombre_zip, $content_zip, $empresa) {
        $xml_envio ='<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ser="http://service.sunat.gob.pe" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
            <soapenv:Header>
                <wsse:Security>
                    <wsse:UsernameToken>
                        <wsse:Username>'.$empresa['ruc'].$empresa['usuario_emisor'].'</wsse:Username>
                        <wsse:Password>'.$empresa['clave_emisor'].'</wsse:Password>
                    </wsse:UsernameToken>
                </wsse:Security>
            </soapenv:Header>
            <soapenv:Body>
                <ser:sendBill>
                    <fileName>'.$nombre_zip.'</fileName>
                    <contentFile>'.$content_zip.'</contentFile>
                </ser:sendBill>
            </soapenv:Body>
        </soapenv:Envelope>';

        return $xml_envio;
    }

    private function api_sunat($xml_envio,$nombreArchivo) {
        $ws = "https://e-beta.sunat.gob.pe/ol-ti-itcpfegem-beta/billService";
        $header = array(
           "Content-type: text/xml; charset=\"utf-8\"",
           "Accept: text/xml",
           "Cache-Control: no-cache",
           "Pragma: no-cache",
           "SOAPAction: ",
           "Content-lenght: ".strlen($xml_envio)
        );

        $parameters = [
            'http_errors' => false,
            'connect_timeout' => 30,
            'headers' => $header,
        ];

        $respose = Http::withBody($xml_envio,'xml')->post($ws, $parameters);
        if ($respose->status() == 200) {
            $doc = new DOMDocument();
            $doc->loadXML($respose);
            if (isset($doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue)) {
                $cdr = $doc->getElementsByTagName('applicationResponse')->item(0)->nodeValue;
                $cdr = base64_decode($cdr);

                $carpetacdr = $this->carpeta.'cdr/';

                file_put_contents($carpetacdr."R-".$nombreArchivo.'.ZIP', $cdr);
                $zip = new ZipArchive;
                if($zip->open($carpetacdr."R-".$nombreArchivo.'.ZIP') === true) {
                    $zip->extractTo($carpetacdr.'R-'.$nombreArchivo);
                    $zip->close();
                }
                echo "FACTURA ENVIADA CORRECTAMENTE <br>";
                $xml_respuesta = file_get_contents($carpetacdr.'R-'.$nombreArchivo.'/R-'.$nombreArchivo.'.XML');

                $doc->loadXML($xml_respuesta);
                $mensaje = $doc->getElementsByTagName("Description")->item(0)->nodeValue;
            } else {
                $codigo = $doc->getElementsByTagName("faultcode")->item(0)->nodeValue;
                $mensajes = $doc->getElementsByTagName("faultstring")->item(0)->nodeValue;
                $mensaje = "error ".$codigo.": ".$mensajes;
            }
        } else {
            $mensaje = 'Error en la Conexion';
        }
        return $mensaje;
        // $doc = new DOMDocument();
        //     $doc->loadXML($respose);
        // dd($respose);
        // $rpta = json_decode($res->getBody()->getContents(), true);
    }
}
