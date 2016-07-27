<?php
 ob_start();
 session_start();
 require_once 'database_conn.php';
 
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
 }
 // select loggedin users detail
 $res=mysql_query("SELECT * FROM user WHERE userId=".$_SESSION['user']);
 $userRow=mysql_fetch_array($res);
?>
<!DOCTYPE html PUBLIC 
<head>
            <title>Home - Music Reviewer</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
            <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
            <link rel="stylesheet" type="text/css" href="nativedroid2.css" />
            <link rel="stylesheet" type="text/css" href="nativedroid2.color.teal.css" />
        </head>>
<body>

 <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://www.codingcage.com/2015/11/ajax-login-script-with-jquery-php-mysql.html">Back to Article</a></li>
            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
     <span class="glyphicon glyphicon-user"></span>&nbsp;Hi' <?php echo $userRow['userEmail']; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav> 

 <div id="wrapper">

 <div class="container">
    
     <div class="page-header">
     <h3>Coding Cage - Programming Blog</h3>
     </div>
        
        <div class="row">
        <div class="col-lg-12">
        <h1>Focuses on PHP, MySQL, Ajax, jQuery, Web Design and more...</h1>
        </div>
        </div>
    
    </div>
    
    </div>
    
            <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
            <script src="//ajax.googleapis.com/ajax/libs/jquerymobile/1.4.5/jquery.mobile.min.js"></script>
            <script src="waves.min.css"></script>
            <script src="nativedroid2.js"></script>
            <script src="nd2settings.js"></script>

</body>
</html>