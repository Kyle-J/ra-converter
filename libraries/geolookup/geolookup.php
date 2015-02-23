<?php
/**
 * Class Geolookup
 */
class Geolookup
{
    /**
     * Look up city by lat/long
     *
     * @param $latitude
     * @param $longitude
     * @return mixed
     */
    public static function lookupCityByCoordinates($latitude, $longitude)
    {
        $url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%f,%f&sensor=true',$latitude, $longitude);

        $data = json_decode(self::getData($url));

        return $data->results[0]->address_components[2]->long_name;
    }

    /**
     * @param $url
     * @return mixed
     */
    public static function getData($url)
    {
        $ch = curl_init();
        $timeout = 5;

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }
}

