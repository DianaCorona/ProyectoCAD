<?php
    //Declaración del Objeto $consultas de la Clase controladora DBClass.php necesaria para el control de funciones del Sistema
    include_once 'DBClass.php';
    $consultas = new DBClass();

    //Varibles Globales del Archivo (pueden ser omitidas, optimizadas para catálogos solo cambiar nombre de tabla y el ID de la misma.
    $tablabase="usuarios";
    $idbase="id_usuarios";

    //Variables Globales del Archivo (pueden ser omitidas) texto desplegado en los formularios de catálogos
    $textoencabezado="Usuarios";
    $textoencabezadoforms="Usuario";

    //Procesamiento del POST para guardar información
    if(isset($_POST['save'])){
        //obtención de variables POST y guardado en forma de Array $data
        $data['usuario'] = $_POST['nombre'];
        $data['password'] = md5(trim($_POST['password']));
        $data['id_privilegios'] = $_POST['privilegios'];
        $data['nombre'] = $_POST['nombreusr'];
        $data['appaterno'] = $_POST['appaterno'];
        $data['apmaterno'] = $_POST['apmaterno'];

<<<<<<< HEAD
        $data['fecha_alta'] = $_POST['fecha_alta'];

=======
        $data['fecha_alta'] = $_POST['fecha_alta'];       
        $data['id_areas'] = $_POST['id_areas'];
        $data['id_status'] = $_POST['id_status'];


        
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
        //Guardado de información en la tabla declarada en la variable global $tablabase y la información en forma de Array $data
        echo $consultas->to_insert($tablabase, $data);

         $bit = $consultas->obtener_ultimo_dato("usuarios");
         $bita['fecha_modificacion'] = $_POST['fecha_alta'];
         $bita['id_status'] = $_POST['id_status'];
         $bita['id_usuarios'] = $bit;        
        
         echo $consultas->to_insert('bitacora_usuarios', $bita);

        die();
    }

    //Procesamiento del POST para eliminar información
    if(isset($_POST['delete'])){
        //ejecución de "Delete" en la BD en la tabla declarada en la variable global $tablabase y el $idbase junto al POST recibido con ID a eliminar
        echo $consultas->to_delete($tablabase,$idbase."='".$_POST['delete']."' ");
        die();
    }

    //Procesamiento del POST para actualizar información
    if(isset($_POST['update'])){
        //obtención de variables POST y guardado en forma de Array $data
        $data['usuario'] = $_POST['nombre'];
        $data['id_privilegios'] = $_POST['privilegios'];
        $data['nombre'] = $_POST['nombreusr'];
        $data['appaterno'] = $_POST['appaterno'];
        $data['apmaterno'] = $_POST['apmaterno'];

        $data['id_areas'] = $_POST['id_areas'];
        $data['id_status'] = $_POST['id_status'];
        

        if($_POST['password']!==""){
            $data['password'] = md5(trim($_POST['password']));
        }

<<<<<<< HEAD
=======
        $antes = $consultas->obtener_por_id("usuarios", $_POST['update'],"id_status");
        if ($data['id_status'] != $antes) {
            $bita['fecha_modificacion'] = $_POST['fecha_modificacion'];
            $bita['id_status'] = $_POST['id_status'];
            $bita['id_usuarios'] = $_POST['update']; 
            echo $consultas->to_insert('bitacora_usuarios', $bita);
        }
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
        //Guardado de información en la tabla declarada en la variable global $tablabase y la información en forma de Array $data
        echo $consultas->to_update($tablabase, $data, $idbase."='".$_POST['update']."'");

        die();
    }

    //Función de procesamiento para obtener información de una tabla por transacción AJAX return JSON con la información de la misma.
    if(isset($_POST['obtener_info'])){
        $informacion=array();

        $data = $consultas->obtener_datos_condicion($_POST['obtener_info'], $idbase."='".$_POST['id']."' ");
        while ($row = mysql_fetch_array($data)){
            for($i=0; $i<(count($row)/2); $i++){
                unset($row[$i]);
            }
            foreach ($row as $key => $value) {
                $informacion[$key]=$value;
            }
        }

        echo (json_encode(array($informacion)));

        die();
    }

    //Validación de SESION
    session_start();
    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('Mexico/General');
    if((!isset($_SESSION['autorizacionrm']))||($_SESSION['autorizacionrm']==false))
    {
        header("Location: index.php");
        $consultas->destruirSesion();
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Sistema Record</title>
        <meta name="description" content="Sistema de control de inventarios">
        <meta name="author" content="PARANOIT.mx">
        <meta name="HandheldFriendly" content="True">
        <meta name="MobileOptimized" content="320">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <!-- Place favicon.ico and apple-touch-icon(s) here  -->

        <link rel="shortcut icon" href="img/favicon.ico">
        <link rel="apple-touch-icon-precomposed" href="img/touch-icon.57.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/touch-icon.72.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/touch-icon.114.png">
        <link rel="apple-touch-startup-image" href="img/splash.320x460.png" media="screen and (min-device-width: 200px) and (max-device-width: 320px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash.768x1004.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="img/splash.1024x748.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">

        <!-- load inks css from the cdn -->

        <!--Archivos CSS de INK, y Fuentes-->
        <link rel="stylesheet" type="text/css" href="css/ink.css">
        <link rel="stylesheet" type="text/css" href="css/quick-start.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
        <link rel="stylesheet" type="text/css" href="css/ink-flex.min.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">

		<!-- <link rel="stylesheet" type="text/css" href="css/style2.css"> -->
		<!--<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700' rel='stylesheet' type='text/css'>-->
        <!--[if IE 7 ]>
            <link rel="stylesheet" href="../css/ink-ie7.css" type="text/css" media="screen" title="no title" charset="utf-8">
        <![endif]-->

        <!--Archivo CSS de Data Tables-->
        <link href="datatables/jquery.dataTables.css" rel="stylesheet" type="text/css"/>

        <!--Archivo CSS para plugin Chosen para listas desplegables -->
        <!--<link rel="stylesheet" type="text/css" href="css/chosen.css">-->

        <!--Plugin JS de INK y JQUERY (Esqueleto del funcionamiento de los sistemas)!-->
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>
	    <script type="text/javascript" src="js/holder.js"></script>
        <script type="text/javascript" src="js/ink.min.js"></script>
        <script type="text/javascript" src="js/ink-ui.min.js"></script>
        <script type="text/javascript" src="js/ink-all.min.js"></script>
        <script type="text/javascript" src="js/autoload.js"></script>

        <!--Plugin chosen para listas desplegables!-->
        <!--<script type="text/javascript" src="js/chosen.jquery.js"></script>-->

        <!--Plugin para control de datatables!-->
        <script src="datatables/jquery.dataTables.js" type="text/javascript"></script>

        <!-- Script Principal de control de la página en general-->
        <script>
            $(document).ready(function(){
                //Página a la que se realizarán las peticiones AJAX y solicitudes de información
                var paginaact="usuarios.php";

                //Configuración de la tabla DataTables para muestreo de información
                var table = $('#informacion').dataTable( {
                    "oLanguage": {
                        "sSearch": "Buscar:",
                        "sInfoEmpty": "No existen resultados para mostrar",
                        "sInfoFiltered": " (filtrado de _MAX_ registros en total)",
                        "sLoadingRecords": "Por favor espere - cargando...",
                        "sZeroRecords": "No existen registros para mostrar",
                        "sEmptyTable": "No existe información en la tabla",
                        "sProcessing": "Procesando...",
                        "sLengthMenu": 'Ver <select>'+
                        '<option value="10">10</option>'+
                        '<option value="25">25</option>'+
                        '<option value="50">50</option>'+
                        '<option value="100">100</option>'+
                        '</select> Registros',
                        "sInfo": "Mostrando _START_ - _END_ de _TOTAL_ registros",
                        "oPaginate": {
                            "sPrevious": "Anterior",
                            "sNext": "Siguiente"
                          }
                      }
                } );

                //Deshabilitar el submit por default de los formularios Agregar y Modificar
                $('#Formagregar').submit(function(e){
                    e.preventDefault();
                });
                $('#FormModifica').submit(function(e){
                    e.preventDefault();
                });

                //***************Control de las funciones de la página**********************//

                //Insertar Nuevo Registro
                $('#save').click(function(e){
                    e.preventDefault();

                    if(!valida("#FormAgrega")){
                        return;
                    }

                    var d = new Date();
<<<<<<< HEAD
                    var Fecha=d.getFullYear() + "-"+d.getMonth()+"-"+d.getDay();
=======
                    var Fecha=d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
                    //var Fecha = string.concat;
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427

                    var nombre= $('#nombre').val();
                    var password= $('#password').val();
                    var nombreusr= $('#nombreusr').val();
                    var appaterno= $('#appaterno').val();
                    var apmaterno= $('#apmaterno').val();
                    var privilegios= $('#privilegios').val();
                    var id_areas= $('#id_areas').val();
                    var id_status= $('#id_status').val();
                    var fecha_alta= Fecha;

                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formagregar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });

                    var formData = new FormData();
                    formData.append('save','true');
                    formData.append('nombre',nombre);
                    formData.append('password',password);
                    formData.append('nombreusr',nombreusr);
                    formData.append('appaterno',appaterno);
                    formData.append('apmaterno',apmaterno);
                    formData.append('privilegios',privilegios);
                    formData.append('id_areas',id_areas);
                    formData.append('id_status',id_status);


                    formData.append('fecha_alta',fecha_alta);

                    senddata(formData);
                });

                //Mostrar Advertencia de Eliinacion de Registro
                $('#informacion').on('click','a.eliminar',function(e){
                    e.preventDefault();
                    var id= $(this).attr('id-accion');
                    $('#delete').attr('id-accion',id);

                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formeliminar');
                        var modalObj = new Modal( modalElement );
                        modalObj.open();
                    });

                });

                //Eliminar Registro
                $('#delete').click(function(e){
                    e.preventDefault();

                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formeliminar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });
                    return;
                    var id= $(this).attr('id-accion');
                    var formData = new FormData();
                    formData.append('delete',id);

                    senddata(formData);
                });

                //Mostrar Form para Modificar
                $('#informacion').on('click','a.modificar',function(e){
                    e.preventDefault();
                    var id = $(this).attr('id-accion');
                    var usuario = "";
                    var privilegios = 0;
                    var nombre = "";
                    var appaterno = "";
                    var apmaterno = "";
<<<<<<< HEAD
=======
                    var apmaterno = "";
                    var id_areas = "";
                    var id_status = "";
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427

                    var infoData = new FormData();
                    infoData.append('obtener_info',"usuarios");
                    infoData.append('id',id);

                    jQuery.each(obtener_info(infoData), function(){
                        usuario= this.usuario;
                        privilegios= this.privilegios;
                        nombre= this.nombre;
                        appaterno= this.appaterno;
                        apmaterno= this.apmaterno;
                        id_areas=this.id_areas;
                        id_status=this.id_status;
                    });

                    $('#idm').val(id);
                    $('#nombrem').val(usuario);
                    $('#nombreusrm').val(nombre);
                    $('#appaternom').val(appaterno);
                    $('#apmaternom').val(apmaterno);
                    $('#privilegiosm').val(privilegios);
<<<<<<< HEAD
=======
                    $('#id_areasm').val(id_areas);
                    $('#id_statusm').val(id_status);
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427

                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formmodificar');
                        var modalObj = new Modal( modalElement );
                        modalObj.open();
                    });
                });

                //Modificar Registro
                $('#modif').click(function(e){
<<<<<<< HEAD
=======
                    debugger;
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
                    e.preventDefault();

                    if(!valida("#FormModifica")){
                        return;
                    }
<<<<<<< HEAD
=======
                    var d = new Date();
                    var Fecha=d.getFullYear()+'-'+(d.getMonth()+1)+'-'+d.getDate();
                    var fecha_modificacion= Fecha;
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427

                    var id= $('#idm').val();
                    var usuario= $('#nombrem').val();
                    var nombreusr= $('#nombreusrm').val();
                    var appaterno= $('#appaternom').val();
                    var apmaterno= $('#apmaternom').val();
                    var privilegios= $('#privilegiosm').val();
                    var id_areas= $('#id_areasm').val();
                    var id_status= $('#id_statusm').val();
                    var password= $('#passwordm').val();

                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formmodificar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });

