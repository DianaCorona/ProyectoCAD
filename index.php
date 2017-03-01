<?php
    include_once 'DBClass.php';
    $consultas = new DBClass();

    if(isset($_POST['login']))
    {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        echo $consultas->verificarAcceso($usuario, $password);
        die();
    }
    
    
    session_start();
    header("Content-Type: text/html;charset=utf-8");
    date_default_timezone_set('Mexico/General');
    if((!isset($_SESSION['autorizacionrm']))||($_SESSION['autorizacionrm']==false))
    {
       
    }  else{
        header("Location: inicio.php");
    } 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Record México</title>
        <link rel="stylesheet" href="loginfiles/css/style.css">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>
        
        <script>
            $(document).ready(function(){
                $('#login-button').click(function(e){
                    e.preventDefault();
                    var paginaact="index.php";
                    
                    $('#mensaje').html("");
                                         
                    if(!valida("#FormLogin")){
                        $('#mensaje').html('<p class="tiperror">Favor de escribir nombre de usuario y contraseña</p>');
                        return;
                    }
                                         
                    var usuario = $('#usuario').val();
                    var password = $('#password').val();
                    
                    var formData = new FormData();
                    formData.append('login','true');
                    formData.append('usuario',usuario);
                    formData.append('password',password);
                    
                    
                    $.ajax({
                        url: paginaact,  
                        type: 'POST',
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        async: false,
                        //mientras enviamos el archivo
                        beforeSend: function(){     
                            $('.wrapper h1').attr('style','-webkit-transform: translateY(85px);transform: translateY(85px);');   
                            $('#login').fadeIn('fast');
                            $('form').fadeOut(500);                    
                        },
                        //una vez finalizado correctamente
                        success: function(data){ 
                            $('#login').fadeOut('slow',function(){
                                $('.wrapper h1').attr('style','-webkit-transform: translateY(-1px);transform: translateY(-1px);');
                            });    
                            if (data=="AUTORIZADO")
                            {
                                $('.wrapper').addClass('form-success');
                                    window.open('inicio.php', '_self', false);
                                    return true;
                            }else if(data==="SIN PERMISOS"){
                                alert("Acceso NO Autorizado! - El Usuario ya no tiene permisos para entrar a este sistema.");
                            }
                            else
                            {      
                                $('form').fadeIn(800,function(){
                                    $('#mensaje').html('<p class="tiperror">Acceso NO Autorizado! - Verifica tu Usuario y contraseña e intenta de nuevo.</p>');
                                });
                            }
                        },
                        //si ha ocurrido un error se notifica al usuario
                        error: function (xhr, ajaxOptions, thrownError) {
                            $('form').fadeIn(500); 
                            alert(xhr.status+'\n'+thrownError+'\n'+xhr.responseText);
                        }
                    }); 
                });
                
                //validación de campos con clase REQUIRED de un FORM ESPECIFICO
                function valida(form){
                    var valid=true;
                    
                    $(form+' input.required').each(function(){   
                        $(this).removeClass('errorstyle');
                        if($(this).val()=="" && $(this).attr('id')){
                            $(this).addClass('errorstyle');  
                            //$(this).attr('placeholder','Campo Obligatorio'); 
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
            });
        </script>
        
        <style>
            #login{
                display: none;
                position: absolute;
                width: 100px;
                height: 100px;
                top: 55%;
                //margin-top: -50px;
                left: 50%;
                margin-left: -50px;
                text-align: center;
                z-index: 100000;
            }
        </style>
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <h1>RECORD MÉXICO</h1>

                <form class="form" id="FormLogin">
                    <input id="usuario" type="text" placeholder="usuario" class="required">
                    <input id="password" type="password" placeholder="contraseña" class="required">
                    <button type="submit" id="login-button">Entrar</button>
                </form>
                <div id="mensaje">
                    
                </div>
                <div id="login" >            
                    <img src="img/cargando.gif" style=" width: 50px; height: 50px;"/>
                </div>
            </div>

            <ul class="bg-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>     
    </body>
</html>
