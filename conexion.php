<?php

    class Conexion{
        public static function Conectar(){
            $host = "ERICK-PC";
            $dbname = "BASE_IESS";
            $username = "user_data";
            $pass = "conexion";
            $puerto = 1433;

            try {
                $conexion = new PDO("sqlsrv:Server=$host,$puerto;database=$dbname",$username,$pass);
                return $conexion;
            } catch (PDOException $th) {
                echo $th;
            }
        }
    }

    /*$serverName = "ALVEAR\SQLSERVER7, 1433"; //serverName\instanceName, portNumber (por defecto es 1433)
    $connectionInfo = array( "Database"=>"Expert_Web", "UID"=>"userweb", "PWD"=>"Expert.2018");
    $conn = sqlsrv_connect( $serverName, $connectionInfo);
    
    if( $conn ) {
         //echo "Conexión establecida.<br />";
    }else{
         echo "Conexión no se pudo establecer.<br />";
         die( print_r( sqlsrv_errors(), true));
    }*/
?>