<<<<<<< HEAD
=======

>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
                    var formData = new FormData();
                    formData.append('update',id);
                    formData.append('nombre',usuario);
                    formData.append('nombreusr',nombreusr);
                    formData.append('appaterno',appaterno);
                    formData.append('apmaterno',apmaterno);
                    formData.append('privilegios',privilegios);
                    formData.append('password',password);
<<<<<<< HEAD
=======
                    formData.append('id_areas',id_areas);
                    formData.append('id_status',id_status);
                    formData.append('fecha_modificacion',fecha_modificacion);
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
                    senddata(formData);
                });

                //********************Ejecutar Acciones Ajax********************//
                function senddata(formData){
                    $.ajax({
                        url: paginaact,
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        //mientras enviamos el archivo
                        beforeSend: function(){
                            $('#carga').attr('style','top: '+((($(window).height() / 2) -10)+$('#carga').offset().top)+'px;');
                            $('#carga').fadeIn('fast');
                        },
                        //una vez finalizado correctamente
                        success: function(data){
                            if(data.toString().indexOf("Error")!=-1 || data.toString().indexOf("error")!=-1){
                                $('#carga').fadeOut('fast');
                                $('#mensaje').html('Error al Realizar la Operación<BR>'+data);
                                $('#mensajes').attr('style','color: white; top: '+($(window).height() / 2 - $('#mensajes').height() / 2+$('#mensajes').offset().top)+'px;');
                                $('#mensajes').addClass('error');
                                $('#mensajes').fadeIn('slow').delay(5000).fadeOut('slow',function(){
                                });
                            }else{
                                $('#carga').fadeOut('fast');
                                $('#mensajes').attr('style','color: white; top: '+($(window).height() / 2 - $('#mensajes').height() / 2+$('#mensajes').offset().top)+'px;');
                                $('#mensaje').html('Operación Realizada Correctamente');
                                $('#mensajes').removeClass('error');
                                $('#mensajes').addClass('success');
                                $('#mensajes').fadeIn('slow').delay(500).fadeOut('slow',function(){
                                    location.reload();
                                });
                            }
                        },
                        //si ha ocurrido un error se notifica al usuario
                        error: function (xhr, ajaxOptions, thrownError) {
                            $('#carga').fadeOut('fast');
                            alert(xhr.status+'\n'+thrownError+'\n'+xhr.responseText);
                        }
                    });
                }

                //validación de campos con clase REQUIRED de un FORM ESPECIFICO
                function valida(form){
                    var valid=true;

                    $(form+' input.required').each(function(){
                        $(this).removeClass('errorstyle');
                        if($(this).val()=="" && $(this).attr('id')){
                            $(this).addClass('errorstyle');
                            $(this).attr('placeholder','Campo Requerido');
                            valid=false;
                        }
                    });

                    $(form+' select.required').each(function(){
                        $(this).removeClass('errorstyle');
                        if($(this).val()=="" && $(this).attr('id')){
                            $(this).addClass('errorstyle');
                            valid=false;
                        }
                    });

                    return valid;
                }

                //Función para obtener informacion para el formulario de modificar
                function obtener_info(datainfo){
                    var informacion=null;

                    $.ajax({
                        url: paginaact,
                        type: 'POST',
                        data: datainfo,
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: false,
                        //mientras enviamos el archivo
                        beforeSend: function(){
                        },
                        //una vez finalizado correctamente
                        success: function(data){
                              informacion=data;
                        },
                        //si ha ocurrido un error se notifica al usuario
                        error: function (xhr, ajaxOptions, thrownError) {
//                            $('#carga').fadeOut('fast');
                            alert(xhr.status+'\n'+thrownError+'\n'+xhr.responseText);
                        }
                    });

                    //return de la información en formato JSON evaluado en forma de ARRAY
                    return eval("(" + informacion + ")");
                }

                //Ocultar Div de Precarga (Pantalla de bloqueo inicial)
                $('#precargadiv').fadeOut('fast');
            });
        </script>

    </head>

    <body  class="ink-drawer">
        <!-- Include del archivo Menu -->
        <?php include ("menu.php"); ?>

        <!-- Contenido de la Pagina en GRID de INK -->
        <div class="content-drawer" style="margin-top:50px;">
            <div class="ink-grid vspace">

                <!-- Div de bloqueo para precarga de información -->
                <div id="precargadiv">
                    <div id="precarga" class="" style="text-align: center;">
                        <img src="img/cargando.gif" style=" width: 100px; height: 100px;"/><br>
                        <b>Cargando Información. Espere...</b>
                    </div>
                </div>

                <!--******************************Div con el contenido a mostrar al usuario (tablas, información, formularios estaticos etc.-->
                <div class="column-group">
                    <div class="all-100" style="text-align: center; font-size: 22px; margin-top: 10px;">
                        <?php echo $textoencabezado; ?>
                    </div>
                    <div class="all-100">
                        <table id="informacion" class="condensed-300">
                            <thead>
                                <tr class="nohov">
                                    <th>Usuario</th>
                                    <th>Nombre</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Privilegios</th>
<<<<<<< HEAD
                                    <th>Fecha de alta</th>
=======
                                    <th>Area</th>
                                    <th>Status</th>
                                    <th>Fecha de alta</th>


>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $data=$consultas->obtener_datos("usuarios");  
                                    while ($row = mysql_fetch_array($data)){
                                        echo '<tr>
                                            <td>'.$row['usuario'].'</td>
                                            <td>'.$row['nombre'].'</td>
                                            <td>'.$row['appaterno'].'</td>
                                            <td>'.$row['apmaterno'].'</td>

                                            <td>';
<<<<<<< HEAD
                                                if($row['id_privilegios']==1){
=======
                                                if($row['privilegios']==1){
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
                                                    echo 'Administrador';
                                                }else if($row['id_privilegios']==2){
                                                    echo 'Otros';
                                                }
<<<<<<< HEAD
=======
                                                echo '</td>                                   

                                            <td>';
                                                $area=$consultas->obtener_por_id("areas",$row['id_areas'],"nombre_area");
                                                echo $area;

                                            echo '</td>

                                            <td>';
                                                $status=$consultas->obtener_por_id("status",$row['id_status'],"descripcion");
                                                echo $status;
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427
                                            echo '</td>
                                            <td>'.$row['fecha_alta'].'</td>
                                            <td style="width:50px; min-width:50px; text-align:right;">
                                                <a id-accion="'.$row[$idbase].'" class="modificar"><span class="fa fa-pencil-square-o" title="Modificar"></span></a>
                                                <a id-accion="'.$row[$idbase].'" class="eliminar"><span class="fa fa-trash-o" title="Eliminar"></span></a>
                                            </td>
                                        </tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <!--Desplegar botones de acción en caso de ser necesarios.-->
                    <div class="all-100">
                        <button id="agregar" class="ink-button red">Agregar</button>
                        <!--<button id="xlsx" class="ink-button red ">XLSX</button>-->
    <!--                    <button id="deltable" class="ink-button red ">Borrar Contenido</button>-->
                    </div>
                </div>
                <!--FIN Div con el contenido a mostrar al usuario (tablas, información, formularios estaticos etc.-->

                <!--*************************************Elementos a mostrar dinamicos (formularios en ventanas modal, advertencias, estados de carga, etc.)-->

                <!--Elemento emergente (Gif de carga de información al guardar, actualizar, elminar, etc)-->
                <div id="carga" class="" >
                    <img src="img/cargando.gif" style=" width: 100px; height: 100px;"/>
                </div>
                <!--Elemento emergente (Mensaje que despliega información de status después de guardar, actualizar, elminar, etc) en forma de alerta-->
                <div id="mensajes" class="ink-alert basic alerta" role="alert">
                    <p id="mensaje"></p>
                </div>

                <div class="push"></div>

                <!--Elemento emergente (Formulario en ventana modal para guardar información configurado por el usuario)-->
                <div id="divFormagregar" >
                    <div class="ink-shade fade">
                        <div id="Formagregar" class="ink-modal" data-trigger="#agregar" data-width="500px" data-height="560px">
                            <div class="modal-body">
                                <form id="FormAgrega" class="ink-form all-100 content-center" action="" method="post">
                                    <h5>Agregar <?php echo $textoencabezadoforms; ?></h5>
                                    <!--Formato del bloque por campo....
                                    <div
                                        <label
                                        <div
                                            <input
                                        </div>
                                    </div>
                                    -->
                                    <div class="control-group gutters">
                                        <label for="nombre" class="all-40">Usuario</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="nombre"/>
                                        </div>
                                    </div>
                                    <!--FIN Formato del bloque por campo....-->

                                    <div class="control-group gutters">
                                        <label for="password" class="all-40">Password</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="password" id="password"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="nombreusr" class="all-40">Nombre</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="nombreusr"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="appaterno" class="all-40">Apellido Paterno</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="appaterno"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="apmaterno" class="all-40">Apellido Materno</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="apmaterno"/>
                                        </div>
                                    </div>

                                    <div class="control-group gutters">
                                        <label for="privilegios" class="all-40" >Privilegios</label>
                                        <div style="" class="all-60">
                                            <select class=" all-100 required " data-placeholder="Seleccione privilegios..." id="privilegios">
                                                <option value="">Seleccione...</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Otro</option>
                                            </select>
                                        </div>
                                    </div>
<<<<<<< HEAD
=======
                                    <div class="control-group gutters">
                                        <label for="id_areas" class="all-40">Area</label>
                                        <div class="all-60">
                                            <select  class="all-100 required " data-placeholder="Seleccione area..."  id="id_areas"/>
                                                <option value="">Seleccione...</option> 
                                                <?php 
                                                    $area=$consultas->obtener_datos("areas");
                                                    while ($ar= mysql_fetch_array($area)) { ?>
                                                        <option value="<?php echo $ar['id_areas'];?>"> <?php echo $ar['nombre_area']; ?> </option> 
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="id_status" class="all-40">Status</label>
                                        <div class="all-60">
                                            <select  class="all-100 required " data-placeholder="Seleccione status..."  id="id_status"/>
                                                <option value="">Seleccione...</option> 
                                                <?php 
                                                    $Status=$consultas->obtener_datos("status");
                                                    while ($stat= mysql_fetch_array($Status)) { ?>
                                                        <option value="<?php echo $stat['id_status'];?>"> <?php echo $stat['descripcion']; ?> </option> 
                                                <?php }?>

                                            </select>
                                        </div>
                                    </div>
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="save" class="ink-button red">Agregar</button>
                                <button class="ink-button red ink-dismiss">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div> <!--FIN Form Agregar-->

                <!--Elemento emergente (Formulario en ventana modal para modificar información configurado por el usuario)-->
                <div id="divFormmodificar" >
                    <div class="ink-shade fade">
                        <div id="Formmodificar" class="ink-modal" data-trigger="#modificar" data-width="500px" data-height="560px">
                            <div class="modal-body">
                                <form id="FormModifica" class="ink-form all-100 content-center" action="" method="post">
                                    <h5>Modificar <?php echo $textoencabezadoforms; ?></h5>
                                    <div class="control-group gutters">
                                        <label for="nombrem" class="all-40">Usuario</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="nombrem"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="nombreusrm" class="all-40">Nombre</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="nombreusrm"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="passwordm" class="all-40">Password</label>
                                        <div class="all-60">
                                            <input  class="all-100" type="password" id="passwordm" placeholder="Sin Modificar"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="appaternom" class="all-40">Apellido Paterno</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="appaternom"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="apmaternom" class="all-40">Apellido Materno</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="apmaternom"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="privilegiosm" class="all-40" >Privilegios</label>
                                        <div style="" class="all-60">
                                            <select class=" all-100 required " data-placeholder="Seleccione privilegios..." id="privilegiosm">
                                                <option value="">Seleccione...</option>
                                                <option value="1">Administrador</option>
                                                <option value="2">Otro</option>
                                            </select>
                                        </div>
                                    </div>
<<<<<<< HEAD
=======
                                    <div class="control-group gutters">
                                        <label for="id_areasm" class="all-40">Area</label>
                                        <div class="all-60">
                                            <select  class="all-100 required " data-placeholder="Seleccione area..."  id="id_areasm"/>
                                                <option value="">Seleccione...</option> 
                                                <?php 
                                                    $area=$consultas->obtener_datos("areas");
                                                    while ($ar= mysql_fetch_array($area)) { ?>
                                                        <option value="<?php echo $ar['id_areas'];?>"> <?php echo $ar['nombre_area']; ?> </option> 
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">
                                        <label for="id_statusm" class="all-40">Status</label>
                                        <div class="all-60">
                                            <select  class="all-100 required " data-placeholder="Seleccione status..."  id="id_statusm"/>
                                                <option value="">Seleccione...</option> 
                                                <?php 
                                                    $status=$consultas->obtener_datos("status");
                                                    while ($stat= mysql_fetch_array($status)) { ?>
                                                        <option value="<?php echo $stat['id_status'];?>"> <?php echo $stat['descripcion']; ?> </option> 
                                                <?php }?>

                                            </select>
                                        </div>
                                    </div>
>>>>>>> d9b5664cb1b148d4e6328fa9107c34cc1e122427

                                    <input type="hidden" id="idm" name="idm" value=""/>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="modif" class="ink-button red">Guardar</button>
                                <button class="ink-button red ink-dismiss">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div> <!--FIN Form Modificar-->

                <!--Elemento emergente (Formulario en ventana modal para eliminar información configurado por el usuario)-->
                <div id="divFormeliminar" >
                    <div class="ink-shade fade">
                        <div id="Formeliminar" class="ink-modal" data-trigger="#Eliminartransfer" data-width="360px" data-height="170px">
                            <div class="modal-body">
                                <h4 id="etiquetadel" style="margin-bottom:0px;">¿Deseas Eliminar el Registro?</h4>
                            </div>
                            <div class="modal-footer">
                                <button class="ink-button red" id="delete" id-eliminar="">Eliminar</button>
                                <button class="ink-button red ink-dismiss">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div> <!--FIN Form Eliminar-->

                <!--FIN Elementos a mostrar dinamicos (formularios en ventanas modal, advertencias, estados de carga, etc.)-->

            </div>
        </div><!--FIN Contenido-->
    </body>

</html>
