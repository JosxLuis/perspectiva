<?php
function mostrarNombre($id,$tabla,$campo){
  $nombre = devolverValorQuery("SELECT ".$campo." FROM ".DB_PREFIJO.$tabla." WHERE id".DB_PREFIJO.$tabla."=".$id."");
  return $nombre[$campo];
}

function mostrarActivo($id){
  switch ($id) {
    case 0:
      $status = "Inactivo";
      break;
    case 1:
      $status = "Activo";
      break;
    default:
      $status = "No definido";
      break;
  }
  return $status;
}

function tiempoDesde($fecha){
  $date1 = new DateTime($fecha);
  $date2 = new DateTime();
  $sinceThen = $date2->diff($date1)->format("%a");
 
  if($sinceThen == 0){
    $periodo = "Hoy";
    return $periodo;
  }
  if($sinceThen < 7){
    if($sinceThen == 1){
      $dia = "día";
    }else{
      $dia = "días";
    }

    $periodo = 'hace '.$sinceThen.' '.$dia;
    return $periodo;
  }else{
    $periodo = floor($sinceThen/7);
    if($periodo == 1){
      $semana = "semana";
    }else{
      $semana = "semanas";
    }
    return 'hace '.$periodo.' '.$semana;
  }
}

function enviar_correo($correo,$nombre,$asunto,$mensaje){
    require_once('lib/phpmailer/class.phpmailer.php');

    $mail = new PHPMailer();

            //Tell PHPMailer to use SMTP
            $mail->isSMTP();

            //Enable SMTP debugging
            // 0 = off (for production use)
            // 1 = client messages
            // 2 = client and server messages
            $mail->SMTPDebug = 0;

            //Ask for HTML-friendly debug output
            $mail->Debugoutput = 'html';

            //Set the hostname of the mail server
            //$mail->Host = 'smtp.gmail.com'; // CIRG
            /*$mail->Host = 'relay-hosting.secureserver.net';*/
            $mail->Host = 'a2plcpnl0479.prod.iad2.secureserver.net';

            //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission and use 465 for ssl
            $mail->Port = 587; //CIRG
            /*$mail->Port = 25;*/

            //Set the encryption system to use - ssl (deprecated) or tls
          /*$mail->SMTPSecure = 'ssl'; CIRG*/
            $mail->SMTPSecure = 'tls';


            //Whether to use SMTP authentication
            $mail->SMTPAuth = true;

            //Username to use for SMTP authentication - use full email address for gmail
            $mail->Username = "notificaciones@thundertechnology.mx";

            //Password to use for SMTP authentication
            $mail->Password = "supr3m0k4!o";

            //Set who the message is to be sent from
            $mail->setFrom('notificaciones@thundertechnology.mx', 'Thunder Technology');

            //Set an alternative reply-to address

            //Set who the message is to be sent to
            $mail->addAddress($correo, $nombre);

            //Set the subject line
            $mail->Subject = $asunto;

            //Read an HTML message body from an external file, convert referenced images to embedded,
            //convert HTML into a basic plain-text alternative body
            $mail->msgHTML($mensaje);

            $mail->CharSet = 'UTF-8';
            //Replace the plain text body with one created manually
            //$mail->AltBody = 'This is a plain-text message body';

            //Attach an image file
            //$mail->addAttachment('images/phpmailer_mini.png');

            //send the message, check for errors
            if (!$mail->send()) {
                $error = "0-El mensaje no se ha enviado por este error: ".$mail->ErrorInfo;
                return $error;
            } else {
                //$succes = "Enviado";
                $success = "1-El mensaje se ha enviado con éxito";
                return $success;
            }

}
function limpiar_cadena($string)
{

    $string = trim($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'e', 'e', 'e', 'e'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'i', 'i', 'i', 'i'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'o', 'o', 'o', 'o'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'u', 'u', 'u', 'u'),
        $string
    );

    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'n', 'c', 'c',),
        $string
    );

    $string = str_replace(
        array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'),
        array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'),
        $string
    );

    //Esta parte se encarga de eliminar cualquier caracter extraño
    $string = str_replace(
        array("\\", "¨", "º", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".","®","º","°"),
        '',
        $string
    );

    $string = str_replace(" ","-",$string);


    return $string;
}
function curPageURL() {
     $pageURL = 'http';
     if ( isset( $_SERVER["HTTPS"] ) && strtolower( $_SERVER["HTTPS"] ) == "on" ) { $pageURL .= "s";}
     $pageURL .= "://";
     if ($_SERVER["SERVER_PORT"] != "80") {
      $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
     } else {
      $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
     }
     return $pageURL;
}
?>