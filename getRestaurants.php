<?php

    include 'database_conn.php';

    $selected = isset($_REQUEST['selected']) ? $_REQUEST['selected'] : null;

    $sqlRestaurant = "SELECT restaurantID,
                            restaurantName, 
                            restaurantOpen, 
                            restaurantClose, 
                            imageID
                            FROM app_restaurant_name 
                            INNER JOIN app_restaurant_category 
                            ON app_restaurant_category.catID=app_restaurant_name.catID 
                            WHERE app_restaurant_name.catID = $selected";

    $restaurantResults = mysqli_query($conn, $sqlRestaurant) or die(mysqli_error($conn));

        while ($row = mysqli_fetch_assoc($restaurantResults)) {
            $restaurantID = $row['restaurantID'];
            $restaurantName = $row['restaurantName'];
            $restaurantOpen = $row['restaurantOpen'];
            $restaurantClose = $row['restaurantClose'];
            $imageID = $row['imageID'];

            echo "<div id='available'><table><br><a href='#' class='select' page='restaurantFood.php?restaurantID=$restaurantID'>Name: $restaurantName</a></br>
                                    <br><p name='$restaurantOpen'>Open: $restaurantOpen</p></br>
                                    <br><p name='$restaurantClose'>Closed: $restaurantClose</p></br>
                                    <br><div id='status'><strong></strong></div></br> 
                                </table></div>";
        }

        //echo $_REQUEST['selected'];
        mysqli_free_result($restaurantResults); //Freeing up memory resources.

        mysqli_close($conn);

