const init = () => {

    //datos url
    const url_ = "http://localhost:8888/deco_tienda/_notificacion.php";
    const urlBot = "http://localhost:8888/deco_tienda/_bot.php";
    let noticacion;
    let contador = 8110;

    //se toman las actualizaciones de datos de ordenes de la tienda
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
                    if(items.id > contador && items.status == "on-hold"){

                        const parametros = {
                            id : items.id,
                            nombre : items.billing.first_name,
                            apellido : items.billing.last_name,
                            telefono : items.billing.phone,
                            correo : items.billing.email,
                            fecha : items.date_created,
                            numeroOrden : items.number, //numero de la orden
                            totalApagar : items.total, //total de la orden
                            direccion : items.billing.address_1,
                            ciudad : items.billing.city
                        }
                        
                        noticacion = confirm("Nuevo Pedido, por favor aceptar.");

                        if(noticacion == true){
                            envioDatosBot(parametros);
                            console.log("nuevo pedido!");
                            contador = items.id;
                            console.log(contador);
                        }else{
                            console.log("no ingreso nada");
                            console.log(contador);
                        }
                    }else{
                        console.log("sin pedidos nuevos");
                    }
                });
                //console.log("Estado: " +xhr.status );
            }
         });
    }

    let envioDatosBot = (parametros) => {
        jQuery.ajax({
            url:urlBot,
            method: 'POST',
            crossDomain: true,
            data: ({
                id: parametros.id,
                nombre: parametros.nombre,
                apellido: parametros.apellido,
                telefono: parametros.telefono,
                correo: parametros.correo,
                fecha: parametros.fecha,
                numeroOrden: parametros.numeroOrden,
                total: parametros.totalApagar,
                direccion: parametros.direccion,
                ciudadOrden: parametros.ciudad
            }),  
            success: function(response) {
                console.log(response);
            },
            error: function(err) {
                console.log(err);
            }        
        })
    }

    setInterval(function(){
        actualizarEstadoPedido();
     }, 10000);

}

init();