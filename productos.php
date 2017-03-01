<?php
    //Declaración del Objeto $consultas de la Clase controladora DBClass.php necesaria para el control de funciones del Sistema
    include_once 'DBClass.php';
    $consultas = new DBClass();
    
    //Varibles Globales del Archivo (pueden ser omitidas, optimizadas para catálogos solo cambiar nombre de tabla y el ID de la misma.
    $tablabase="productos";
    $idbase="idproducto";
    
    //Variables Globales del Archivo (pueden ser omitidas) texto desplegado en los formularios de catálogos
    $textoencabezado="Productos";
    $textoencabezadoforms="Producto";
    
    //Procesamiento del POST para guardar información 
    if(isset($_POST['save'])){
        //obtención de variables POST y guardado en forma de Array $data
        $data['codigo'] = $_POST['codigo'];
        $data['descripcion'] = $_POST['descripcion'];
        $data['color'] = $_POST['color'];
        $data['unidad_medida'] = $_POST['unidad_medida'];
        $data['calibre'] = $_POST['calibre'];
        $data['voltaje'] = $_POST['voltaje'];
        $data['tipo_tarjeta'] = $_POST['tipo_tarjeta'];
        
        //Guardado de información en la tabla declarada en la variable global $tablabase y la información en forma de Array $data
        echo $consultas->to_insert($tablabase, $data);
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
        $data['codigo'] = $_POST['codigo'];
        $data['descripcion'] = $_POST['descripcion'];
        $data['color'] = $_POST['color'];
        $data['unidad_medida'] = $_POST['unidad_medida'];
        $data['calibre'] = $_POST['calibre'];
        $data['voltaje'] = $_POST['voltaje'];
        $data['tipo_tarjeta'] = $_POST['tipo_tarjeta'];
        
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
                var paginaact="productos.php";
                
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
                     
                    var codigo= $('#codigo').val();
                    var descripcion= $('#descripcion').val();
                    var color= $('#color').val();
                    var unidad_medida= $('#unidad_medida').val();
                    var calibre= $('#calibre').val();
                    var voltaje= $('#voltaje').val();
                    var tipo_tarjeta= $('#tipo_tarjeta').val();
                                   
                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formagregar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });
                    
                    var formData = new FormData();
                    formData.append('save','true');
                    formData.append('codigo',codigo);
                    formData.append('descripcion',descripcion);       
                    formData.append('color',color);
                    formData.append('unidad_medida',unidad_medida);
                    formData.append('calibre',calibre);
                    formData.append('voltaje',voltaje);
                    formData.append('tipo_tarjeta',tipo_tarjeta);
                    
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
                    var codigo = ""; 
                    var descripcion = ""; 
                    var color = ""; 
                           
                    var infoData = new FormData();
                    infoData.append('obtener_info',"productos");
                    infoData.append('id',id);
                    
                    jQuery.each(obtener_info(infoData), function(){ 
                        codigo= this.codigo;
                        descripcion= this.descripcion;
                        color= this.color;
                        unidad_medida= this.unidad_medida;
                        calibre= this.calibre;
                        voltaje= this.voltaje;
                        tipo_tarjeta= this.tipo_tarjeta;

                    });
                           
                    $('#idm').val(id);
                    $('#codigom').val(codigo);
                    $('#descripcionm').val(descripcion);
                    $('#colorm').val(color);                 
                    $('#unidad_medidam').val(unidad_medida);
                    $('#calibrem').val(calibre);
                    $('#voltajem').val(voltaje);                       
                    $('#tipo_tarjetam').val(tipo_tarjeta);                                             
                    
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
                    
                    var id= $('#idm').val();
                    var codigo= $('#codigom').val();
                    var descripcion= $('#descripcionm').val();
                    var color= $('#colorm').val();
                    var unidad_medida= $('#unidad_medidam').val();
                    var calibre= $('#calibrem').val();
                    var voltaje= $('#voltajem').val();
                    var tipo_tarjeta= $('#tipo_tarjetam').val();
                                        
                    Ink.requireModules( ['Ink.Dom.Selector_1','Ink.UI.Modal_1'], function( Selector, Modal ){
                        var modalElement = Ink.s('#Formmodificar');
                        var modalObj = new Modal( modalElement );
                        modalObj.dismiss();
                    });
                    
                    var formData = new FormData();
                    formData.append('update',id);
                    formData.append('codigo',codigo);
                    formData.append('descripcion',descripcion);
                    formData.append('color',color);
                    formData.append('unidad_medida',unidad_medida);
                    formData.append('calibre',calibre);
                    formData.append('voltaje',voltaje);
                    formData.append('tipo_tarjeta',tipo_tarjeta);
                    
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
                                    <th>Codigo</th>  
                                    <th>Descripcion</th> 
                                    <th>Color</th> 
                                    <th>Unidad de Medida</th> 
                                    <th>Calibre</th> 
                                    <th>Voltaje</th> 
                                    <th>Tipo de Trajeta</th> 
                                    <th>Acciones</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $data=$consultas->obtener_datos("productos");
                                    while ($row = mysql_fetch_array($data)){
                                        echo '<tr>
                                            <td>'.$row['codigo'].'</td>
                                            <td>'.$row['descripcion'].'</td>
                                            <td>'.$row['color'].'</td>
                                            <td>'.$row['unidad_medida'].'</td>
                                            <td>'.$row['calibre'].'</td>
                                            <td>'.$row['voltaje'].'</td>
                                            <td>'.$row['tipo_tarjeta'].'</td>
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
                                        <label for="codigo" class="all-40">Codigo</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="codigo"/>
                                        </div>
                                    </div>
                                    <!--FIN Formato del bloque por campo....-->
  
                                    <div class="control-group gutters">     
                                        <label for="descripcion" class="all-40">Descripcion</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="descripcion"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">     
                                        <label for="color" class="all-40">Color</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="color"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">     
                                        <label for="unidad_medida" class="all-40">Unidad medida</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="unidad_medida"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">     
                                        <label for="calibre" class="all-40">Calibre</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="calibre"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">     
                                        <label for="voltaje" class="all-40">Voltaje</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="voltaje"/>
                                        </div>
                                    </div>
                                    <div class="control-group gutters">     
                                        <label for="tipo_tarjeta" class="all-40">Tipo tarjeta</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="tipo_tarjeta"/>
                                        </div>
                                    </div>
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
                                        <label for="codigom" class="all-40">Codigo</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="codigom"/>
                                        </div>
                                    </div>                          
                                    <div class="control-group gutters">     
                                        <label for="descripcionm" class="all-40">Descripcion</label>
                                        <div class="all-60">
                                            <input  class="all-100 required" type="text" id="descripcionm"/>
                                        </div>
                                    </div>  
                                    <div class="control-group gutters">     
                                        <label for="colorm" class="all-40">Color</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="colorm"/>
                                        </div>
                                    </div> 
                                    <div class="control-group gutters">     
                                        <label for="unidad_medidam" class="all-40">Unidad de Medida</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="unidad_medidam"/>
                                        </div>
                                    </div> 
                                    <div class="control-group gutters">     
                                        <label for="calibrem" class="all-40">Calibre</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="calibrem"/>
                                        </div>
                                    </div> 
                                    <div class="control-group gutters">     
                                        <label for="voltajem" class="all-40">Voltaje</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="voltajem"/>
                                        </div>
                                    </div> 
                                    <div class="control-group gutters">     
                                        <label for="tipo_tarjetam" class="all-40">Tipo Tarjeta</label>
                                        <div class="all-60">
                                            <input  class="all-100 " type="text" id="tipo_tarjetam"/>
                                        </div>
                                    </div> 
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

    <script type="text/javascript">
            $('#precargadiv').fadeOut('fast');
    </script>
</html>
