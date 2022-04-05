<?php 

include('vendor/autoload.php');
require 'constantes/constantes.php';

//$mensaje = $_POST['mensaje'];
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
$numeroOrden = $_POST['numeroOrden'];
$total = $_POST['total'];
$direccion = $_POST['direccion'];
$ciudadOrden = $_POST['ciudadOrden'];
//productos
$multimedia = $_POST['_multimedia'];
$datos = "";

$mensaje = "
    ID: ".$id." 
    nombre: ".$nombre." 
    apellido: ".$apellido." 
    telefono: ".$telefono." 
    correo: \n".$correo." 
    telefono: ".$telefono." 
    numero de la orden: ".$numeroOrden." 
    total a pagar: ".$total." 
    direccion: ".$direccion." 
    ciudad: ".$ciudadOrden;

use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$loop = \React\EventLoop\Factory::create();
$handler = new HttpClientRequestHandler($loop);
$tgLog = new TgLog(APIBOT, $handler);

if(isset($_POST)){
    //para acceder dentro del ciclo a sus datos
    foreach ($multimedia as &$valor) {
        $datos.=$valor."\n";
    }
    $datos = substr($datos,0,-1);//para eliminar la ultima coma (de tu post anterior);
    // foreach($multimedia as $valor){
    //     $datos.=$valor['nombre']."\n".$valor['sub']."$\n <a>".$valor['imagen']."</a>\n";
    // }
    // $datos = substr($datos,0,-1);//para eliminar la ultima coma (de tu post anterior)
    //echo "<b>Nuevo pedido:</b> ".$mensaje." \n <b>Items comprados:</b> \n".$datos;
    $sendMessage = new SendMessage();
    $sendMessage->chat_id = IDCHAT;
    $sendMessage->text = "<b>Nuevo pedido:</b> ".$mensaje." \n <b>Items comprados:</b> \n".$datos;
    $sendMessage->parse_mode = "HTML";
    $tgLog->performApiRequest($sendMessage);
    $loop->run();
    echo "datos enviados";
    exit;
}else{
    echo "no se enviaron los datos";
}

?>