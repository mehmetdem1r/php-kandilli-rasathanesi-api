<?php
$url = 'http://www.koeri.boun.edu.tr/scripts/lasteq.asp';
 
$data = file_get_contents($url);
 
$data = explode('<pre>',$data);
 
$data = explode('</pre>',$data[1]);
$data = $data[0];
$data = trim($data);
 
$data = explode(PHP_EOL,$data);
 
$earthquakes = [];
 
unset($data[0]);
unset($data[1]);
unset($data[2]);
unset($data[3]);
unset($data[4]);
unset($data[5]);
foreach($data AS $cont){
    $date = substr($cont,0,19);
    $latLong = substr($cont,21,17);
    $latLong = explode(' ',$latLong);
 
    $lat = trim($latLong[0]);
    $lon = trim($latLong[3]);
 
    $depth = substr($cont,44,8);
    $depth = trim($depth);
 
    $magnitude = substr($cont,55,13);
    $magnitude = explode(' ',$magnitude);
 
    $region = substr($cont,68,50);
    $region = trim($region);
 
    $earthquakes[] = [
        'date'         => $date,
        'lat'         => $lat,
        'lon'         => $lon,
        'depth'     => $depth,
        'magnitude' => [
            'MD' => $magnitude[0],
            'ML' => $magnitude[1],
            'Mw' => $magnitude[2]
        ],
        'region'     => $region
         
    ];
}
 
var_dump($earthquakes);
 
die();
?>