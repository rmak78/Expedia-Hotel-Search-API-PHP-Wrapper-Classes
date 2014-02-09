<?php
require_once("../functions.php");

 $hotels = $myapi->getHotelList(array(
  'destinationString' =>  $destinationString ,
  'stateProvinceCode' => $stateProvinceCode,
  'countryCode' => $countryCode,
 
 
));


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width" />
        <meta name="description" content="Expedia Hoter Search API PHP Wrapper Example" />
        <meta name="author" content="Mansoor Rana"/>
        <title>Hotel Results</title>       
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
      <script src="js/html5shiv.js"></script>
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
                                <li class="navbar-link">
                                    <a href="#searchForm" title="Change your search criteria">
                                        Change your search criteria
                                    </a>
                                </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            



<div id="searchForm" class="well" style="display: none">
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
			</form></div>            


<div class="well">
    
    <div class="row-fluid">
        
        <div class="span6">
            <h2 class="pull-left">Available Hotels
                <small><?php

echo $myapi->getTotalHotels() ;

?></small>
            </h2>
        </div>
        
        <div class="span6">
<form action="search-results.php" class="form-search pull-right" method="get"><input id="SortOrder" name="SortOrder" type="hidden" value="" /><input class="input-medium search-query" id="SearchString" name="SearchString" placeholder="hotel name..." type="text" value="" />                <button class="btn btn-small btn-info" type="submit">Search</button>
</form>        </div>
    </div>
    
    <div class="row-fluid">
        <div class="pull-left">
            




<div class="pagination pagination-mini">
    <ul>
            
            <li class="disabled"><span>&lt;</span></li>
            <li class="disabled"><span>&lt;&lt;</span></li>

                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
        
            <li>
                <a href="#">&gt;</a>
            </li>
            <li>
                <a href="#">&gt;&gt;</a>
            </li>
    </ul>
</div>

        </div>
        <div class="pull-right">
            <select id="Sort" name="Sort"><option value="Price asce">Price - Low to High</option>
<option value="Price desc">Price - High to Low</option>
<option value="Rating asce">Rating - Low to High</option>
<option value="Rating desc">Rating - High to Low</option>
</select>
        </div>
    </div>
 <?php

