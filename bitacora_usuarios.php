<?php
    //Declaración del Objeto $consultas de la Clase controladora DBClass.php necesaria para el control de funciones del Sistema
    include_once 'DBClass.php';
    $consultas = new DBClass();
    
    //Varibles Globales del Archivo (pueden ser omitidas, optimizadas para catálogos solo cambiar nombre de tabla y el ID de la misma.
    $tablabase="bitacora_usuarios";
    $idbase="id_bitacora_usuarios";
    
    //Variables Globales del Archivo (pueden ser omitidas) texto desplegado en los formularios de catálogos
    $textoencabezado="Bitacora de usuarios";
    $textoencabezadoforms="Bitacora de usuarios";
    
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
                var paginaact="bitacora_usuarios.php";
                
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
                     
                    //var id_status= $('#id_status').val();
                    var descripcion= $('#descripcion').val();
                                   
                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formagregar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });
                    
                    var formData = new FormData();
                    formData.append('save','true');
                    //formData.append('id_status',nombre);
                    formData.append('descripcion', descripcion);
                    
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
                    
                    var id= $(this).attr('id-accion'); 
                    var formData = new FormData();
                    formData.append('delete',id);
                    
                    senddata(formData);
                });
                
                //Mostrar Form para Modificar
                $('#informacion').on('click','a.modificar',function(e){
                
                    e.preventDefault();  
                    var id = $(this).attr('id-accion'); 
                    var descripcion = ""; 
                           
                    var infoData = new FormData();
                    infoData.append('obtener_info',"<?php echo $tablabase ?>");

                    infoData.append('id',id);
                    
                    jQuery.each(obtener_info(infoData), function(){ 
                        //id_status= this.id_status;
                        descripcion= this.descripcion;
                    });
                           
                    $('#ids').val(id);
                    $('#descripcions').val(descripcion);                      
                    
                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formmodificar');
                        var modalObj = new Modal( modalElement );
                        modalObj.open();
                    });
                });
                
                //Modificar Registro
                $('#modif').click(function(e){
                   
                    e.preventDefault();  
                    
                    if(!valida("#FormModifica")){
                        return;
                    } 
                    
                    var id= $('#ids').val();
                    var descripcion= $('#descripcions').val();
                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formmodificar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });
                    
                    var formData = new FormData();
                    formData.append('update',id);
                     formData.append('descripcion',descripcion);
                    
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
                        //si ha ocurrido un error se notifica al cosa
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
                        if($(this).val()=="" && $(this).attr('id_status')){
                            $(this).addClass('errorstyle');  
                            $(this).attr('placeholder','Campo Requerido'); 
                            valid=false;
                        }                                                
                    }); 
                    
                    $(form+' select.required').each(function(){   
                        $(this).removeClass('errorstyle');
                        if($(this).val()=="" && $(this).attr('id_status')){
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
                        //si ha ocurrido un error se notifica al cosa
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

                <!--******************************Div con el contenido a mostrar al cosa (tablas, información, formularios estaticos etc.-->
                <div class="column-group">
                    <div class="all-100" style="text-align: center; font-size: 22px; margin-top: 10px;">
                        <?php echo $textoencabezado; ?>
                    </div>
                    <div class="all-100">
                        <table id="informacion" class="condensed-300">
                            <thead>
                                <tr class="nohov">   
                                    <th>Id</th> 
                                    <th>Usuario</th>
                                    <th>Status</th>
                                    <th>Fecha de modificacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $data=$consultas->obtener_datos("bitacora_usuarios");
                                    while ($row = mysql_fetch_array($data)){
                                        echo '<tr>
                                            <td>'.$row['id_bitacora_usuarios'].'</td>
                                            <td>';
                                                $nom=$consultas->obtener_por_id("usuarios", $row['id_usuarios'],"nombre");
                                                $ap=$consultas->obtener_por_id("usuarios", $row['id_usuarios'],"appaterno");
                                                $am=$consultas->obtener_por_id("usuarios", $row['id_usuarios'],"apmaterno");
                                                echo $nom." ".$ap." ".$am;
                                            echo '</td>
                                            <td>';
                                                $descStat=$consultas->obtener_por_id("status", $row['id_status'],"descripcion");
                                                echo $descStat;
                                            echo '</td>
                                            <td>'.$row['fecha_modificacion'].'</td>                                          
                                        </tr>';
                                    }
                                ?>                            
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--FIN Div con el contenido a mostrar al cosa (tablas, información, formularios estaticos etc.-->

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

            </div>
        </div><!--FIN Contenido-->
    </body>
<script type="text/javascript">
        $('#precargadiv').fadeOut('fast');
</script>

</html>
