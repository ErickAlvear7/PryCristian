
<?php  require_once 'menu.php';
    
    require_once("conexion.php");
    $objeto = new Conexion();
    $conexion = $objeto->Conectar(); 

    putenv("TZ=America/Guayaquil");
    date_default_timezone_set('America/Guayaquil');
    
  
?>
<div class="container-fluid">
    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" method="POST">
        <div class="input-group">
            <input type="text" name="buscar" class="form-control bg-light border-0 small" placeholder="Buscar"
                aria-label="Search" aria-describedby="basic-addon2">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">
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
            <br/>
            <div class="card shadow mb-4 py-3">
                <div class="card-body">
                   <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Instituto Ecuartoriano Seguridad Social:</h6>
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
                                <th>Conyugue</th>
                                <th>Cedula</th>
                                <th>Padre</th>
                                <th>Cedula</th>
                                <th>Madre</th>
                                <th>Cedula</th>
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
        <div class="tab-pane container fade" id="sri">

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
</div>







    <?php  require_once 'footer.php';?>

 </body>
</html>