foreach($hotels  as $key => $value) {  

$hotelId = $value['hotelId'];
$name = $value['name'];
$address1 = $value['address1'];
$city = $value['city'];
$stateProvinceCode = $value['stateProvinceCode'];
$postalCode = $value['postalCode'];
$countryCode = $value['countryCode'];
$airportCode = $value['airportCode'];
$supplierType = $value['supplierType'];
$propertyCategory = $value['propertyCategory'];
$hotelRating = $value['hotelRating'];
$confidenceRating = $value['confidenceRating'];
$amenityMask = $value['amenityMask'];
$tripAdvisorRating = $value['tripAdvisorRating'];
$tripAdvisorReviewCount = $value['tripAdvisorReviewCount'];
$tripAdvisorRatingUrl = $value['tripAdvisorRatingUrl'];
$locationDescription = $value['locationDescription'];
$shortDescription = $value['shortDescription'];
$highRate = $value['highRate'];
$lowRate = $value['lowRate'];
$rateCurrencyCode = $value['rateCurrencyCode'];
$latitude = $value['latitude'];
$longitude = $value['longitude'];
$proximityDistance = $value['proximityDistance'];
$proximityUnit = $value['proximityUnit'];
$hotelInDestination = $value['hotelInDestination'];
$thumbNailUrl = 'http://images.travelnow.com'.$value['thumbNailUrl'];
$deepLink = $value['deepLink']; 




?>  

<!-- Result -->      
        <div class="hotel well" id="<?php echo  $hotelId ; ?>" style="background-color: white">
            
            <input data-val="true" data-val-number="The field HotelId must be a number." data-val-required="The HotelId field is required." id="hotel_HotelId" name="hotel.HotelId" type="hidden" value="<?php echo  $hotelId ; ?>" />
            <input data-val="true" data-val-number="The field Latitude must be a number." data-val-required="The Latitude field is required." id="hotel_Latitude" name="hotel.Latitude" type="hidden" value="<?php echo  $latitude ; ?>" />
            <input data-val="true" data-val-number="The field Longitude must be a number." data-val-required="The Longitude field is required." id="hotel_Longitude" name="hotel.Longitude" type="hidden" value="<?php echo  $longitude; ?>" />
            <input id="Session_DestinationId_" name="Session[DestinationId]" type="hidden" value="" />

            <!-- Hotel Name and expedia star rating -->
            <div class="row-fluid">
                <div class="span6">
                    <span title="<?php echo  $hotelId ; ?>"><b><?php echo  $name ; ?></b></span>
                    <div class="rateit" data-rateit-value="<?php echo  $hotelRating ; ?>" data-rateit-min="0" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                </div>
                <div class="span6">
                    <h3 class="pull-right" style="margin-top: -10px; margin-bottom: -25px;">
                        <small>Averaging </small><span><small><?php echo  $rateCurrencyCode ; ?></small></span><?php echo  round(($highRate+$lowRate)/2,2)   ; ?><small> / night </small>
                    </h3>
                </div>
            </div>
            <br />

            <!-- Hotel Properties -->
            <div class="row-fluid">
                
                <!-- Thumbnail -->
                <div class="span1">
                    <img class="img-rounded" width="150" height="150" alt="Hotel Thumbnail" src="<?php echo  $thumbNailUrl ; ?>" title="<?php echo  $hotelId ; ?>" />
                    <p>
                        <a class="hide" href="<?php echo $deepLink; ?>">Deep Link</a>
                    </p>
                </div>
                
                <!-- Address -->
                <div class="span2">
                    <span class="label label-info">
                        <i class="icon-home"></i> Address
                    </span>
                    <span class="label label-info" title="Nearest Airport (IATA Code)">
                        <i class="icon-plane"></i><?php echo $airportCode; ?>
                    </span>
                    <address>
<?php echo $address1; ?><br />
                                                <?php echo $city; ?><br />
                        <?php echo $postalCode; ?><br />
                    </address>
                </div>
                
                <!-- Short Description -->
                <div class="span4">
                    <span class="label label-info">
                        <i class="icon-info-sign"></i> Summary
                    </span>
                   
                    
<p><?php 
//remove extra tags
$shortDescription = str_replace("<p><b>Property Location</b> <br />","",$shortDescription);
echo $shortDescription; 

?></p>

                </div>
  
                <!-- Google Map -->
                <div class="span2">
                    <p>


                        <img title="<?php echo  $latitude ; ?>,<?php echo  $longitude; ?>" src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo  $latitude ; ?>,<?php echo  $longitude; ?>&amp;zoom=15&amp;size=150x150&amp;sensor=false&amp;key=AIzaSyDm7lXUQTaEvPo-eghcFIo2VjJvyKawKUo&amp;markers=size%3asmall%7ccolor%3ablue%<?php echo  $latitude ; ?>%2c<?php echo  $longitude; ?>" alt="Google Map" class="img-rounded" height="150" width="150" />
                        <br />
                    </p>
                </div> 
                
                <div class="span2">
                    
                    <div class="row">
                        <!-- Hotel Amenities -->
                        <div class="pull-left">
                            <ul class="unstyled" style="margin-left: 10px;">
                                
                                                <li>
                                                    <!-- Amenity BusinessCenter -->
                                                    <span><i class="icon-ok-sign"></i> Business Center</span>
                                                </li>
                                                <li>
                                                    <!-- Amenity FitnessCenter -->
                                                    <span><i class="icon-ok-sign"></i> Gym</span>
                                                </li>

                            </ul>
                        </div>                        
                    </div>
                </div>

            </div>
            
            <!-- Row -->
            <div class="row-fluid" style="margin-bottom: -10px">
                
                <div class="span12">
                    
                    <div class="span6">
                        <p class="distance">
                            <!-- ADDITIONAL -->
                        </p>
                    </div>
                    
                    <div class="span6">
                        <!-- HOTEL GALLERY AJAX CALL -->
                        <div class="buttons pull-right">

                            <a href="#gallery" data-toggle="modal" class="btn btn-mini btn-info">
                                Photo Gallery <i class="icon-camera"></i>
                                <input type="hidden" value="124266" />
                            </a>
                            <!-- DETAILS LINK -->


                            <a href="hotel-details.php?hotelId=124266" class="btn btn-mini btn-info">
                                <span>Hotel Details </span><i class="icon-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>   
            </div>
        </div>
<!-- Result -->    
<?php

 }

?>
<!-- End Hotel Results -->
    




