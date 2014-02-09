<?php 

// add config file to set API keys and other variables
require_once("api-config.php");
// add API Class container
require_once("expedia-api.php");

// Start session
session_start();

// initiate the API object
$myapi = new API( $customer_id , $api_public_key );

// set some basics parameters
$myapi->set_customer_session_id( session_id() );
$myapi->set_customer_ip_address($_SERVER['REMOTE_ADDR']);
$myapi->set_customer_user_agent($_SERVER['HTTP_USER_AGENT']);
$myapi->set_currency_code($currency_code);
$myapi->set_minor_rev($minor_rev);
$myapi->set_locale($locale);

/*********************************************************************/	
/************************Base Parameters****************************/
/*********************************************************************/	
 
/*=====================================================
arrivalDate 	string 	yes for availability 	
------------------------------------------------------
Check-in date, in MM/DD/YYYY format.
Availability for Expedia Collect properties can be searched up to 500 days in advance.
Hotel Collect/Hotel Collect availability can be searched up to 320 days in advance.
----------------------------------------------------------------------------------*/
if(isset( $_POST['arrivalDate'])) {

$arrivalDate = $_POST['arrivalDate'];
//#############check for date format and conditions here ########
}



/*===================================================
departureDate 	string 	yes for availability 	
------------------------------------------------------
Check-out date, in MM/DD/YYYY format.
Total length of stay cannot exceed 29 nights.
----------------------------------------------------------------------------------*/
if(isset( $_POST['departureDate'])) {

$departureDate = $_POST['departureDate'];
//#############check for date format and conditions here ########

}




/*=====================================================
numberOfResults 	int 	no 	
------------------------------------------------------
Maximum number of hotels to return. Acceptable value range is 1 to 200. Default: 20
Does not limit results for a dateless list request.
----------------------------------------------------------------------------------*/
if(isset( $_POST['numberOfResults'])) {

$numberOfResults = $_POST['numberOfResults'];
//#############check if dates are set above then discard otherwise check if number within range ########

}





/*=====================================================
Room 	object 	yes for availability 
------------------------------------------------------
Container for the Room array The REST format compacts the values from the previous elements into a comma-delimited list. To declare a room and its occupants, use the following format:
&room[room number, starting with 1]=
[number of adults],
[comma-delimited list of children's ages]
For example, to declare that a room has one adult and two children ages 5 and 12, you would send &room1=1,5,12 . There is no separate declaration for the number of children - each age value is assumed to belong to a child.
----------------------------------------------------------------------------------*/













/*=====================================================
includeDetails 	boolean 	yes for two-step booking 	
------------------------------------------------------
Determines whether or not a rate key, cancellation policies, bed types, and smoking preferences should be returned with each room option. Requesting these values at this level allows you to offer a two-step booking path directly from the list results.
Returns additional elements only with minorRev=22 or above.
V3 Turbo users: please note that including this parameter will prevent you from receiving a V3 Turbo cached response. Only standard, uncached responses will be returned.
----------------------------------------------------------------------------------*/








/*=====================================================
includeHotelFeeBreakdown 	boolean 	no 	
------------------------------------------------------
Returns the element HotelFeeBreakdown, which contains a more detailed response structure for the HotelFees array that includes how often each fee applies and how it is applied. Available with minorRev=24 and higher.
/======================================================
*********************************************************************/

















/*********************************************************************/	
/************************Search by Methods****************************/
/*********************************************************************/	
//Method 1: City/state/country search
/******************************************************************/	 	
/*=====================================================
city 	string 	yes
------------------------------------------------------
City to search within. Use only full city names.
----------------------------------------------------------------------------------*/
if(isset( $_POST['city'])) {

$city = $_POST['city'];
//#############check if a valid cityname is provided. might need a function ########

}



/*=====================================================
stateProvinceCode 	string 	yes for US,CA, AU 	
------------------------------------------------------
Two character code for the state/province containing the specified city.
References:  US State Codes, Canadian Province/Territory Codes, Australian Province/Territory Codes
----------------------------------------------------------------------------------*/
$stateProvinceCode = 'IL';
if(isset( $_POST['stateProvinceCode'])) {

$stateProvinceCode = $_POST['stateProvinceCode'];
//#############check if a valid State/Province code is provided. might need a function ########

}


