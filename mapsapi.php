<?php
#    $content = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&key=AIzaSyCILcMm9IgtncqBw9GBWgvLrJtBaVH77yY");
    $url = "http://maps.googleapis.com/maps/api/geocode/json?latlng=40.714224,-73.961452&sensor=false&key=AIzaSyCILcMm9IgtncqBw9GBWgvLrJtBaVH77yY";

    echo $json = @file_get_contents($url);

    $data=json_decode($json);

    $status = $data->status;

    if($status=="OK"){
        $formatted_address = $data->results[0]->formatted_address;
    }
    
    echo $formatted_address;
    