<div class="pagination pagination-mini">
    <ul>
            
            <li class="disabled"><span>&lt;</span></li>
            <li class="disabled"><span>&lt;&lt;</span></li>

					<li class="active">
                        <a href="#">1</a>
                    </li>
                    <li>
                        <a href="#">2</a>
                    </li>
                    <li>
                        <a href="#">3</a>
                    </li>
                    <li>
                        <a href="#">4</a>
                    </li>
                    <li>
                        <a href="#">5</a>
                    </li>
            <li>
                <a href="#">&gt;</a>
            </li>
            <li>
                <a href="#">&gt;&gt;</a>
            </li>
    </ul>
</div>


</div>

<!-- HOTEL GALLERY MODAL -->
<div id="gallery" class="modal hide fade" tabindex="-1" role="dialog">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Hotel Gallery</h3>
    </div>
    <div class="modal-body">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
            </div>
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
        <p style="text-align: center">Note: It is the responsibility of the hotel to ensure accuracy of photos.</p>
    </div>
    <div class="modal-footer">
         
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
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

            // ----------------------------------------------------------------
            // Distance to Landmark -------------------------------------------
            // ----------------------------------------------------------------

            var hotelList = [];
            var destinationId = $(this).find('input[name="Session[DestinationId]"]').val();

            $(".hotel").each(function() {

                var hotel = {};
                hotel.HotelId = $(this).attr('id');
                hotel.Latitude = $(this).find('input[name="hotel.Latitude"]').val();
                hotel.Longitude = $(this).find('input[name="hotel.Longitude"]').val();
                hotelList.push(hotel);
                
            });

            calculateLandmarkDistance(hotelList, destinationId);

            function calculateLandmarkDistance(hotels, dest) {

                console.log("Ajax begin");

                $.ajax({
                    url: '/Distance/Index/1',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    data: JSON.stringify({
                            hotels: hotels,
                            destinationId: dest
                        }),
                    async: true,
                    success: function(data) {

                        console.log("Landmark: " + data.Landmark);

                        $.each(data.Hotels, function(index, item) {

                            console.log("hotel:" + item.HotelId);
                            console.log("Distance:" + item.Distance);

                            $('div#' + item.HotelId).find('p.distance').html('Distance to ' + data.Landmark + ' is ' + item.Distance);

                        });
                    },
                    error: function(msg) {

                        console.log("Error getting calculate distance to Landmark");
                    }
                });
            }

            // ----------------------------------------------------------------
            // Rate It --------------------------------------------------------
            // ----------------------------------------------------------------

            $('.rateit').rateit();

            var tooltipvalues = ['Economy', 'Moderate', 'First Class', 'Superior', 'Deluxe'];

            $.each($(".rateit"), function(index, item) {

                $(this).attr('title', tooltipvalues[$(item).rateit('value') - 1]);

            });

            // ----------------------------------------------------------------
            // Result sorting -------------------------------------------------
            // ----------------------------------------------------------------

            $('select#Sort').val($('input#SortOrder').val());

            $('select#Sort').change(function(e) {
                $('input#SortOrder').attr('value', $(this).val());
                $('form[method="get"]').submit();
            });            


            // ----------------------------------------------------------------
            // Hotel Image Gallery --------------------------------------------
            // ----------------------------------------------------------------


            //http://stackoverflow.com/questions/13391566/twitter-bootstrap-carousel-different-height-images-cause-bouncing-arrows            
            $("a[href='#gallery']").click(function() {

                $.ajax({
                    url: '/Hotels/Images',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        id: $(this).find('input[type="hidden"]').val()
                    },
                    success: function(data) {

                        $('.carousel-inner').html('');

                        $.map(data, function(item) {
                            var html =
                                "<div class='item hotel-image'>" +
                                    "<img alt='' title='" + item.name + "' src='" + item.Url + "' class='img-polaroid hotel-image' style='float:none; margin-left: auto; margin-right: auto;' />" +
                                    "<div class='carousel-caption'>" +
                                    "<h4>" + (item.caption != "" ? item.Caption : "") + "</h4>" +
                                    "</div>" +
                                    "</div>";

                            $('.carousel-inner').append(html);

                            $('.item').find('h4').each(function() {

                                if ($(this).val() === "") {

                                    $(this).parent('.carousel-caption').hide();

                                }
                            });
                        });

                        $('.carousel-inner div.item:first').attr('class', 'item active');
                        $('div#gallery').modal('show');
                        $('.carousel').carousel();
                    }
                });
            });
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