/*====================================================
countryCode 	string 	yes	
------------------------------------------------------
Two character ISO-3166 code for the country containing the specified city. Use only country codes designated as "officially assigned" in the ISO-3166 decoding table.
----------------------------------------------------------------------------------*/	
$countryCode = 'US';
if(isset( $_POST['countryCode'])) {

$countryCode = $_POST['countryCode'];
//#############check if a valid country code is provided. might need a function ########

}













/*********************************************************************/	
//Method 2: Use a free text destination string
/******************************************************************** 
======================================================
destinationString 	string 	yes 	
------------------------------------------------------
A string containing at least a city name. You can also send city and state, city and country, city/state/country, etc.
This parameter is the best option for taking direct customer input.
Ambiguous entries will return an error containing a list of likely intended locations, including their destinationId (see below) whenever possible.
================================================================*/
if(isset( $_POST['destinationString'])) {

$destinationString = $_POST['destinationString'];
//#############check if a  String is provided. ########
 
}	










/*********************************************************************/
//Method 3: Use a destinationId
/******************************************************************** 
======================================================
destinationId 	string 	yes 	
------------------------------------------------------
The unique hex key value for a specific city, metropolitan area, or landmark.
Obtain this value via a geo function request, or from a multiple locations error returned by a destinationString availability request.
Values for landmarks such as buildings, major neighborhoods, train stations, etc. can be obtained via a geo function request for landmarks. All available destinationIds can also be obtained via select files in our database catalog.
================================================================*/







	
/*********************************************************************/
//Method 4: Use a list of hotelIds
/********************************************************************  
======================================================
hotelIdList 	comma-separated list of long 	yes 	
------------------------------------------------------
Check for availability against a fixed set of hotels.
Send the hotelId values for the hotels you want to search for as a comma-separated list as a value for this element.  When using long lists, be aware that response times may increase noticably vs. smaller lists across multiple requests. Use POST instead of GET when sending long lists via REST. 
======================================================	*/







/*********************************************************************/
//Method 5: Search within a geographical area
/******************************************************************** 
======================================================
latitude 			string 	yes 	
------------------------------------------------------
Latitude coordinate for the search's origin point, in DDD.MMmmm format.
======================================================
longitude 			string 	yes 	
------------------------------------------------------
Longitude coordinate for the search's origin point, in DDD.MMmmm format.
======================================================
searchRadius 		int 	no 	
------------------------------------------------------
Defines size of a square area to be searched within - not an actual radius of a circle. The value is still treated as a radius in the sense that it is half the width of the search area.
Factor in the added area and maximum distances this creates vs a circular search area when exposing this value directly.
Example
Minimum of 1 MI or 2 KM, maximum of 50 MI or 80 KM.
Defaults to 20 MI.
======================================================
searchRadiusUnit 	string 	no 	
------------------------------------------------------
Sets the unit of distance for the search radius. Send
MI or KM. Defaults to MI if empty or not included.
======================================================
sort 	string 	no 	
------------------------------------------------------
You must send a value of proximity if you want the results to be sorted by distance from the origin point. Otherwise the default sort order is applied to any hotels that fall within the search radius.
NO_SORT  
CITY_VALUE 
OVERALL_VALUE  
PROMO 	 
PRICE 	 
PRICE_REVERSE  
PRICE_AVERAGE 	 
QUALITY 	 
QUALITY_REVERSE  
ALPHA 	 
PROXIMITY 	 
POSTAL_CODE 	 
CONFIDENCE 	 
MARKETING_CONFIDENCE 	 
TRIP_ADVISOR 	  
**********************************************************************************/
	






/**********************************************************************************/
//Method 6: Search address string :: Requires city and countryCode parameters to be defined.	
/********************************************************************************/
	
	
	
/**********************************************************************************/	
//Method 7: Search	postalCode 	string 	 :: Requires city and countryCode parameters to be defined.
/*******************************************************************************/
	
	
	
	
	
/********************************************************************************/
//Method 8: Search	propertyName  string 	 :: Requires city and countryCode parameters to be defined.	
/*********************************************************************************/
	
 
 