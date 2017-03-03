<?php
    date_default_timezone_set('Mexico/General');
    header('Content-Type: text/html; charset=utf-8');
    require_once('singleton/db_config.php');
    require_once('singleton/Database.singleton.php');

    class DBClass{
        private $link="";

        public function __construct(){
            $db = Database::obtain(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE);
            $db->connect();
            $db->query("SET NAMES 'utf8'");

            $this->link=$db;
        }


        //************************************Funciones de control de inicio y cierre de sesiónes*************************************************//
        //Declarar las variables de sesion que sea necesarias para el funcionamiento del sistema $_SESSION['X'] = $record['X'];
        public function verificarAcceso($usuario, $password)
        {
            $sql ="select * from usuarios where usuario='" . $usuario . "' and password =md5('" . $password . "') LIMIT 1";

            $rows = $this->link->query($sql);

            $record = mysql_fetch_array($rows);
            session_start();
            if (isset($record['id_usuarios']) && $record['id_usuarios'] !== "" )
            {
                $_SESSION['idusuariorm'] = $record['id_usuarios'];
                $_SESSION['privilegiosrm'] = $record['id_privilegios'];
                $_SESSION['usuariorm'] = $record['usuario'];
                $_SESSION['nombreusuariorm'] = $record['nombre'];
                $_SESSION['appaternousuariorm'] = $record['appaterno'];
                $_SESSION['apmaternousuariorm'] = $record['apmaterno'];
                $_SESSION['autorizacionrm'] = true;
                echo "AUTORIZADO";
                exit;
            }
            else
            {
                echo "NO AUTORIZADO";
                $this->destruirSesion();
            }
        }

        //destruir la informacion de todas la variables declaradas en la parte superior
        public function destruirSesion()
        {
            $_SESSION['idusuariorm'] = 0;
            $_SESSION['privilegiosrm'] = "No Autorizado";
            $_SESSION['usuariorm'] = "No Definido";
            $_SESSION['autorizacionrm'] = false;
            $_SESSION['nombreusuariorm']="";
            $_SESSION['appaternousuariorm']="";
            $_SESSION['apmaternousuariorm']="";
            session_unset();
            session_destroy();
        }
        //************************************Funciones de control de inicio y cierre de sesiónes*************************************************//


        //************************************Funciones de control de manipulación de BD básicas*************************************************//
        //Query  param: sentencia SQL//
        public function to_query($sql){
            if($primary_id = $this->link->query($sql)){
                return $primary_id;
            }else{
                return 'Error al Ejecutar la Consulta';
            }
        }

        //insert param: Nombre tabla, información en array $data['campo'] = valor//
        public function to_insert($tabla,$data){
            $primary_id = $this->link->insert($tabla, $data);
            if($primary_id!==false){
                return $primary_id;
            }else{
                return 'Error al Guardar la Información';
            }
        }

        //update param: Nombre tabla, información en array $data['campo'] = valor, condición where//
        public function to_update($tabla,$data,$where){
            if($primary_id = $this->link->update($tabla, $data, $where)){
                return $primary_id;
            }else{
                return 'Error al Actualizar la Información';
            }
        }

        //delete param: Nombre tabla, condición Where //
        public function to_delete($tabla,$where){
            if($primary_id = $this->link->query("delete from ".$tabla." where ".$where)){
                return $primary_id;
            }else{
                return 'Error al Eliminar la Información';
            }
        }
        //************************************Funciones de control de manipulación de BD básicas*************************************************//

        //************************************Funciones de control de manipulación de BD consultas adaptadas*************************************************//
        //select from tabla * //
        public function obtener_datos($tabla){
            if($select = $this->link->query("select * from ".$tabla.";")){
                return $select;
            }else{
                return 'Error al obtener la información';
            }
        }

        //select from tabla * condicionado //
        public function obtener_datos_condicion_a($tabla,$where){
            if($select = $this->link->query("select * from ".$tabla." where ".$where.";")){
                $row = mysql_fetch_array($select);
                return $row[1];
            }else{
                return 'Error al obtener la información';
            }
        }

        public function obtener_datos_condicion_l($tabla,$where){
            if($select = $this->link->query("select * from ".$tabla." where ".$where.";")){
                $row = mysql_fetch_array($select);
                return $row[9]." ".$row[2]." ".$row[3];
            }else{
                return 'Error al obtener la información';
            }
        }
        public function obtener_datos_condicion($tabla,$where){
            if($select = $this->link->query("select * from ".$tabla." where ".$where.";")){

                return $select;
            }else{
                return 'Error al obtener la información';
            }
        }







        //select campo1,campo2 from tabla condicionado (param Where opcional) //
        public function obtener_id_area_recepcion(){
          //nombre:arr1,appaterno:arr2,mmaterno:arr3
          $tabla="areas";

          $id_recepcion=$_GET['id_recepcion'];

          $where="nombre_area="."'$id_recepcion'";
          $campos="id_areas";
          $wherestring="";

          if($where!==""){
              $wherestring = " where ".$where;
          }

          if($select = $this->link->query("select ".$campos." from ".$tabla." $wherestring;")){
              $row = mysql_fetch_array($select);
              //$res=json_encode($row[0]);
              return  $row;
          }else{
              return 'Error al obtener la información';
          }
        }
        public function obtener_id_area_entrega(){
          //nombre:arr1,appaterno:arr2,mmaterno:arr3
          $tabla="areas";

          $id_entrega=$_GET['id_entrega'];

          $where="nombre_area=" ."'$id_entrega'";
          $campos="id_areas";
          $wherestring="";

          if($where!==""){
              $wherestring = " where ".$where;
          }

          if($select = $this->link->query("select ".$campos." from ".$tabla." $wherestring;")){
              $row = mysql_fetch_array($select);
              //$res=json_encode($row[0]);
              return  $row;
          }else{
              return 'Error al obtener la información';
          }
        }

        public function obtener_id_usuario(){
          //nombre:arr1,appaterno:arr2,mmaterno:arr3
          $tabla="usuarios";

          $nombre= $_GET['nombre'];

          $paterno=$_GET['appaterno'];
          $materno=$_GET['mmaterno'];

          $where="nombre=" ."'$nombre'". " and appaterno=" ."'$paterno'". " and apmaterno=" ."'$materno'";
          $campos="id_usuarios";
          $wherestring="";

          if($where!==""){
              $wherestring = " where ".$where;
          }

          if($select = $this->link->query("select ".$campos." from ".$tabla." $wherestring;")){
              $row = mysql_fetch_array($select);
              //$res=json_encode($row[0]);
              return  $row;
          }else{
              return 'Error al obtener la información';
          }
        }

        public function obtener_datos_campos($campos, $tabla, $where){
            $wherestring="";

            if($where!==""){
                $wherestring = " where ".$where;
            }

            if($select = $this->link->query("select ".$campos." from ".$tabla." $wherestring;")){
                return $select;
            }else{
                return 'Error al obtener la información';
            }
        }

        public function obtener_datos_campos_personal($campos, $tabla, $where){
            $wherestring="";

            if($where!==""){
                $wherestring = " where ".$where;
            }

            if($select = $this->link->query("select ".$campos." from ".$tabla." $wherestring;")){
                return $select;
            }else{
                return 'Error al obtener la información';
            }
        }

        //select campo1,campo2 from tabla condicionado Return HTML para SELECT (options) //


        public function obtener_select_data_personalizado($campos,$tabla){
            $data="";
            $cont=1;
            if($select = $this->link->query("select $campos from ".$tabla." ;")){

                while ($row = mysql_fetch_array($select)){
                    $a = $row[0].' '.$row[1].' '.$row[2];
                    if(($row[0]=='Administrador')||($row[0]=='administrador')){
                        $data=$data.'<option value="'.$row[0].'" id-contador="'.$cont.'">Seleccione Usuario</option>';
                        continue;
                    }
                      $data = $data.'<option value="'.$row[0].'" id-contador="'.$cont.'">'.$a.'</option>';
                      $cont+=1;
                }
                return $data;
            }else{
                return 'error';
            }
        }

        public function obtener_select_data_personalizado_area($campos,$tabla){
            $data="";
            $cont=1;
            if($select = $this->link->query("select $campos from ".$tabla." ;")){

                while ($row = mysql_fetch_array($select)){
                    $a = $row[0];

                      $data = $data.'<option value="'.$row[0].'" id-contador="'.$cont.'">'.$a.'</option>';
                      $cont+=1;
                }
                return $data;
            }else{
                return 'error';
            }
        }
        public function obtener_select_data($campos,$tabla,$where){
            $data="";
            $cont=1;
            if($select = $this->link->query("select $campos from ".$tabla." where ".$where.";")){
                while ($row = mysql_fetch_array($select)){
                    $data = $data. '<option value="'.$row[0].'" id-contador="'.$cont.'">'.$row[1].'</option>';
                    $cont+=1;
                }
                return $data;
            }else{
                return 'error';
            }
        }

        //select condicionado (adaptar a necesidad) //
        public function obtener_datos_multiples($tabla){
            if($tabla==="usuarios"){
                if($select = $this->link->query("select usuarios.idusuario, usuarios.usuario, usuarios.privilegios, usuarios.idcentrocosto, centrocosto.idcentrocosto, centrocosto.nombre, tipo_centro_costo.idtipocentro, tipo_centro_costo.nombretipocentrocosto
                        from usuarios join centrocosto on usuarios.idcentrocosto = centrocosto.idcentrocosto
                        join tipo_centro_costo on centrocosto.idtipocentro = tipo_centro_costo.idtipocentro;" )){
                    return $select;
                }else{
                    return 'error';
                }
            }else if($tabla==="confignentregas"){
                $nentregas=0;
                $nentregasq = $this->obtener_datos_campos("valor", "configuraciones", "idconfiguracion=5");
                while($entregan = mysql_fetch_array($nentregasq)){
                    $nentregas = $entregan['valor'];
                }
                return $nentregas;
            }
        }

        //************************************Funciones de control de manipulación de BD consultas adaptadas*************************************************//
        public function uploadfiles($files,$identificador){
            $filesupload = array("certificado"=>"");
            $directorio="files/";
            //comprobacion del directorio
            if(!is_dir("files/")){
                mkdir("files/", 0777);
            }

            foreach ($files as $id=>$key) //Iteramos el arreglo de archivos
            {
                if($key['error'] == UPLOAD_ERR_OK )                     //Si el archivo se paso correctamente Ccontinuamos
                {
                    $NombreOriginal = $key['name'];                     //Obtenemos el nombre original del archivo
                    $nobrearray = array_reverse(explode(".", $NombreOriginal));
                    $extension = $nobrearray[0];                        //extension del archivo
                    $temporalname = $key['tmp_name'];                   //Obtenemos la ruta Original del archivo
                    $nombrefinal = $id."_".$identificador.".".$extension;   //Creamos el nombre final del archivo
//                    $destino = $directorio.$id."_".$identificador.".".$extension;	//Creamos una ruta de destino con la variable ruta y el nombre original del archivo

                    $nombreorig = $nombrefinal;   //se verifica que el archivo no existe en caso de ser asi se concatena (n) para evitar duplicados
                    $conunter=0;
                    while(file_exists ( $directorio.$nombrefinal )){
                        $conunter +=1;
                        $nombrefinal = "($conunter)".$nombreorig;
                    }
                    $destino = $directorio.$nombrefinal; // se establece la ruta final

                    if(move_uploaded_file($temporalname, $destino)){   //Movemos el archivo temporal a la ruta especificada
                        $filesupload[$id]=$nombrefinal;
                    }else{
                        $filesupload[$id]="Error";
                    }
                }else{
                    $filesupload[$id]="Error";
                }
            }

            return $filesupload;
        }

        public function subir_archivonvo($idencuesta){
        $directorio="files/";
            //conteo de elementos File
            $tot = count($_FILES["archivos"]["name"]);

            //comprobacion del directorio
            if(!is_dir("files/")){
                mkdir("files/", 0777);
            }

            $status=array(); //arreglo de control

            for ($i = 0; $i < $tot-1; $i++){ //por cada archivo
                $NombreOriginal = $_FILES['archivos']['name'][$i];                     //Obtenemos el nombre original del archivo
                    $nobrearray = array_reverse(explode(".", $NombreOriginal));
                    $extension = $nobrearray[0];                        //extension del archivo
                    $temporalname = $_FILES['archivos']['tmp_name'][$i];                   //Obtenemos la ruta Original del archivo
                    $nombrefinal = $idencuesta."_encuesta.".$extension;   //Creamos el nombre final del archivo

                    $nombreorig = $nombrefinal;   //se verifica que el archivo no existe en caso de ser asi se concatena (n) para evitar duplicados
                    $conunter=0;
                    while(file_exists ( $directorio.$nombrefinal )){
                        $conunter +=1;
                        $nombrefinal = "($conunter)".$nombreorig;
                    }
                    $destino = $directorio.$nombrefinal; // se establece la ruta final

//                $archivo = $_FILES['archivos']['name'][$i]; //nombre original
//                $fecha = date("Y-m-d H.i.s");               //fecha y hora de subida
//                $nomfinal = $fecha."_".$archivo;            //nombre para guardar el server
                //comprobacion de la subida del archivo
                if (move_uploaded_file($_FILES['archivos']['tmp_name'][$i],$destino))
                {
                    $dataupdate['idencuesta']=$idencuesta;
                    $dataupdate['archivo']=$nombrefinal;
                    $updateparsona = $this->to_insert("archivos", $dataupdate);
                    if(strpos($updateparsona, "Error") === false){
                        //echo true;
                    }else{
                        unlink($destino);
                        //echo 'Advertencia: El archivo '.$key.' no pudo ser cargado<br>Suba el archivo desde la opcion "Modificar"';
                    }
                   sleep(1);//retrasamos la petición 1 segundos
                   //$peticiones->agregar_doc($_POST['idtarea'],$archivo,$nomfinal);//instruccion opcional o sustituible dependiendo si se guardaran datos en alguna BD
                   //$guardarbd = $db->insert("archivos", $data);          //instruccion opcional
                   //if($guardarbd!=false){ //verificar si se agrego a la tabla el archivo //opcional
                   $status[]=array("file" =>$_FILES['archivos']['name'][$i] , "status"=> "success", "idtareaseg" => "1", "index"=>$i); //guardado de informacion de control
                  // }else{ //opcional
                  //     $status[]=array("file" =>$_FILES['archivos']['name'][$i], "status"=> "error", "idtareaseg" => $idtarea, "index"=>$i);  //guardado de informacion de control
                  //     unlink('files/'.$nomfinal);
                  // }
                }else{
                    //en caso de error se guarda informaciond de control
                   $status[]=array("file" =>$_FILES['archivos']['name'][$i] , "status"=> "error", "idtareaseg" => "1", "index"=>$i);
                }
            }
            return (json_encode($status)); //regreso de un arreglo json
        }


    }
