<?php
    
    ini_set("session.save_path", "/home/unn_w14040301/sessionData");
    
    session_start(); 
    
    include('database_conn.php');
    
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
        
        <link rel="stylesheet" type="text/css" href="/home/unn_w14040301/VAL363/styles.css" />
        <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
        <link href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <script type=text/javascript src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	    <script type="text/javascript" src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
        <script type="text/javascript">
            function validateFormFields(){
                'use strict';
                //Assigns a reference to the form via an object, passing in the form ID as a parameter.
                var form = document.getElementById("details");

                //If the selected variable value is equal to "ret", enter nested condition.
                if(form.forename.value == "") {
                    alert("Form cannot be submitted if forename is blank!");

                    form.forename.focus();
                    
                    return false;
                    
                }
                else if(form.surname.value == "") {
                    alert("Form cannot be submitted if surname is blank!");

                    form.surname.focus();
                    
                    return false;
                }
                else if(form.addressLine1.value == "") {
                    alert("Form cannot be submitted if Address Line 1 is blank!");

                    form.addressLine1.focus();
                    
                    return false;
                }
                else if(form.addressLine2.value == "") {
                    alert("Form cannot be submitted if Address Line 2 is blank!");

                    form.addressLine2.focus();
                    
                    return false;
                }
                else if(form.postcode.value == "") {
                    alert("Form cannot be submitted if postcode is blank!");

                    form.postcode.focus();
                    
                    return false;
                }
                else {
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <div data-role="header" data-position="fixed">
            <h1>NE Foods LTD</h1>
        </div>
        
        <div class="editDetails" data-role="header">
                <h2>Edit Details</h2>
        </div>
        
        <div class="customerEdit" >
            <label>Please edit the details which require updates.</label>        
                    <?php
                        
                        $orderID = $_REQUEST['orderID'];
                    
                        $editSQL = "SELECT customerForename, 
                                customerSurname, 
                                customerAddr1, 
                                customerAddr2, 
                                customerAddr3, 
                                customerAddr4, 
                                customerPostcode FROM app_restaurant_order WHERE orderID = $orderID";
                        
                        $orderResult = mysqli_query($conn, $editSQL) or die (mysqli_error($conn));
                    
                        $fetchOrderID = mysqli_fetch_assoc($orderResult);
                        
                        $customerForename = $fetchOrderID['customerForename'];
                        $customerSurname = $fetchOrderID['customerSurname'];
                        $customerAddr1 = $fetchOrderID['customerAddr1'];
                        $customerAddr2 = $fetchOrderID['customerAddr2'];
                        $customerAddr3 = $fetchOrderID['customerAddr3']; 
                        $customerAddr4 = $fetchOrderID['customerAddr4'];
                        $customerPostcode = $fetchOrderID['customerPostcode'];
                                   
                        echo "<form method='post' id='details' onsubmit='return validateFormFields()' action='updateDetails.php?orderID=$orderID'>
                                <input type='text' name='forename' value='$customerForename'/>
                                <input type='text' name='surname' value='$customerSurname'/>
                                <input type='text' name='addressLine1' value='$customerAddr1'/>
                                <input type='text' name='addressLine2' value='$customerAddr2'/>
                                <input type='text' name='addressLine3' value='$customerAddr3'/>
                                <input type='text' name='addressLine4' value='$customerAddr4'/>
                                <input type='text' name='postcode' value='$customerPostcode'/>
                                <input type='submit' value='Edit Order'/></form>";
                    ?>  

            <div id="navigation" data-role="footer" data-position="fixed"> 
                <form method="post" action="logout.php">
                    <input type="submit" value="Logout" />
                </form>

                <div data-role="navbar">
                        <ul>
                            <li><a href="a.html">Reviews</a></li>
                            <li><a href="b.html">Info</a></li>
                            <li><a href="extras.php">Extras</a></li>
                            <li><a href="d.html">Summary</a></li>
                        </ul>
                </div>
            </div>
        </div> 
    </body>
</html>
