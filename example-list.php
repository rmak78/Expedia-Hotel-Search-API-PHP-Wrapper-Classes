<?php
require_once("api-config.php");
require_once("expedia-api.php");
session_start();

$myapi = new API( $customer_id , $api_public_key );
$myapi->set_customer_session_id( session_id() );
$myapi->set_customer_ip_address($_SERVER['REMOTE_ADDR']);
$myapi->set_customer_user_agent($_SERVER['HTTP_USER_AGENT']);
$myapi->set_currency_code($currency_code);
$myapi->set_minor_rev($minor_rev);
$myapi->set_locale($locale);

// Check what are payment options

$payment_options = $myapi->getPaymentOptions($currency_code, $locale);
 
 var_export(  $payment_options );


// get hotels list for specified destination
$hotels = $myapi->getHotelList(array(
  'city' => 'chicago',
  'arrivalDate' => '10/10/2014',
  'departureDate' => '10/11/2014',
  'numberOfResults' => 5,
  'room1' => 1
));

//list total hotels available in search
 echo $myapi->getTotalHotels() ;
 

// list hotels available in return list
 echo $myapi->getAvailableHotels();
 
 

 var_export( $hotels);


 
// get hotel info

$sample_hotel_id = $hotels[0]['hotelId'] ;
 
$info = $myapi->getHotelInfo( $sample_hotel_id );
 var_export( $info ); 
 
// get Available Rooms information
 
  $available_rooms = $myapi->getAvailableRooms( array( 
		'hotelId'=> $sample_hotel_id ,
		'arrivalDate' => '10/10/2014',
		'departureDate' => '10/11/2014',
		'includeDetails' => False,
		'options' => 'HOTEL_DETAILS , ROOM_AMENITIES'
		));

  var_export( $available_rooms ); 
 ?> 