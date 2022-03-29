<?php 

header('Access-Control-Allow-Origin: *'); /**para evitar el bloqueo de cors para origenes desconocidos */
header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';
require 'constantes/constantes.php';

use Automattic\WooCommerce\Client;

$woocommerce = new Client(
  URLTIENDA,
  USERID,
  APIID,
  [
    'version' => 'wc/v3', //version de la api de la tienda
  ]
);
  //se convierten datos en json para luego ser consumidos en JS
  echo json_encode($woocommerce->get('orders'));
?>