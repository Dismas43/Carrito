<?php

session_start();
 //verifica si esta logeado
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
  header("location: index.php");
  exit;
}
 

require_once "conexion.php";
 
// deifine variables y la incializa en vacio
$username = $password = "";
$username_err = $password_err = "";
 
// Procesa la informacion del metodo post
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // si el username esta vacio
    if(empty(trim($_POST["username"]))){
        $username_err = "Por favor ingrese su usuario.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // si el password esta vacio
    if(empty(trim($_POST["password"]))){
        $password_err = "Por favor ingrese su contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Valida credenciales
    if(empty($username_err) && empty($password_err)){
        // Preparacion de la declaracion
        $sql = "SELECT id, username, password FROM users WHERE username= ?";
        
        if($stmt = mysqli_prepare($conexion, $sql)){
            // Vincula las variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            //establecer parametros
            $param_username = $username;
            
            //  intento de ejecucui  de declaracion
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
                // si existe en la base de datos
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // verigica resultados
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // si  contraseña es validad, entrar en sesion
                            session_start();
                            
                            // almacenar variables de session
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;        

                            
                            
                            header("location: index.php");
                        } else{
               
                            $password_err = "La contraseña que has ingresado no es válida.";
                           mysqli_stmt_close($stmt);   
                        }
                    }
                } else{
                  
                    $username_err = "No existe cuenta registrada con ese nombre de usuario.";
                  
                      mysqli_stmt_close($stmt);
                }
            } else{
                echo "Algo salió mal, por favor vuelve a intentarlo.";
                  mysqli_stmt_close($stmt);
            }
        }
        
    
      
    }
    

    mysqli_close($conexion);
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href='http://fonts.googleapis.com/css?family=Exo+2' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="js/jquery1.min.js"></script>
<!-- start menu -->
<link href="css/megamenu.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/megamenu.js"></script>
<script>$(document).ready(function(){$(".megamenu").megamenu();});</script>
<!-- dropdown -->
<script src="js/jquery.easydropdown.js"></script>
</head>
<body>
   <?php include "header1.php" ?>
	<div class="header-bottom">
	    <div class="wrap">
			<div class="header-bottom-left">
				<div class="logo">
					<a href="index.html"><img src="images/leo.jpg" alt="" width="70px" height="70px" /></a>
				</div>
				<div class="menu">
	            <ul class="megamenu skyblue">
			<li class="active grid"><a href="index.php">Home</a></li>
			
				
				</li>				
				
				</li>
			
			
			</ul>
			</div>
		</div>
	   <div class="header-bottom-right">
         <div class="search">	  
				<input type="text" name="s" class="textbox" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="Subscribe" id="submit" name="submit">
				<div id="response"> </div>
		 </div>
	  <div class="tag-list">
	 
			
			</li>
		</ul>
		
			
		</ul>
	 
	  </div>
    </div>
     <div class="clear"></div>
     </div>
	</div>
        <div class="login">
          	<div class="wrap">
				<div class="col_1_of_login span_1_of_login">
					<h4 class="title">Nuevos Usuarios</h4>
					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan</p>
					<div class="button1">
					   <a href="register.php"><input type="submit" name="Submit" value="Crear Cuenta"></a>
					 </div>
					 <div class="clear"></div>
				</div>
				<div class="col_1_of_login span_1_of_login">
				<div class="login-title">
	           		<h4 class="title">Logeate ahora</h4>
					<div id="loginbox" class="loginbox">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST"  id="login-form">
						 <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Usuario</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ingresar">
            </div>
            <p>¿No tienes una cuenta? <a href="register.php">Regístrate ahora</a>.</p>
						 </form>
					</div>
			    </div>
				</div>
				<div class="clear"></div>
			</div>
		</div>
     <div class="footer">
		
		</div>
		<div class="footer-middle">
			<div class="wrap">
			 <div class="section group example">
			
 			 </div>
			 <div class="col_1_of_f_1 span_1_of_f_1">
			   <div class="section group example">
				 <div class="col_1_of_f_2 span_1_of_f_2">
				    
 				 </div>
				 <div class="col_1_of_f_2 span_1_of_f_2">
				
					
					
				<div class="clear"></div>
		    </div>
		   </div>
		 
		    </div>
		  </div>
		</div>
		<div class="footer-bottom">
			<div class="wrap">
	           
			  <div class="f-list2">
				<ul>
				
				</ul>
			  </div>
				<div class="clear"></div>
		      </div>
			</div>
		</div>
</body>
</html>