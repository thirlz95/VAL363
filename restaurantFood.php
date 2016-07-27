<?php
                    
                        include 'database_conn.php';

                        $sql = "SELECT artist_id, 
                                artist_firstname, 
                                artist_surname, 
                                artist_genre
                                FROM artists";

                        //Executes the query and stores the result set of said query, or fail the connection.
                        $artistResults = mysqli_query($conn, $sql) or die (mysqli_error($conn));

                        //while loop used to fetch details for each record from the DB and stores them in variables
                        while($artistRow = mysqli_fetch_assoc($artistResults)) {
                            $artistID = $artistRow['artist_id'];
                            $artistFirstname = $artistRow['artist_firstname'];
                            $artistSurname = $artistRow['artist_surname'];
                            $artistType = $artistRow['artist_genre'];
                            
                            //Echo's out each variable and the values they retrieved from the DB
                                echo "<br>$artistFirstname, $artistSurname, $artistType
                                <input type='checkbox' id='availableArtist' onclick='orderPrice(this.name), toggleAddOrderVisibility()' name='artist[]' value='{$artistFirstname}' title='{$artistSurname}' /></br>";
                        }   

                        mysqli_free_result($artistResults); 
                        mysqli_close($conn); 
                    
