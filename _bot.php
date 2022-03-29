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

$mensaje = "
    ID: ".$id." 
    nombre: ".$nombre." 
    apellido: ".$apellido." 
    telefono: ".$telefono." 
    correo: ".$correo." 
    telefono: ".$telefono." 
    correo: ".$correo." 
    fecha: ".$fecha. " 
    numero de la orden: ".$numeroOrden." 
    total: ".$total." 
    direccion: ".$direccion." 
    ciudad: ".$ciudadOrden;

use \unreal4u\TelegramAPI\HttpClientRequestHandler;
use \unreal4u\TelegramAPI\TgLog;
use \unreal4u\TelegramAPI\Telegram\Methods\SendMessage;

$loop = \React\EventLoop\Factory::create();
$handler = new HttpClientRequestHandler($loop);
$tgLog = new TgLog(APIBOT, $handler);

if(isset($_POST)){



    $sendMessage = new SendMessage();
    $sendMessage->chat_id = IDCHAT;
    $sendMessage->text = "Nuevo pedido: ".$mensaje;
    
    $tgLog->performApiRequest($sendMessage);
    $loop->run();
    echo "datos enviados";
    exit;

}else{
    echo "no se enviaron los datos";
}

?>