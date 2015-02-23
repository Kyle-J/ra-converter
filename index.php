<?php
include('libraries/converter/radec.class.php');
include('libraries/geolookup/geolookup.php');

$latitude        = isset($_GET['latitude']) ? $_GET['latitude'] : '50.718412000000000000';
$longitude       = isset($_GET['longitude']) ? $_GET['longitude'] : '-3.533899000000019400';
$right_ascension = isset($_GET['ra']) ? $_GET['ra'] : 0;
$declination     = isset($_GET['dec']) ? $_GET['dec'] : 0 ;
$time            = isset($_GET['time']) ? $_GET['time'] : 'now';

$time = strtotime($time);

$radec = new radec($latitude, $longitude);
$radec->setradec($right_ascension, $right_ascension);

$azimuth  = $radec->getAZ($time);
$altitude = $radec->getALT($time);

$city = Geolookup::lookupCityByCoordinates($latitude, $longitude);

header('Content-Type: application/json');
echo json_encode(array('latitude' => $latitude, 'longitude' => $longitude, 'city' => $city, 'ra' => $right_ascension, 'dec' => $declination, 'azimuth' => $azimuth, 'altitude' => $altitude));
?>

