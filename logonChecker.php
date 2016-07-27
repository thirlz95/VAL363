<?php

    ini_set("session.save_path", "/home/unn_w14040301/sessionData");
    
    session_start();

if ($_SERVER['HTTP_HOST'] == 'unn_w14040301') {
    ini_set('display_errors', true);
    error_reporting(-1); // show all errors
} else {
    ini_set('display_errors', false);
    error_reporting(0); // show no errors
} 
 
    
    include 'database_conn.php';
    
    include_once 'index.php';
    
    //Checks to see if the input fields from the login form have values that have been sent using ternary IF statement.
    //If they have been sent, then store them into the variables assigned.
    //If they have not been sent, assign a default value of null.
    
    $username = isset($_REQUEST['user']) ? $_REQUEST['user'] : null;
    $password = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : null;
    
   /* $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);*/
    
    //Prepared SQL statement. Based on the username, the query will obtain the passwordHash from the nmc_users
    //table and then match it to the appropriate username
    $sql = "SELECT passwordHash FROM user WHERE username = ?";
    
    //statement is stored in a variable and is then prepared for execution, passing the connection
    //and the SQL query variables into the paramaters.
    $stmt = mysqli_prepare($conn, $sql);
    
    //Binds the username to the statement and declares that it will be a type string
    mysqli_stmt_bind_param($stmt, "s", $username);
    
    //Executes the statement.
    mysqli_execute($stmt);
    
    //Binds the result from the statement. passwordHash variable created to then store the passwordHash retrieved 
    //from the query.
    mysqli_stmt_bind_result($stmt, $passwordHash);
    
    //Trimming whitespace from both input fields.
    $username = trim($username);
    $password = trim($password);
    
    
    if(empty($username)) {
        
        echo "<!doctype html>
                <html lang='en'>
                <head>
                        <meta charset='utf-8'>
                        <title>Task 3</title>
                        
                        <link rel='stylesheet' type='text/css' href='/home/unn_w14040301/VAL363/styles.css'>
                        <link rel='stylesheet' href='//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css' />
                        <script type='text/javascript' src='//code.jquery.com/jquery-1.11.1.min.js'></script>
                        <script type='text/javascript' src='//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js'></script>
                        <script type='text/javascript' src='js/Launchpad.js'></script>
                </head>

                <body>
                <div class='title' data-role='header'>
                    
                        <h1>User Info</h1>
                    </div>
                    <b>Login field(s) blank! Please try again.</b>
                
                </body>
                </html>";
        $_SESSION = array();
        session_destroy();
        print_r($_POST);
        var_dump($username);
    }
    
    //Logic to verify the passwordHash for the respective username and password that was entered.
    //If the passwordHash matches the password, then set the $_SESSION['user'] variable to the respective username entered by user
    //and set $_SESSION['logged-in'] to true
    //Else, set $_SESSION['logged-in'] to false and destroy the session.
    //Session destroyed as without this logic, a cookie would remain stored on the server even though the user is not logged in.
    
    if (mysqli_stmt_fetch($stmt)) {
            if(password_verify($password, $passwordHash)) {
                //Enter code for successful login
                $_SESSION['user'] = $username;
                $_SESSION['logged-in'] = true;
                //return true;
                header("Location: Launchpad.php");
            }
            else {
                //return false;
                echo "<p>Nope</p>";
                $_SESSION['logged-in'] = false;
                $_SESSION = array();
                header("Location: index.php");
                session_destroy();
            }
    }
    
    echo $_POST['user'];
    echo $_POST['pass'];
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);


