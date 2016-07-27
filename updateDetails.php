<?php
    
    ini_set("session.save_path", "/home/unn_w14040301/sessionData");
    
    session_start(); 
    
    include('database_conn.php');

    $forename = filter_has_var(INPUT_POST, 'forename') ? $_POST['forename'] : null;
    $surname = filter_has_var(INPUT_POST, 'surname') ? $_POST['surname'] : null;
    $addressLine1 = filter_has_var(INPUT_POST, 'addressLine1') ? $_POST['addressLine1'] : null;
    $addressLine2 = filter_has_var(INPUT_POST, 'addressLine2') ? $_POST['addressLine2'] : null;
    $addressLine3 = filter_has_var(INPUT_POST, 'addressLine3') ? $_POST['addressLine3'] : null;
    $addressLine4 = filter_has_var(INPUT_POST, 'addressLine4') ? $_POST['addressLine4'] : null;
    $postcode = filter_has_var(INPUT_POST, 'postcode') ? $_POST['postcode'] : null;

    
    $orderID = $_REQUEST['orderID'];

    //Errors array to store and output any errors encountered when processing the form.
    $errors = array();

    //Check if any form fields are empty.
    if (empty($forename)) {
        $errors[] = "<p>Form cannot be submitted if $forename is blank!</p>";
    }

    if (empty($surname)) {
        $errors[] = "<p>Form cannot be submitted if $surname is blank!</p>";
    }

    if (empty($addressLine1)) {
        $errors[] = "<p>Form cannot be submitted if $addressLine1 is blank!</p>";
    }

    if (empty($addressLine2)) {
        $errors[] = "<p>Form cannot be submitted if $addressLine2 is blank!</p>";
    }

    if (empty($postcode)) {
        $errors[] = "<p>Form cannot be submitted if $postcode is blank!</p>";
    }

    //Check each form field length to ensure no redundant data is submitted.
    if (strlen($forename) > 30) {
        $errors[] = "<p>Forename length too great! Please enter a valid forename.</p>";
    }

    if (strlen($surname) > 30) {
        $errors[] = "<p>Surname length too great! Please enter a valid surname.</p>";
    }

    if (strlen($addressLine1) > 50) {
        $errors[] = "<p>Address Line 1 length too great! Please enter a valid Address Line 1.</p>";
    }

    if (strlen($addressLine2) > 50) {
        $errors[] = "<p>Address Line 2 length too great! Please enter a valid Address Line 2.</p>";
    }

    if (strlen($addressLine3) > 50) {
        $errors[] = "<p>Address Line 3 length too great! Please enter a valid Address Line 3.</p>";
    }

    if (strlen($addressLine4) > 50) {
        $errors[] = "<p>Address Line 4 length too great! Please enter a valid Address Line 4.</p>";
    }

    if (strlen($postcode) < 6 || strlen($postcode) > 8) {
        $errors[] = "<p>Postcode invalid! Please enter a valid postcode.</p>";
    }
    
    //Sanitization of data inputs by checking the input for any special characters or tags and removes them with FILTER_SANITIZE_STRING
    if (!filter_var($forename, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for forename field detected. Please re-try.</p>";
    }

    if (!filter_var($surname, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for surname field detected. Please re-try.</p>";
    }

    if (!filter_var($addressLine1, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for Address Line 1 field detected. Please re-try.</p>";
    }

    if (!filter_var($addressLine2, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for Address Line 2 field detected. Please re-try.</p>";
    }

    if (!filter_var($addressLine3, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for Address Line 3 field detected. Please re-try.</p>";
    }

    if (!filter_var($addressLine4, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for Address Line 4 field detected. Please re-try.</p>";
    }

    if (!filter_var($postcode, FILTER_SANITIZE_STRING)) {
        $errors[] = "<p>Invalid entry for Postcode field detected. Please re-try.</p>";
    }

    if (!empty($errors)) {
        echo "<strong>The following errors have occurred:</strong>";
        for ($a = 0; $a < count($errors); $a++) {
            echo "$errors[$a]</br>\n";
        }
    } else {

        //SQL statement to retreive all of the necessary data and uses joins to link each table to retrieve data from other tables.
        $sql = "UPDATE app_restaurant_order 
                SET customerForename='$forename', 
                customerSurname='$surname', 
                customerAddr1='$addressLine1', 
                customerAddr2='$addressLine2',
                customerAddr3='$addressLine3',
                customerAddr4='$addressLine4',
                customerPostcode='$postcode'
                WHERE orderID=$orderID";
        
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
        
    }

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" type="text/css" href="styles.css" />
        <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type=text/javascript src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script type="text/javascript" src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        
    </head>
    <body>
        <div data-role="header" data-position="fixed">
            <h1>NE Foods LTD</h1>
        </div>
        
        <div class="title" data-role="header">
                <h2>Order Details</h2>
        </div>
        
                <label><strong>Congratulations! Your changes have been applied:</strong></label>
                <?php
                
                    $customerOrder = "SELECT orderID FROM app_restaurant_order WHERE customerForename = '$forename' AND customerSurname = '$surname'";
                    
                    $orderResult = mysqli_query($conn, $customerOrder) or die (mysqli_error($conn));
                    
                    $fetch = mysqli_fetch_assoc($orderResult);
                    
                    $orderID = $fetch['orderID'];
                    
                    echo "<strong><br>Forename: $forename</br> <br>Surname: $surname</br> <br>Address Line 1: $addressLine1</br> <br>Address Line 2: $addressLine2</br> <br>Address Line 3: $addressLine3</br> <br>Address Line 4: $addressLine4</br> <br>Postcode: $postcode</br></strong>";
                    
                    echo "<br>
                        <label>If you would like to edit these order details, please click here:</label>
                    <form method='post' id='edit' action='edit.php?orderID=$orderID'>
                        <input type='submit' value='Edit' />
                    </form>
                    </br>
                    <br>
                        <label>Or if you would like to remove these order details, please click here:</label>
                    <form method='post' id='remove'>
                        <input type='submit' value='Remove' />
                    </form></br>";
                    
                    //mysqli_free_result($orderResult);
                    
                ?>
                
                <div id="displayEdit">
                    
                </div>
                
                <div id="displayRemove">
                    
                </div>
                
                <br>
                    <label>Otherwise, please click here to return to the Launchpad:</label>
                </br>
                <form method="post" id="home" action="Launchpad.php">
                    <input type="submit" value="Home" />
                </form>

            <div id="navigation" data-role="footer" data-position="fixed"> 
                <form method="post" action="logout.php">
                    <input type="submit" value="Logout" />
                </form>
 
                <div data-role="navbar">
                        <ul>
                            <li><a href="reviews.html">Reviews</a></li>
                            <li><a href="info.html">Info</a></li>
                            <li><a href="extras.php">Extras</a></li>
                        </ul>
                </div>
            </div>
    </body>
</html>


