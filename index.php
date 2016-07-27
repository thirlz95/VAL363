<?php
    
    ini_set("session.save_path", "/home/unn_w14040301/sessionData");
    
    session_start(); 

 require_once 'database_conn.php';
 
 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: NativeDroidExample.html");
  exit;
 }
 
 if( isset($_POST['btn-login']) ) { 
  
  $email = $_POST['email'];
  $upass = $_POST['pass'];
  
  $email = strip_tags(trim($email));
  $upass = strip_tags(trim($upass));
  
  $password = hash('sha256', $upass); // password hashing using SHA256
  
  $res=mysqli_query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
  
  $row=mysqli_fetch_array($res);
  
  $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
  
  if( $count == 1 && $row['userPass']==$password ) {
   $_SESSION['user'] = $row['userId'];
   header("Location: index.php");
  } else {
   $errMSG = "Wrong Credentials, Try again...";
  }
 }
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Memebers Login</title>
        <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" type="text/css" href="nativedroid2.css" />
        <link rel="stylesheet" type="text/css" href="nativedroid2.color.teal.css" />
        <nd2-include data-src="SplashScreen.html"></nd2-include>
</head>
<body>

<div class="container">

 <div id="login-form">
    <form method="post" autocomplete="off">
    
     <div class="col-md-12">
        
        <div data-role="header" data-position="fixed" class="wow fadeIn">
            <a href="SplashScreen.html" class="ui-btn ui-icon-arrow-l ui-btn-icon-left"></a>

            <h1 class="wow fadeIn" data-wow-delay='0.4s'>Memebers Login</h1>
        </div>
        
         <div class="form-group">
             <hr />
            </div>
            
            <?php
   if ( isset($errMSG) ) {
    
    ?>
    <div class="form-group">
             <div class="alert alert-danger">
    <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
                </div>
             </div>
                <?php
   }
   ?>
            
            <div class="form-group">

             <div class="input-group">
             
             <form method="post" id="login" onsubmit="return formValidate(this.id)" action='logonChecker.php'>
             <input type="email" name="email" class="form-control" placeholder="Your Email" required />
                </div>
            </div>
            
            <div class="form-group">
             <div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
             <input type="password" name="pass" class="form-control" placeholder="Your Password" required />
                </div>
            </div>
            
            <div class="form-group">
             <button type="submit" class="btn btn-block btn-primary" name="btn-login">Sign In</button>
            </div>
            
            <div class="form-group">
             <hr />
            </div>
            
             <div>
                 <div id="getArtist">
                     <a href="register.php">login</a>
            </div>
        
        </div>
   
    </form>
    </div> 

</div>
            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
            <script src="waves.min.css"></script>
            <script src="nativedroid2.js"></script>
            <script src="nd2settings.js"></script>
            <script src="Launchpad.js"></script>
</body>
</html>
     
   
                <div data-role="footer" data-position="fixed">
                    <div id="getArtist">
                    </div>
 
