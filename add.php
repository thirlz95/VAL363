<?php
    
    ini_set("session.save_path", "appSessionData");
    
    session_start(); 
    
    include('database_conn.php');

    $forename = filter_has_var(INPUT_POST, 'forename') ? $_POST['forename'] : null;
    $surname = filter_has_var(INPUT_POST, 'surname') ? $_POST['surname'] : null;
    $addressLine1 = filter_has_var(INPUT_POST, 'addressLine1') ? $_POST['addressLine1'] : null;
    $addressLine2 = filter_has_var(INPUT_POST, 'addressLine2') ? $_POST['addressLine2'] : null;
    $addressLine3 = filter_has_var(INPUT_POST, 'addressLine3') ? $_POST['addressLine3'] : null;
    $addressLine4 = filter_has_var(INPUT_POST, 'addressLine4') ? $_POST['addressLine4'] : null;
    $postcode = filter_has_var(INPUT_POST, 'postcode') ? $_POST['postcode'] : null;

    //pass the cdID to the request stream
    //$foodID = $_REQUEST['foodID'];

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

    if (empty($addressLine3)) {
        $errors[] = "<p>Form cannot be submitted if $addressLine3 is blank!</p>";
    }

    if (empty($addressLine4)) {
        $errors[] = "<p>Form cannot be submitted if $addressLine4 is blank!</p>";
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

    //Echo's out each variable and the values they retrieved from the DB
    if (!empty($errors)) {
        echo "<strong>The following errors have occurred:</strong>";
        for ($a = 0; $a < count($errors); $a++) {
            echo "$errors[$a]</br>\n";
        }
    } else {

        //SQL statement to retreive all of the necessary data and uses joins to link each table to retrieve data from other tables.
        //$whereClause stores the SQL necessary to retrieve the cdid stored in $cdID variable based upon which link the user has clicked previously
        $sql = "INSERT INTO app_restaurant_order SET customerForename='$forename', customerSurname='$surname', customerAddr1='$addressLine1', customerAddr2='$addressLine2', customerAddr3='$addressLine3', customerAddr4='$addressLine4', customerPostcode='$postcode', total='$total';";
        
        mysqli_query($conn, $sql) or die(mysqli_error($conn));
    }