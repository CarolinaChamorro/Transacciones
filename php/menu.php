<?php

// Conectando y seleccionado la base de datos  
  //Opciones de la conexión
  $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
  //Objeto PDO, Controlador de BD, IP del servidor o localhost, nombre de la BD, usuario y contraseña
  $objetoPDO = new PDO('mysql:host=localhost;dbname=basetransacciones','root');

    //verificar los errores
    try{
        $objetoPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $objetoPDO = new PDO('mysql:host=localhost;dbname=basetransacciones','root');
        echo "Base de datos conectada";
      }catch(PDOException $e){
        echo "ERROR:errores " . $e->getMessage();
      }
       $correcto="";
       $incorrecto="";
       if(isset($_POST['correcto']))$correcto=$_POST['correcto'];
       if(isset($_POST['incorrecto']))$incorrecto=$_POST['incorrecto']; 

      if($correcto)
      {
        try {
         $objetoPDO->beginTransaction();
        $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100-400) WHERE `id`=1');
        $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100+400) WHERE `id`=2');
        $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100-200) WHERE `id`=3');
        $objetoPDO->query('UPDATE `cuentaspersonal` SET `efectivo`=(5100+200) WHERE `id`=4');
        $objetoPDO->commit();
        echo ".         Se efectuado la transacción";
        } catch (Excepction $e) {
            $objetoPDO->rollback();
            echo 'Hay fallo en el sistema: ',$e->getMessage(), "\n";
        }
      }

      if($incorrecto)
      {
            $objetoPDO->beginTransaction();
            $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100-4000) WHERE `id`=1');
            $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100+4000) WHERE `id`=2');
            $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100+2000) WHERE `id`=3');
            $objetoPDO->query('UPDATE `cuentaspersonales` SET `efectivo`=(5100+2000) WHERE `id`=4');
            $objetoPDO->commit();
            echo '.Hay fallo en el sistema';
      }

?>
