<?php
require_once("../functions.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="Expedia Hoter Search API PHP Wrapper Example" />
        <meta name="author" content="Mansoor Rana"/>
        <title>Search</title>       
        <link href="css/themes/bootstrap/jquery-ui-1.9.2.custom.css" rel="stylesheet"/>
<link href="css/bootstrap.css" rel="stylesheet"/>
<link href="css/expedia.css" rel="stylesheet"/>
<link href="css/rateit.css" rel="stylesheet"/>

        
        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
        </style>
           <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="/scripts/html5shiv.js"></script>
    <![endif]-->

        <script type="text/javascript" src="js/modernizr-2.6.2.js"></script>
    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </a>
                    <a class="brand" href="#">Search Hotels via Destination String</a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
<div class="container">
          
	<div class="row">
		<div class="span12">
			<div id="searchForm" class="well"  >
			<form action="search-results.php" class="form form-horizontal" method="post"> 
			<fieldset>
						<legend>Search for a Hotel</legend>
					 <!-- ARRIVAL -->
						<div class="control-group">
							<label class="control-label" for="CheckinDate">Check-in Date</label>
							<div class="controls">
								<div class="input-append">
									<input class="input-small" data-val="true" data-val-date="The field CheckinDate must be a date." data-val-required="The CheckinDate field is required." id="CheckinDate" name="CheckinDate" type="text" value="1/1/0001 12:00:00 AM" />
									<span class="add-on"><i class="icon-calendar"></i></span>
								</div>
								<span class="field-validation-valid" data-valmsg-for="CheckinDate" data-valmsg-replace="true"></span>
							</div>
						</div>	
				 <!-- DEPARTURE -->
						<div class="control-group">
							<label class="control-label" for="CheckoutDate">Check-out Date</label>
							<div class="controls">
								<div class="input-append">
									<input class="input-small" data-val="true" data-val-date="The field CheckoutDate must be a date." data-val-required="The CheckoutDate field is required." id="CheckoutDate" name="CheckoutDate" type="text" value="1/1/0001 12:00:00 AM" />
									<span class="add-on"><i class="icon-calendar"></i></span>
								</div>
								<span class="field-validation-valid" data-valmsg-for="CheckoutDate" data-valmsg-replace="true"></span>
							</div>
						</div>
						
						 <!-- DESTINATION STRING -->
						<div class="control-group">
							<label class="control-label" for="Destination">Destination</label>
							<div class="controls">
								<input class="input-xlarge" data-val="true" data-val-required="The Destination field is required." id="Destination" name="Destination" placeholder="City, Province, Country" type="text" value="" />
								<span class="field-validation-valid" data-valmsg-for="Destination" data-valmsg-replace="true"></span>
								<br />
								
							</div>
						</div>

								 <!-- SUBMIT -->
						<div class="form-actions">
							<button type="submit" class="btn btn-primary">
								<i class="icon-search"></i> Search
							</button>
						</div>
			</fieldset>
			</form>
			</div>
		</div>
	</div>




            <hr />
            <footer>
                <div class="span4">
                    <p>Copyright &copy; 2014 Sutlej.NET</p>
                </div>
                <div class="span3">
                    <img src="css/images/affiliatedwith_EAN.jpg" alt="Expedia Affiliate Network" title="Affiliated with Expedia Affiliate Network" />
                </div>
                <div class="span4">
                    <a class="pull-right" href="http://www.w3.org/html/logo/">
                        <img src="http://www.w3.org/html/logo/downloads/HTML5_Logo_32.png" width="32" height="32" alt="HTML5 Powered with CSS3 / Styling, and Semantics" title="HTML5 Powered with CSS3 / Styling, and Semantics" />
                    </a>
                </div>
            </footer> 
        </div>
        <!-- Le javascript
            ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery-1.9.0.js"></script>
<script src="js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery.validate.js"></script>
<script src="js/jquery.validate.unobtrusive.js"></script>
<script src="js/jquery.validate.unobtrusive-custom-for-bootstrap.js"></script>
<script src="js/jquery.rateit.js"></script>
<script src="js/bootstrap.js"></script>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDm7lXUQTaEvPo-eghcFIo2VjJvyKawKUo&amp;sensor=false&amp;libraries=places,geometry,weather"></script>

        
    <script type="text/javascript">

        $(document).ready(function() {
            $('div#searchForm').show();
        });
        
    </script>

        <script type="text/javascript">

            // Search form
            $(document).ready(function() {

                $('a[href="#searchForm"]').click(function(e) {
                    e.preventDefault();
                    if ($('div#searchForm').is(':visible')) {
                        $('div#searchForm').slideUp('slow');
                    } else {
                        $('div#searchForm').slideDown('slow');
                    }
                });

                // ----------------------------------------------------------------
                // Auto Suggestions -----------------------------------------------
                // ----------------------------------------------------------------

                // http://api.jqueryui.com/autocomplete/#event-select

                $("input#Destination").autocomplete({
                    source: function(request, response) {
                        $.ajax({
                            url: '/Places/AutoSuggestDestination', // Call the Google Ajax controller
                            type: "GET", // HTTP GET
                            dataType: "json",
                            data: {
                                text: request.term
                            },
                            success: function(data) {

                                response($.map(data, function(item) {
                                    return {
                                        label: item.suggestion,
                                        value: item.suggestion
                                    };
                                }));
                            },
                            error: function() {

                                return {
                                    label: "There was an error getting suggested locations",
                                    value: ""
                                };
                            }
                        });
                    },
                    select: function(event, ui) {
                        console.log("Selected " + ui.item.value);
                        populateNearbyLandmarks(ui.item.value);
                    },
                    minLength: 3
                });


                // ----------------------------------------------------------------
                // Dates ----------------------------------------------------------
                // ----------------------------------------------------------------

                $("input#CheckinDate").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    constrainInput: true,
                    numberOfMonths: 2,
                    minDate: 0,
                    //dateFormat: 'dd/mm/yy',
                    onClose: function(selectedDate) {

                        $("input#CheckoutDate").datepicker("option", "minDate", selectedDate);
                        $("input#CheckoutDate").datepicker("option", "maxDate", new Date(selectedDate).addDays(30));
                    }
                });

                $("input#CheckoutDate").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    constrainInput: true,
                    numberOfMonths: 2,
                    minDate: 0,
                    //dateFormat: 'dd/mm/yy',
                    onClose: function(selectedDate) {
                        $("input#CheckinDate").datepicker("option", "maxDate", selectedDate);
                        $("input#CheckinDate").datepicker("option", "minDate", new Date(selectedDate).addDays(-30));
                    }
                });

                $("input#CheckinDate").datepicker("setDate", +1);
                $("input#CheckoutDate").datepicker("setDate", +7);


                // ----------------------------------------------------------------
                // Ratings --------------------------------------------------------
                // ----------------------------------------------------------------

                $('div#starMinimum').rateit({
                    min: 0,
                    max: 5,
                    backingfld: '#MinimumStarRating',
                    resetable: false,
                    ispreset: true,
                });

                $('div#starMaximum').rateit({
                    min: 0,
                    max: 5,
                    backingfld: '#MaximumStarRating',
                    resetable: false,
                    ispreset: true,
                });

                var tooltipvalues = ['Economy', 'Moderate', 'First Class', 'Superior', 'Deluxe'];

                $(".star").bind('over', function(event, value) {
                    $(this).attr('title', tooltipvalues[value - 1]);
                });

                // Make sure minimum and maximum ratings make logical sense

                $("div#starMinimum").bind('rated', function(event, value) {

                    var min = $('div#starMinimum').rateit('value');
                    var max = $('div#starMaximum').rateit('value');

                    if (min > max) {
                        $('div#starMaximum').rateit('value', min);
                    }

                });

                $("div#starMaximum").bind('rated', function(event, value) {

                    var min = $('div#starMinimum').rateit('value');
                    var max = $('div#starMaximum').rateit('value');

                    if (max < min) {
                        $('div#starMaximum').rateit('value', min);
                    }

                });

                $('input#MinimumStarRating').hide();
                $('input#MaximumStarRating').hide();

                $("div#starMaximum").rateit('value', 5);
                $("div#starMinimum").rateit('value', 1);

                // ----------------------------------------------------------------
                // Reset Multi Select List Options --------------------------------
                // ----------------------------------------------------------------

                $('a.btn-info').click(function() {
                    $(this).parent('div.controls').find('select option:selected').removeAttr('selected');
                });

                // ----------------------------------------------------------------
                // Room -----------------------------------------------------------
                // ----------------------------------------------------------------

                $('ol.rooms > :not(li:first)').hide(); // hide all rooms except first

                function roomSort() {

                    var idx = $('select#NumberOfBedrooms').val();

                    $('ol.rooms > li:gt(' + (idx - 1) + ')').each(function() {
                        $(this).slideUp('slow');
                    });

                    // Less than the number of rooms wanted, show
                    $('ol.rooms > li:lt(' + (idx) + ')').each(function() {
                        $(this).slideDown('slow');
                    });
                }

                $('select#NumberOfBedrooms').change(function() {
                    roomSort();
                });

                roomSort();

                // ----------------------------------------------------------------
                // Children -------------------------------------------------------
                // ----------------------------------------------------------------

                $('div.input-prepend.age').hide(); // Hide all child ages initially

                $('select[name$=".Children"]').change(function() {
                    sortChildAges();
                });

                function sortChildAges() {

                    $('select[name$=".Children"]').each(function() {

                        var select = $(this);
                        var children = $(this).val();

                        console.log("Children Selected: " + children);

                        var ageSelects = $(select.closest('.room').find('.age select'));

                        $(select.closest('.room').find('.age select')).each(function() {
                            $(this).parent('div.age').hide(); // hard hide reset
                        });

                        for (var i = 0; i < children; i++) {

                            $(ageSelects[i]).parent('div.age').show();
                        }

                    });
                }

                sortChildAges();


                // ----------------------------------------------------------------
                // Amenities ------------------------------------------------------
                // ----------------------------------------------------------------

                $('form a[href="#amenities"]').tooltip({
                    placement: 'right',
                    animation: true,
                    html: false,
                    selector: false,
                    title: 'Select upto 3 amenities',
                });

                $('input[name="Amenities"]:checkbox').click(function() {

                    console.log("Checkbox event fired");

                    if ($('input[name="Amenities"]:checked').length === 3) {
                        $('input[name="Amenities"]:not(:checked)').attr("disabled", true);
                    } else {
                        $('input[name="Amenities"]').removeAttr("disabled");
                    }
                });

                // Keep the checkbox button list open
                $('.dropdown-menu input, .dropdown-menu label').click(function(e) {
                    e.stopPropagation();
                });


                // ----------------------------------------------------------------
                // Lankmark Proximity ---------------------------------------------
                // ----------------------------------------------------------------

                $('#destinationId').closest('.controls').find('span.add-on');

                if ($('input#Destination').length > 0) {

                    console.log("Pre-populating any landmarks...");
                    populateNearbyLandmarks($('input#Destination').val());

                } else {

                    console.log("No destination selected...");
                    $('select#destinationId').append($("<option></option>").attr("value", "").text("Enter a destination"));
                }


                function populateNearbyLandmarks(destination) {

                    // Set the loading text in the select list
                    $('select#destinationId').html("<option value=''>" + 'Checking for landmarks...' + "</option>");

                    // Start the loading gif
                    $('#destinationId').closest('div.controls').find('span.add-on').show();

                    // Get nearby landmarks based on the users input destination string

                    $.ajax({
                        url: '/Search/Landmarks',
                        type: "GET", // HTTP GET
                        dataType: "json",
                        data: {
                            destinationString: destination
                        },
                        success: function(data) {

                            // Remove any pre-populated options
                            $('select#destinationId option').remove();

                            if (data.length > 0) {

                                // Ok, so we have some results to show

                                $.each(data, function(index, landmark) {

                                    // console.log(landmark.description + "[" + landmark.destinationId + "]");

                                    var option = "<option value='" + landmark.destinationId + "'>" + landmark.description + "</option>";
                                    $('select#destinationId').append(option);

                                });

                                $('select#destinationId').prepend("<option value='' selected='selected'>All</option>");
                                $('select#destinationId').scrollTop(10);

                            } else {

                                $('select#destinationId').html($("<option></option>").attr("value", "").text("No landmarks available"));

                            }

                            $('select#destinationId').effect("highlight", {
                                color: '#3a87ad' // Bootstrap Info Colour
                            }, 500);

                        },
                        error: function(e) {

                            console.log("Error populating landmarks from response: " + e);

                            $('select#destinationId').html($("<option></option>").attr("value", "").text("No landmarks available"));
                        }
                    });

                    // Stop the loading gif
                    $('#destinationId').closest('.controls').find('span.add-on').hide();
                }
            });
            
        </script>

    </body>
</html>