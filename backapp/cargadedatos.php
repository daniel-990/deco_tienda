<?php

        require '../constantes/conectar.php';

        $nombre = $_POST['nombre-experto'];

        // conexión
        $mysqli = @new mysqli(SERVER, USER, PASS, DB);

        if(isset($_POST)){
                $filename = $_FILES["archivo"]["name"];
                $info = new SplFileInfo($filename);
                $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

                if($extension == 'csv'){

                        $filename = $_FILES['archivo']['tmp_name'];
                        $handle = fopen($filename, "r");

                        while(($data = fgetcsv($handle, 1000, ",","'")) !== FALSE ){
                                // $q = "INSERT INTO tbl_productos (
                                //         id, 
                                //         nombre, 
                                //         correo) VALUES (
                                //         '$data[0]',
                                //         '$data[1]',
                                //         '$data[2]'
                                // )";
                        // $mysqli->query($q);
                                echo "<pre>";
                                        print_r($data);
                                echo "</pre>";
                        }
                        fclose($handle);
                        echo "se cargo";
                }else{
                        echo "archivo no reconocido";
                }     
        }else{
                
        }


?>