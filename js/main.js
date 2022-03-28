const init = () => {

    //datos url
    const url_ = "http://localhost:8888/deco_tienda/notificacion.php";

    const actualizarEstadoPedido = () => {
        jQuery.ajax({
            url: url_,
            method: 'GET',
            crossDomain: true,
            beforeSend: function ( xhr ) {
                $("#carga").show();
            },
            success: function( data, txtStatus, xhr ){
                $("#carga").hide();
                //actualizacion de ordenes
                data.map(items => {
                    if(items.id > 8107 && items.status == "on-hold"){
                        alert("se tiene una nueva actualizacion de pedido");
                        console.log(items.id);
                        console.log(items.status);

                    }else{
                        console.log("sin actualizaciones");
                    }
                });
                console.log("Estado: " +xhr.status );
            }
         });
    }
    //actualizarEstadoPedido();
     setInterval(function(){
        actualizarEstadoPedido();
        console.log("se actualiza");
     }, 10000);

}

init();