
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

       $xSQL = "SELECT DIR.DIRECCION AS Direccion, (SELECT TID.DESCRIPCION AS TipoDirec FROM BDAPLICATIVO..TIPODIRECCION TID WHERE TID.CODIGO=DIR.TIPODIRECCION)";
       $xSQL .= "FROM BDAPLICATIVO..DIRECCION DIR (NOLOCK) WHERE DIR.IDENTIFICACION='$xCedula'";
       $resultado = $con->prepare($xSQL);
       $resultado->execute();
       $dirTele = $resultado->fetchAll();
       $dirtel =0;

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
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
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
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Fech.Nacimiento</th>
                                <th style="color: black;">Edad</th>
                                <th style="color: black;">Est.Civil</th>
                                <th style="color: black;">Tipo_Cedula</th>
                                <th style="color: black;">Nivel_Estudios</th>
                                <th style="color: black;">Profesion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($rc==1){
                                foreach ($regCivil2019 as $dataReg) {
                            ?>  
                            <tr>
                                <td><?php echo $dataReg['FechaNaci']; ?></td>
                                <td><?php echo $dataReg['Edad']; ?></td>
                                <td><?php echo $dataReg['EstadoCivil']; ?></td>
                                <td><?php echo $dataReg['TipoCedula']; ?></td>
                                <td><?php echo $dataReg['Nivel']; ?></td>
                                <td><?php echo $dataReg['Profesion']; ?></td>
                            </tr>
                            <?php } 
                            }?>
                            
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="table-responsive"> 
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Conyugue</th>
                                <th style="color: black;">Cedula</th>
                                <th style="color: black;">Padre</th>
                                <th style="color: black;">Cedula</th>
                                <th style="color: black;">Madre</th>
                                <th style="color: black;">Cedula</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($rc==1){
                                foreach($regCivil2019 as $dataReg) {
                            ?>  
                            <tr>
                                <td><?php echo $dataReg['Conyuge']; ?></td>
                                <td><?php echo $dataReg['Cedulacy']; ?></td>
                                <td><?php echo $dataReg['Padre']; ?></td>
                                <td><?php echo $dataReg['Cedulapa']; ?></td>
                                <td><?php echo $dataReg['Madre']; ?></td>
                                <td><?php echo $dataReg['Cedulama']; ?></td>
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
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Razon_Social</th>
                                <th style="color: black;">Nombre_Comercial</th>
                                <th style="color: black;">Contribuyente</th>
                                <th style="color: black;">Clase</th>
                                <th style="color: black;">Tipo</th>
                                <th style="color: black;">Comercial</th>
                                <th style="color: black;">Actividad</th>
                                <th style="color: black;">Establecimiento</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($sri==1){
                                foreach ($baseSRI as $dataSri) {
                            ?>  
                            <tr>
                                <td><?php echo $dataSri['RazonSocial']; ?></td>
                                <td><?php echo $dataSri['Nombre']; ?></td>
                                <td><?php echo $dataSri['Contribuyente']; ?></td>
                                <td><?php echo $dataSri['Clase']; ?></td>
                                <td><?php echo $dataSri['Tipo']; ?></td>
                                <td><?php echo $dataSri['Comercial']; ?></td>
                                <td><?php echo $dataSri['Actividad']; ?></td>
                                <td><?php echo $dataSri['Establecimiento']; ?></td>
                            </tr>
                            <?php } 
                              }?>
                            </tbody>
                        </table>
                    </div>
                    <br/>
                    <div class="table-responsive"> 
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Direccion</th>
                                <th style="color: black;">Provincia</th>
                                <th style="color: black;">Canton</th>
                                <th style="color: black;">Parroquia</th>
                                <th style="color: black;">Fecha_Inicio</th>
                                <th style="color: black;">Fecha_Suspension</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($sri==1){
                                foreach ($baseSRI as $dataSri) {
                            ?>  
                            <tr>
                                <td><?php echo $dataSri['Direccion']; ?></td>
                                <td><?php echo $dataSri['Provincia']; ?></td>
                                <td><?php echo $dataSri['Canton']; ?></td>
                                <td><?php echo $dataSri['Parroquia']; ?></td>
                                <td><?php echo $dataSri['FechaInicio']; ?></td>
                                <td><?php echo $dataSri['FechaSuspension']; ?></td>
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
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Direccion</th>
                                <th style="color: black;">Tipo Direccion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($dirtel==1){
                                foreach ($dirTele as $dataDirtel) {
                            ?>  
                            <tr>
                                <td><?php echo $dataDirtel['Direccion']; ?></td>
                                <td><?php echo $dataDirtel['TipoDirec']; ?></td>
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
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Telefono</th>
                                <th style="color: black;">Tipo Telefono</th>
                                <th style="color: black;">Nombre</th>
                                <th style="color: black;">Direccion</th>
                                <th style="color: black;">Localidad</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>John</td>
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
                        <table class="table table-bordered" style="font-size: 12px; background-color: #D6EBF5 ;">
                            <thead>
                            <tr>
                                <th style="color: black;">Cedula</th>
                                <th style="color: black;">Nombres</th>
                                <th style="color: black;">Parentesco</th>
                                <th style="color: black;">Fecha_Fallece</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>John</td>
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

