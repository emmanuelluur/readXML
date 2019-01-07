<?php
namespace App\Controller;

/**
 * Leer XML
 * mostrar los resultados
 */

class InfoController
{
    public static function ReadXml($data)
    {
        if (file_exists($data)) {
            $datos = simplexml_load_file($data);
            echo json_encode($datos);
        } else {
            echo "no se encuentra archivo";
        }
        
    }
    public static function Upload()
    {
        
        $directorio = "../../upload/";
        $type = ['application/xml', 'text/xml'];
        // ruta directorio
        $fileRoute = ($directorio . basename($_FILES['file']['name'])); //   sube a directorio
        //  $imgDb = $dirDb . basename($_FILES['file']['name']); // guarda en bd
        if (in_array($_FILES['file']['type'], $type)) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $fileRoute)) {
                return $fileRoute;
            } else {
                return false;
            }
        } else {
            return false;
        }
        

    }
}



if (isset($_POST['save'])) {
    $xml = InfoController::Upload();
    if ($xml) {
        $info=InfoController::ReadXml($xml);
    } else {
        echo "error verifique que sea un xml";
    }
}
