<?php
include_once 'DBClass.php';
$consultas = new DBClass();

    if($_GET["selec"]==1){

      //$respuesta=$consultas->obtener_id_usuario();

        //$resul= json_encode($consultas->obtener_id_usuario());
        echo json_encode($consultas->obtener_id_usuario());

    }
    elseif($_GET["selec"]==2){

      //$respuesta=$consultas->obtener_id_area_recepcion();

        //$resul= json_encode($consultas->obtener_id_usuario());
        echo json_encode($consultas->obtener_id_area_recepcion());

    }
    elseif($_GET["selec"]==3){

      //$respuesta=$consultas->obtener_id_area_recepcion();

        //$resul= json_encode($consultas->obtener_id_usuario());
        echo json_encode($consultas->obtener_id_area_entrega());

    }

 ?>
