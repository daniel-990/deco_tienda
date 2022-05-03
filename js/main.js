const init = () => {

    //datos url
    let urlSitioTienda = "https://decohouse.com.co/decohouse-tienda/";

    //datos url conexion
    const url_ = "http://localhost:8080/deco_tienda/_notificacion.php";
    const urlBot = "http://localhost:8080/deco_tienda/_bot.php";
    let notificacion = false;
    //anterior = 8146;
    let contador = 12626;
    //productos;
    let nombreProducto;
    let imagenProducto;
    let subTotalProducto;
    let multimedia = [];
    let parametros = [];

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

                    /**
                     * order status:
                     * pending
                     * processing
                     * on-hold -> epayco-on-hold
                     * completed
                     * cancelled
                     * refunded
                     * failed
                     * trash
                     * pending
                     */
                    // console.log(items.id);
                    // console.log(items.status);
                    if(items.id > contador && items.status == "epayco-on-hold"){
                        const img = items.line_items;
                        //datos de la imagen
                        
                        for (let i = 0; i < img.length; i++) {

                            const element = img[i];
                            nombreProducto = element.name;
                            subTotalProducto = element.subtotal;
                            imagenProducto = urlSitioTienda+"producto/?p="+element.product_id;

                            multimedia.push(nombreProducto,subTotalProducto,imagenProducto);
                        }
                        parametros = {
                            id : items.id,
                            nombre : items.billing.first_name,
                            apellido : items.billing.last_name,
                            telefono : items.billing.phone,
                            correo : items.billing.email,
                            fecha : items.date_created,
                            numeroOrden : items.number, //numero de la orden
                            totalApagar : items.total, //total de la orden
                            direccion : items.billing.address_1,
                            ciudad : items.billing.city,
                            _multimedia : multimedia
                        } 
                        //console.log(parametros._multimedia);
                        notificacion = true;
                        //notificacion = confirm("Nuevo Pedido, por favor aceptar.");
                        if(notificacion == true){
                            envioDatosBot(parametros);
                            console.log("nuevo pedido!");
                            contador = items.id;
                            multimedia = [];
                            //contador del pedido
                            console.log(contador);
                            notificacion = false;
                        }else{
                            //console.log("no ingreso nada");
                            // console.log(contador);
                        }

                    }else{
                        // console.log("sin pedidos nuevos");
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
                ciudadOrden: parametros.ciudad,
                _multimedia : parametros._multimedia
            }),  
            success: function(response) {
                console.log(response);
            },
            error: function(err) {
                console.log(err);
            }        
        })
    }
    //actualizarEstadoPedido(); 
    setInterval(function(){
        actualizarEstadoPedido();
     }, 10000);

}

init();