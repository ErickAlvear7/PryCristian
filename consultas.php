
<?php  require_once 'menu.php';
    
    require_once("conexion.php");
    $objeto = new Conexion();
    $con = $objeto->Conectar(); 

    putenv("TZ=America/Guayaquil");
    date_default_timezone_set('America/Guayaquil');

    $nombres = '';
    $rc=0;
    $ies =0;
    $sri =0;
    $dirtel =0;

    if(isset($_POST['buscar']) and isset($_POST['cedula'])  )
    {
       $xCedula = $_POST['cedula'];


       //Registro Civil
       $xSQL = "SELECT dare_nombres AS Nombres, dare_fechanacimiento AS FechaNaci, CAST(DATEDIFF(yy,CONVERT(date,dare_fechanacimiento,103),GETDATE()) AS VARCHAR) + ' años' AS Edad, dare_estadocivil AS EstadoCivil,";
       $xSQL .= "dare_tipocedula AS TipoCedula, dare_nivelestudios AS Nivel, dare_profesion AS Profesion, dare_conyuge AS Conyuge,";
       $xSQL .= "dare_cedulaconyuge AS Cedulacy, dare_nompadre AS Padre, dare_cedulapadre AS Cedulapa, dare_nommadre AS Madre,";
       $xSQL .= "dare_cedulamadre AS Cedulama FROM BDD_DATA..REG_CIVIL_2019 (NOLOCK) WHERE  dare_cedula = '$xCedula'";
       $resultado = $con->prepare($xSQL);
       $resultado->execute();
       $regCivil2019 = $resultado->fetchAll();
        
       foreach($regCivil2019 as $dataReg) {
        $rc=1;
        $nombres = $dataReg['Nombres'];
       }

       //IESS_2019_2021

       $xSQL = "SELECT RUCEMP AS Ruc, NOMEMP AS Empresa, TELSUC AS TelEmpre, FAXSUC AS FaxExt, DIRSUC AS DirEmpre, FECINGAFI AS FechaIng,";
       $xSQL .= "FECSALAFI AS FechaSal, V19 + '_' + CASE MES WHEN 1 THEN 'ENERO' WHEN 2 THEN 'FEBRERO' WHEN 3 THEN 'MARZO' WHEN 4 THEN 'ABRIL'";
       $xSQL .= "WHEN 5 THEN 'MAYO' WHEN 6 THEN 'JUNIO' WHEN 7 THEN 'JULIO' WHEN 8 THEN 'AGOSTO' WHEN 9 THEN 'SEPTIEMBRE' WHEN 10 THEN 'OCTUBRE'";
       $xSQL .= "WHEN 11 THEN 'NOVIEMBRE' WHEN 12 THEN 'DICIEMBRE' END AS Anio, NUMAFI AS NumAfi, V19 AS V19, MES AS Mes FROM  BASE_IESS..IESS_2019 (NOLOCK) WHERE NUMAFI= '$xCedula' UNION ";

       $xSQL .= "SELECT RUCEMP AS Ruc, NOMEMP AS Empresa, TELSUC AS TelEmpre, FAXSUC AS FaxExt, DIRSUC AS DirEmpre, FECINGAFI AS FechaIng,";
       $xSQL .= "FECSALAFI AS FechaSal, V19 + '_' + CASE MES WHEN 1 THEN 'ENERO' WHEN 2 THEN 'FEBRERO' WHEN 3 THEN 'MARZO' WHEN 4 THEN 'ABRIL'";
       $xSQL .= "WHEN 5 THEN 'MAYO' WHEN 6 THEN 'JUNIO' WHEN 7 THEN 'JULIO' WHEN 8 THEN 'AGOSTO' WHEN 9 THEN 'SEPTIEMBRE' WHEN 10 THEN 'OCTUBRE'";
       $xSQL .= "WHEN 11 THEN 'NOVIEMBRE' WHEN 12 THEN 'DICIEMBRE' END AS Anio, NUMAFI AS NumAfi, V19 AS V19, MES AS Mes FROM BASE_IESS..IESS_2019_AGO (NOLOCK) WHERE NUMAFI= '$xCedula' UNION ";

       $xSQL .= "SELECT RUCEMP AS Ruc, NOMEMP AS Empresa, TELSUC AS TelEmpre, FAXSUC AS FaxExt, DIRSUC AS DirEmpre, FECINGAFI AS FechaIng,";
       $xSQL .= "FECSALAFI AS FechaSal, V19 + '_' + CASE MES WHEN 1 THEN 'ENERO' WHEN 2 THEN 'FEBRERO' WHEN 3 THEN 'MARZO' WHEN 4 THEN 'ABRIL'";
       $xSQL .= "WHEN 5 THEN 'MAYO' WHEN 6 THEN 'JUNIO' WHEN 7 THEN 'JULIO' WHEN 8 THEN 'AGOSTO' WHEN 9 THEN 'SEPTIEMBRE' WHEN 10 THEN 'OCTUBRE'";
       $xSQL .= "WHEN 11 THEN 'NOVIEMBRE' WHEN 12 THEN 'DICIEMBRE' END AS Anio, NUMAFI as NumAfi, V19 AS V19, MES AS Mes FROM BASE_IESS..IESS_ENE2021 (NOLOCK) WHERE NUMAFI= '$xCedula' UNION ";

       $xSQL .= "SELECT RUCEMP AS Ruc, NOMEMP AS Empresa, TELSUC AS TelEmpre, FAXSUC AS FaxExt, DIRSUC AS DirEmpre, FECINGAFI AS FechaIng,";
       $xSQL .= "FECSALAFI AS FechaSal, V19 + '_' + CASE MES WHEN 1 THEN 'ENERO' WHEN 2 THEN 'FEBRERO' WHEN 3 THEN 'MARZO' WHEN 4 THEN 'ABRIL'";
       $xSQL .= "WHEN 5 THEN 'MAYO' WHEN 6 THEN 'JUNIO' WHEN 7 THEN 'JULIO' WHEN 8 THEN 'AGOSTO' WHEN 9 THEN 'SEPTIEMBRE' WHEN 10 THEN 'OCTUBRE'";
       $xSQL .= "WHEN 11 THEN 'NOVIEMBRE' WHEN 12 THEN 'DICIEMBRE' END AS Anio, NUMAFI as NumAfi, V19 AS V19, MES AS Mes FROM BASE_IESS..IESS_JUL2021 (NOLOCK) WHERE NUMAFI= '$xCedula'";

       $resultado = $con->prepare($xSQL);
       $resultado->execute();
       $baseIess = $resultado->fetchAll();
       $ies =1;


       //BASE_IESS_SRI_2020

       $xSQL = "SELECT RAZON_SOCIAL AS RazonSocial, NOMBRE_COMERCIAL AS Nombre, ESTADO_CONTRIBUYENTE AS Contribuyente, CLASE_CONTRIBUYENTE AS Clase, TIPO_CONTRIBUYENTE AS Tipo,";
       $xSQL .= "NOMBRE_FANTASIA_COMERCIAL AS Comercial, ACTIVIDAD_ECONOMICA AS Actividad, ESTADO_ESTABLECIMIENTO AS Establecimiento, OBLIGADO AS Contabilidad,";
       $xSQL .= "CALLE+' '+NUMERO+' '+INTERSECCION AS Direccion, DESCRIPCION_PROVINCIA AS Provincia, DESCRIPCION_CANTON AS Canton, DESCRIPCION_PARROQUIA AS Parroquia,";
       $xSQL .= "FECHA_INICIO_ACTIVIDADES AS FechaInicio, FECHA_REINICIO_ACTIVIDADES AS FechaReinicio, FECHA_SUSPENSION_DEFINITIVA AS FechaSuspension FROM BASE_IESS..SRI_2020 (NOLOCK) WHERE NUMERO_RUC= '$xCedula'+'001'";
       $resultado = $con->prepare($xSQL);
       $resultado->execute();
       $baseSRI = $resultado->fetchAll();
       $sri =1;


       //DIRECCION-TELEFONOS

       $xSQL = "SELECT DIR.DIRECCION AS DireccionTel, (SELECT TID.DESCRIPCION FROM BDAPLICATIVO..TIPODIRECCION TID WHERE TID.CODIGO=DIR.TIPODIRECCION) AS TipoDirec ";
       $xSQL .= "FROM BDAPLICATIVO..DIRECCION DIR (NOLOCK) WHERE DIR.IDENTIFICACION='$xCedula'";
       $resultado = $con->prepare($xSQL);
       $resultado->execute();
       $dirTele = $resultado->fetchAll();
       $dirtel =1;


       $xSQL = "SELECT TEL.CELULAR AS Telefono, TEL.NOMBRE AS Nombre, TEL.NOMBRE_PRO AS Localidad, Direccion = '', TipoTele = 'CELULAR' ";
       $xSQL .= "FROM BDAPLICATIVO..CLARO TEL (NOLOCK) WHERE TEL.CEDULA= '$xCedula' UNION ";

       $xSQL = "SELECT TEL.CELULAR AS Telefono, TEL.NOMBRES AS Nombre, TEL.CIUDAD_CANTON AS Localidad ";
       $xSQL .= "FROM BDAPLICATIVO..CLARO_ACTUAL_2019 TEL (NOLOCK) WHERE TEL.IDENTIFICACION='$xCedula' UNION ";

       $xSQL = "SELECT TEL.TELEFONO AS Telefono, TEL.NOMBRE AS Nombre, TEL.DIRECCION AS Direccion, TEL.LOCALIDAD AS Localidad ";
       $xSQL .= "FROM BDAPLICATIVO..CNT TEL (NOLOCK) WHERE TEL.CEDULA= '$xCedula' UNION ";
       $TipoTele = 'CNT';

       $xSQL = "SELECT TEL.TELEFONO AS Telefono, TEL.NOMBRE AS Nombre, TEL.DIRECCION AS Direccion, TEL.LOCALIDAD AS Localidad ";
       $xSQL .= "FROM BDAPLICATIVO..CNT_EDINA_ENE19 TEL (NOLOCK) WHERE TEL.CED_RUC= '$xCedula' UNION ";
       
       $xSQL = "SELECT TEL.NUMEROTELEFONO AS Telefono, (SELECT TID.DESCRIPCION FROM BDAPLICATIVO..TIPOTELEFONO TID WHERE TID.CODIGO=TEL.TIPOTELEFONO) AS TipoTele ";
       $xSQL .= "FROM BDAPLICATIVO..TELEFONO TEL (NOLOCK) WHERE TEL.IDENTIFICACION= '$xCedula' ";
       $resultado = $con->prepare($xSQL);
       $resultado->execute();
       $telefonos= $resultado->fetchAll();
       $Nombre = '';
	   $Direccion = '';
	   $Localidad = '';

       
      
    }

  
    
  
