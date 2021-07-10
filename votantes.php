<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Admin Panel</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">

    <link href='http://fonts.googleapis.com/css?family=Ubuntu' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed' rel='stylesheet' type='text/css'>

    <style>
      .headerFont{
        font-family: 'Ubuntu', sans-serif;
        font-size: 24px;
      }

      .subFont{
        font-family: 'Raleway', sans-serif;
        font-size: 14px;
        
      }
      
      .specialHead{
        font-family: 'Oswald', sans-serif;
      }

      .normalFont{
        font-family: 'Roboto Condensed', sans-serif;
      }
    </style>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
	
	<div class="container">
  	<nav class="navbar navbar-default navbar-fixed-top navbar-inverse
    " role="navigation">
      <div class="container">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <div class="navbar-header">
          <a class="navbar-brand headerFont text-lg"><strong>VEO - Votaciones Escolares Online</strong></a>
        </div>

        <div class="collapse navbar-collapse" id="example-nav-collapse">
          <ul class="nav navbar-nav">
            <!-- 
            <li><a href="#featuresTab"><span class="subFont"><strong>Features</strong></span></a></li>
            <li><a href="#feedbackTab"><span class="subFont"><strong>Feedback</strong></span></a></li>
            <li><a href="#"><span class="subFont"><strong>About</strong></span></a></li>
        	-->
          </ul>
          

          <a href="admin.php"><button type="submit" class="btn btn-success navbar-right navbar-btn"><span class="normalFont"><strong>Panel Administrativo</strong></span></button></a>
        </div>

      </div> <!-- end of container -->
    </nav>

    
    <div class="container" style="padding-top:150px;">
    	
    <div class="row">
      <?php
          $conn = mysqli_connect("localhost","root","","proyectocuatri");

          if(isset($_POST["import"])){
            $filename = $_FILES["file"]["tmp_name"];

            if($_FILES["file"]["size"] > 0){
              $file = fopen($filename, "r");

              while(($column = fgetcsv($file, 10000, ",")) !== FALSE){
                $sqlInsert = "Insert into votantes (nombre, usuario, contraseña, id_votante) values('" . $column[0] . "', '" . $column[1] . "', '" . $column[2] . "', '" . $column[3] . "')";

                $result = mysqli_query($conn, $sqlInsert);
              }
            }
          }

          if (isset($_POST["limpiar"])) {
            mysqli_query($conn, "TRUNCATE TABLE votantes");
          }

        ?>

        <form class="form-horizoontal" method="post" action="" name="cargarCsv" enctype="multipart/form-data">

        <div>
          <label>Ingresa el Padrón Electoral Mediante un Formato CSV</label><br>
          <label>Elige el Archivo:</label>
          <input type="file" name="file" accept=".csv">
          <button type="submit" class="btn btn-success navbar-right navbar-btn" name="import">Cargar</button>
        </div>

        </form>
      <div class="col-sm-12">
        <table class="table table-bordered table-hover">
          <tr>
            <th><strong>Nombre</strong></th>
            <th><strong>Usuario</strong></th>
            <th><strong>ID de Votante</strong></th>
          </tr>

          <?php
                      require('config.php');

                      //Establish Connection
                        $conn= mysqli_connect($hostname, $username, $password, $database);

                        //Check
                        if(!$conn)
                        {
                          die("Connection Failed : ".mysqli_connect_error());
                        }

                        for ($i=1; $i < 16; $i++) { 
                          
                          $sql= "SELECT * FROM proyectocuatri.votantes where id='".$i."'";
                          $query= mysqli_query($conn, $sql);

                          if(mysqli_num_rows($query)>0)
                            {
                              while($row= mysqli_fetch_assoc($query))
                              {
                                $nombre= $row['nombre'];
                                $usuario= $row['usuario'];
                                $id_votante= $row['id_votante'];
                                echo "
                                  <tr>
                                      <td>$nombre</td>
                                      <td>$usuario</td>
                                      <td>$id_votante</td>
                                  </tr>   
                                ";
                              }
                            }
                        }
                          mysqli_close($conn);
          ?>

        </table>
      </div>
    </div>

    <form class="form-horizoontal" method="post" action="" name="BorrarCsv" enctype="multipart/form-data">

        <div>
          <button type="submit" class="btn btn-success navbar-right navbar-btn" name="limpiar">Limpiar Tabla</button>
        </div>

        </form>

    </div>

    <footer>
        <div class="container">
          <div class="row">
            <div class="col-sm-6 text-center">
             <h2 class="specialHead">Universidad Tecnológica de la Selva<br>Unidad Académica Rayón</h2>
            </div>
            <div class="col-sm-6 text-center">
              <a href="https://www.facebook.com/utselvarayon" target="_blank"><img src="https://img.icons8.com/office/50/000000/facebook.png"/></a>
              <a href="https://www.youtube.com/c/UTselvaOficial1/featured" target="_blank"><img src="https://img.icons8.com/office/50/000000/youtube.png"/></a>
              
            </div>

          </div>
        </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>