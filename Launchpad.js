$(document).ready(function() {
    //Animations to be called once page is ready.
    
    $('#loginPage').show('slide');
    $('.title').show('blind');
    $('#options').fadeIn(2000);

    //This snippet targets the getOffers div, and a .text method is attached to function showOffers.
    //An Ajax request is then made to get the data and provide a response in a JSON format, using the getRestaurantOffers.php
    //script in order to execute the query.
    //Once complete, a .done method is provided and a new function is called, passing the result from the PHP script and whether
    //it passed or failed as the 2 parameters.
    //A variable is assigned to the #getOffers div and an append method targeting the div tag is attached, therefore assigning
    //the value from this div into a variable.
    //Log the results to the console window and log the status, as well as any results returned.
    //With each offerResult, manipulate the offers variable and apply the returned JSON format response to the div.
    //Note that offerResult, offerPrice and restaurantName are linked to the results returned from each column that is 
    //targeted within the PHP script.
    $('#getArtists').text(function showOffers() {
        $.ajax ({
                method: "get",
                dataType: "json",
                url: "getArtist.php"
            })
            .done(function(offersResult, status) {
                var details = $('#getArtist').append('<div/>');
                window.console && console.log(status + '\n'+artistResult);
                $(artistResult).each(function () {
                    $(offers).html("<p> Today's Featured Artist: "+this.artist_firstname+
                                        ", "+this.artist_surname+
                                        ", "+this.artist_notes+"</p>");
                });
        });
        //setInterval(showOffers, 3000);
    });
    
    //Basic CSS manipulation of the text color to change colour every second, and then reset to normal after 2 seconds.
    setInterval(function() {
        $("#getArtist").css("color", "white"); 
        setTimeout(function () {
        $("#getArtist").css("color", "black");
    }, 1000);
    }, 3000);
    
    $('#options').submit(function(e) {
        
        //Assigns the select element with the ID of type to a variable.
        var type = $('#type');
        
        //Using the newly assigned type variable in order to determine it's value.
        //If value is Please Select or null, display an alert to the user and prevent the default action of the form submission from going ahead.
        //Else, perform as per normal application behaviour.
        if(type.val() == "Please Select" || null) {
            alert("Please select an option!");
            //Assigns parameter passed into function when clicked in order to only stop the default action performing.
            e.preventDefault();
        } else {
            $('#options').hide('blind');
            $('.title').hide('blind');
            $('.login').css('display', 'inline-block');
            $('.progress-label').css('display', 'block');
            
            e.preventDefault();
            
            //Assignment of the progressbar div ID and the progress-label div class to variables.
            //These will be used to refer to these elements when calculating the value of the progress bar when invoked.
            var barProgress = $('#progressbar');
            var progressLabel = $('.progress-label');
            
            //Creating the functionality for the progressbar element.
            //Initial value is set to false. 
            //However, 2 functions (change: when progressbar is not complete, complete: when progressbar job is done) are used to feedback status to the user.
            //Progress function begins the process of initialising the current value (or if it's 0) as it's starting state and then invoking further behaviour once value reaches 100.
            $('#progressbar').progressbar({
                value: false,
                change: function() { 
                    progressLabel.text(barProgress.progressbar('value') + '%');
                },
                complete: function() {
                    progressLabel.text('Loading Completed!');
                }
            });
            function progress() {
                var barValue = barProgress.progressbar('value') || 0;
                barProgress.progressbar('value', barValue + 1);
                if(barValue < 99) {
                     setTimeout(progress, 100);
                }
                else if(barValue = 100) {
                    
                    //Animations for when barvalue = 100.
                    $('#progressbar').hide('blind', 1000);
                    $('.artist').fadeIn(2000);
                    
                    //Ajax call to append the data retrieved from the getArtist.php to the UI, without having to refresh the page.
                    $('#displayRestaurant').text(function () {
                        $.ajax({
                            method: "get",
                            url: "getArtist.php?selected=" + type.val() 
                        })
                        .done(function (results, status) {
                                var details = $('#getArtist').append('<div/>');
                                window.console && console.log(status + '\n'+results);
                                $(results).each(function () {
                                    $(artist).html(results);
                                        $('.artist').fadeIn(2000);
                                     
                                        //Message to be displayed based on time of day.
                                        
                                         $(".select").click(function(e) {
                                             //preventDefault() method is used to stop the default action occurring.
                                             //For example, if you were to use return false; with a form, it would not submit.
                                             //Whilst preventDefault would still submit the form, but remain on the same page.
                                             e.preventDefault();
                                             
                                             $('.artist').hide('blind');
                                             $('.addItems').fadeIn(1000);
                                             $('.navigation').slideDown('blind');
                                         
                                    });
                                });

                            }
                        )
                        .fail(function(textStatus, errorThrown) {
                                 window.console && console.log(textStatus + ': ' + errorThrown);
                            }
                        );
                    });
                }
            }
            setTimeout(progress, 3000);
        }
    });
    
});



