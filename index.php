    <?php 
        include "./partials/header.php"; 
    ?>


    <section class="container">
        Carga de la base de datos:
        <br>
        <form enctype="multipart/form-data" method="POST" action="./backapp/cargadedatos.php">
            <br>
            CSV File:
            <br>
            <input type="file" name="archivo" id="archivo">
            <br>
            <br>
            <button type="submit" class="btn btn-primary text-left">Enviar <i class="far fa-share-square"></i></button>
        </form>

    </section>

    <?php include "./partials/footer.php"; ?>