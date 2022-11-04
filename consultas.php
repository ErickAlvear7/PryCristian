
<?php  require_once 'menu.php';
    
    require_once("conexion.php");
    $objeto = new Conexion();
    $con = $objeto->Conectar(); 

    putenv("TZ=America/Guayaquil");
    date_default_timezone_set('America/Guayaquil');

    $nombres = '';
    $rc=0;

    if(isset($_POST['buscar']) and isset($_POST['cedula'])  )
    {
       $xCedula = $_POST['cedula'];


       //Registro Civil
       $xSQL = "SELECT dare_nombres AS Nombres, dare_fechanacimiento AS FechaNaci, dare_estadocivil AS EstadoCivil,";
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Ruc</th>
                                <th>Empresa</th>
                                <th>Telefono</th>
                                <th>Fax</th>
                                <th>Direccion</th>
                                <th>Fech.Ingreso</th>
                                <th>Fech.Salida</th>
                                <th>Año</th>
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
        <div class="tab-pane container fade" id="regCivil">
            <br/>
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Datos Registro Civil:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Fech.Nacimiento</th>
                                <th>Edad</th>
                                <th>Est.Civil</th>
                                <th>Tipo_Cedula</th>
                                <th>Nivel_Estudios</th>
                                <th>Profesion</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                             if($rc==1){
                                foreach ($regCivil2019 as $dataReg) {
                            ?>  
                            <tr>
                                <td><?php echo $dataReg['FechaNaci']; ?></td>
                                <td>Doe</td>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Conyugue</th>
                                <th>Cedula</th>
                                <th>Padre</th>
                                <th>Cedula</th>
                                <th>Madre</th>
                                <th>Cedula</th>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Razon_Social</th>
                                <th>Nombre_Comercial</th>
                                <th>Contribuyente</th>
                                <th>Clase</th>
                                <th>Tipo</th>
                                <th>Comercial</th>
                                <th>Actividad</th>
                                <th>Establecimiento</th>
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
                    <br/>
                    <div class="table-responsive"> 
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Direccion</th>
                                <th>Provincia</th>
                                <th>Canton</th>
                                <th>Parroquia</th>
                                <th>Fecha_Inicio</th>
                                <th>Fecha_Suspension</th>
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
        <div class="tab-pane container fade" id="dirTel">
            <br/>
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Direcciones:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Direccion</th>
                                <th>Tipo Direccion</th>
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
                    <br/>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Telefonos:</h6>
                    </div>
                    <div class="table-responsive"> 
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Telefono</th>
                                <th>Tipo Telefono</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Localidad</th>
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
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Cedula</th>
                                <th>Nombres</th>
                                <th>Parentesco</th>
                                <th>Fecha_Fallece</th>
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

