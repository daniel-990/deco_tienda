    <?php 
        include "./partials/header.php"; 
        include "./vendor/autoload.php";
    ?>

    <section id="render-notificaciones">
        <div id="render" class="container">
            <!-- render notificaciones -->
            <h5 class="text-center">
                <br>
                Notificaciones de pedido, de la tienda
            </h5>
            <p class="text-center">
                <div id="carga" clasS="text-center">
                    <img src="./img/load.gif" alt="">
                    <p>
                        Buscando nuevos pedidos
                    </p>
                </div>
            </p>
        </div>
    </section>
    <?php include "./partials/footer.php"; ?>