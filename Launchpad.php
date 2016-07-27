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
       <title>nativeDroid II - jQueryMobile Template</title>
       <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" href="nativedroid2.color.blue-grey.css" />
        <link rel="stylesheet" href="/cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="jquery.mobile.min.css" />
        <link rel="stylesheet" href="waves.min.css" />
        <link rel="stylesheet" href="nativedroid2.css" />

    </head>
    <body>
        <div data-role="header" data-position="fixed" class="wow fadeIn">
            <a href="#bottomsheetblock" class="ui-btn ui-btn-right wow fadeIn" data-wow-delay='1.2s'><i class="zmdi zmdi-more-vert"></i></a>
            <a href="#leftpanel" class="ui-btn ui-btn-left wow fadeIn" data-wow-delay='0.8s'><i class="zmdi zmdi-menu"></i></a>
            <h1 class="wow fadeIn" data-wow-delay='0.4s'>Header and footer Footer</h1>
</div>
        <!--Jquery Mobile without a theme <script type="text/javascript" src="//code.jquery.com/mobile/1.3.2/jquery.mobile.structure-1.3.2.min.css"></script>-->
            <script type="text/javascript" src="js/Launchpad.js"></script>
        <script type="text/javascript">
            function orderPrice(name) {
                var selectedItem = document.getElementsByName(name);
                
                var total = 0;
                
                for(var i = 0; i < selectedItem.length; i++) {
                    if(selectedItem[i].checked) {
                        total += parseFloat(selectedItem[i].title);
                    }
                }
                
                document.getElementById("total").value = "" + total.toFixed(2);
            }
            
            function toggleAddOrderVisibility() {       
                //Gets the elements based on particular properties and assign them 
                //to these variables.
                var cart = document.getElementById("addToOrder");
                var checkbox = document.getElementsByName("food[]");
                
                //Initialise variable i with value of 0, as long as i is less than the length of the checkbox element length, increment the value by 1.
                for(var i = 0; i < checkbox.length; i++) {
                    //If the submit button status is equal to 1 and at least 1 checkbox element is checked{
                    //enable the submit button.
                    //}
                    //Else { 
                    //submit is disabled.
                    //}
                    
                    if(checkbox[i].checked == true) {
                        cart.style.visibility = 'visible';
                        return;
                    }
                    else {
                        cart.style.visibility = 'hidden';
                    }
                }
            }
        </script>
    </head>
    <body>
        <div data-role="header" data-position="fixed">
            <h1>Music Reviewer</h1>
        </div>
        
        <div class="title">
                <h2>Please select a Genre or scroll to see our artist</h2>
        </div>
        
        <form method="post" id="options">
            <label for="type"><strong>To begin, please select a genre your interested in:
                <select name="selected" id="type">
                    <option value="Please Select">Please Select</option>
                    <?php

                            $sqlCategory = 'SELECT DISTINCT app_restaurant_category.catName, 
                                            app_restaurant_name.catID 
                                            FROM app_restaurant_category 
                                            INNER JOIN app_restaurant_name 
                                            ON app_restaurant_name.catID = app_restaurant_category.catID';

                            $results = mysqli_query($conn, $sqlCategory) or die(mysqli_error($conn));

                            while ($restaurantType = mysqli_fetch_assoc($results)) {
                               $catID = $restaurantType['catID'];
                                echo '<option value="'.$catID.'">'.$restaurantType['catName'].'</option>';
                            }

                            //mysqli_free_result($results);//Freeing up memory resources. 
                            //mysqli_close($conn);



                             $query ='SELECT * FROM nmc_cd
                            LEFT JOIN nmc_category ON nmc_category.catID = nmc_category.catID
                            LEFT JOIN nmc_publisher ON nbc_publisher.pubName =  nmc_publisher.pubID';

                   

            echo '<form method="post" id="search" action="SearchSubmit.php" >
                          <fieldset>
                          <legend>Song:</legend>
                          <input type="text" name="title">
                          </fieldset>
                        
                          <div>
                          <fieldset>
                          <ledgend>CD Description: </ledgend>';
                    ?>
                </select>
            </strong>
            </label>
        </form>
        
        <div id="progressbar">
            <div class="progress-label">
                Loading...
            </div>
        </div>
        
        <div class="Step 1: Personal information" data-role="header">
            <h1>
                
            </h1>
        </div>
        
        <section>
            <div class="Personal Information">
                <label id="displayRestaurant">Artist in our database. </label>
               
            </div>
        </section>
            
        <section>
                <div class="navigation" data-role="footer" data-position="fixed">         
                    <div id="addToOrder" style="visibility: hidden">
                        <form method="post" id="add" action="OrderSummary.php">
                            <label for="total"><strong>Total: <input type="text" name="total" id="total" value="0.00" size="10" readonly="readonly" />
                                    <input type="submit" value="Add To Cart" />
                            </strong></label>
                        </form>
                    </div>
                    
                    <div data-role="navbar">
                        <ul>
                            <li><a href="reviews.html">Reviews</a></li>
                            <li><a href="info.html">Info</a></li>
                            <li><a href="extras.php">Extras</a></li>
                        </ul>
                    </div>
                </div>
        </section>
    </body>
</html>