?>

<div class="container-fluid">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST">
        <div class="input-group">
            <input type="text" id="cedula" name="cedula" class="form-control bg-light border-0 small" placeholder="Buscar"
                aria-label="Search" aria-describedby="basic-addon2" minlength="5" maxlength="10" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                <label id="cedulaP-error" class="error" for="cedulaP" style="display: none;"></label>
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" name="buscar">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <br/>
    <br/>
    <ul class="nav nav-pills py-3">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="pill" href="#iess">
            <i class="fa fa-user-md"> IESS</i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#regCivil">
               <i class="fa fa-user"> REGISTRO CIVIL</i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#sri">
            <i class="fa fa-inbox"> SERVICIO RENTAS INTERNAS</i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#dirTel">
            <i class="fa fa-phone"> DIRECCION-TELEFONOS</i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="pill" href="#arbGea">
            <i class="fa fa-users"> ARBOL GENEALOGICO</i>
            </a>
        </li>
    </ul>

        <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane container active" id="iess">
            <br/>
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"><?php echo $nombres; ?></h6>
            </div>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                   <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Instituto Ecuartoriano Seguridad Social:</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">RUC</th>
                                <th style="color: #284DF2;">EMPRESA</th>
                                <th style="color: #284DF2;">TELEFONO</th>
                                <th style="color: #284DF2;">FAX</th>
                                <th style="color: #284DF2;">DIRECCION</th>
                                <th style="color: #284DF2;">FECHA_INGRESO</th>
                                <th style="color: #284DF2;">FECHA_SALIDA</th>
                                <th style="color: #284DF2;">AÑO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($ies==1){
                                foreach ($baseIess as $dataIess) {
                            ?>  
                            <tr>
                                <td style="color: black;"><?php echo $dataIess['Ruc']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['Empresa']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['TelEmpre']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['FaxExt']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['DirEmpre']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['FechaIng']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['FechaSal']; ?></td>
                                <td style="color: black;"><?php echo $dataIess['Anio']; ?></td>
                            </tr>
                            <?php } 
                            }?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane container fade" id="regCivil">
            <br/>
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos Registro Civil:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">FECHA_NACIMIENTO</th>
                                <th style="color: #284DF2;">EDAD</th>
                                <th style="color: #284DF2;">ESTADO_CIVIL</th>
                                <th style="color: #284DF2;">TIPO_CEDULA</th>
                                <th style="color: #284DF2;">NIVEL_ESTUDIOS</th>
                                <th style="color: #284DF2;">PROFESION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($rc==1){
                                foreach ($regCivil2019 as $dataReg) {
                            ?>  
                            <tr>
                                <td style="color: black;"><?php echo $dataReg['FechaNaci']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Edad']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['EstadoCivil']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['TipoCedula']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Nivel']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Profesion']; ?></td>
                            </tr>
                            <?php } 
                            }?>
                            
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">CONYUGUE</th>
                                <th style="color: #284DF2;">CEDULA</th>
                                <th style="color: #284DF2;">PADRE</th>
                                <th style="color: #284DF2;">CEDULA</th>
                                <th style="color: #284DF2;">MADRE</th>
                                <th style="color: #284DF2;">CEDULA</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($rc==1){
                                foreach($regCivil2019 as $dataReg) {
                            ?>  
                            <tr>
                                <td style="color: black;"><?php echo $dataReg['Conyuge']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Cedulacy']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Padre']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Cedulapa']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Madre']; ?></td>
                                <td style="color: black;"><?php echo $dataReg['Cedulama']; ?></td>
                            </tr>
                              <?php } 
                              }?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
        <div class="tab-pane container fade" id="sri">
            <br/>
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Servicio Rentas Internas:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;;">RAZON_SOCIAL</th>
                                <th style="color: #284DF2;;">NOMBRE_COMERCIAL</th>
                                <th style="color: #284DF2;;">CONTRIBUYENTES</th>
                                <th style="color: #284DF2;;">CLASE</th>
                                <th style="color: #284DF2;;">TIPO</th>
                                <th style="color: #284DF2;;">COMERCIAL</th>
                                <th style="color: #284DF2;;">ACTIVIDAD</th>
                                <th style="color: #284DF2;;">ESTABLECIMIENTO</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($sri==1){
                                foreach ($baseSRI as $dataSri) {
                            ?>  
                            <tr>
                                <td style="color: black;"><?php echo $dataSri['RazonSocial']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Nombre']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Contribuyente']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Clase']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Tipo']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Comercial']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Actividad']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Establecimiento']; ?></td>
                            </tr>
                            <?php } 
                              }?>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">DIRECIION</th>
                                <th style="color: #284DF2;">PROVINCIA</th>
                                <th style="color: #284DF2;">CANTON</th>
                                <th style="color: #284DF2;">PARROQUIA</th>
                                <th style="color: #284DF2;">FECHA_INICIO</th>
                                <th style="color: #284DF2;">FECHA_SUSPENSION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($sri==1){
                                foreach ($baseSRI as $dataSri) {
                            ?>  
                            <tr>
                                <td style="color: black;"><?php echo $dataSri['Direccion']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Provincia']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Canton']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['Parroquia']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['FechaInicio']; ?></td>
                                <td style="color: black;"><?php echo $dataSri['FechaSuspension']; ?></td>
                            </tr>
                            <?php } 
                              }?>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
        <div class="tab-pane container fade" id="dirTel">
            <br/>
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Direcciones:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">DIRECCION</th>
                                <th style="color: #284DF2;">TIPO_DIRECCION</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($dirtel==1){
                                foreach ($dirTele as $dataDirtel) {
                            ?>  
                            <tr>
                                <td style="color: black;"><?php echo $dataDirtel['DireccionTel']; ?></td>
                                <td style="color: black;"><?php echo $dataDirtel['TipoDirec']; ?></td>
                            </tr>
                            <?php } 
                              }?>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Telefonos:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">TELEFONO</th>
                                <th style="color: #284DF2;">TIPO_TELEFONO</th>
                                <th style="color: #284DF2;">NOMBRE</th>
                                <th style="color: #284DF2;">DIRECCION</th>
                                <th style="color: #284DF2;">LOCALIDAD</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="color: black;">John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
        <div class="tab-pane container fade" id="arbGea">
            <br/>
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Arbol:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered table-striped" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: #284DF2;">CEDULA</th>
                                <th style="color: #284DF2;">NOMBRES</th>
                                <th style="color: #284DF2;">PARENTESCO</th>
                                <th style="color: #284DF2;">FECHA_FALLECE</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td style="color: #284DF2;">John</td>
                                <td>Doe</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <div class="row">
        <a href="index" class="btn btn-sm btn-clean btn-icon" >
			<i class="fa fa-reply fa-lg"></i>
        </a>    
    </div>
</div>



    <?php  require_once 'footer.php';?>

  

 </body>
 
   
</html>

