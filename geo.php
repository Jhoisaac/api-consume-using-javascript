<?php
if (!empty($_GET['location'])) {
    //Llamada para google.maps
    $maps_url = 'https://' .
        'maps.googleapis.com/' .
        'maps/api/geocode/json' .
        '?address=' . urlencode($_GET['location']);
    $maps_json = file_get_contents($maps_url);
    $maps_array = json_decode($maps_json, true);
    //Obtencion de variables a partir del json devuelto
    $lat = $maps_array['results'][0]['geometry']['location']['lat'];
    $lng = $maps_array['results'][0]['geometry']['location']['lng'];
    
    //Llamada para instagram
    $url = 'https://' .
        'api.instagram.com/v1/locations/search' .
        '?lat=' . $lat .
        '&lng=' . $lng .
        '&access_token=40396424.a81193e.dae9df6a96854d318919d784c2c499f1'; //replace "CLIENT-ID"
    $json = file_get_contents($url);
    $array = json_decode($json, true);
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form action="">
	<input type="text" name="location">
	<button type="submit">ir</button>
	<br/>

	<?php
	echo "<a href=".$url.">".$url."</a>";
	echo "</br>";
	echo "<a href=".$maps_url.">".$maps_url."</a>";

	if(!empty($array)){
		foreach ($array['data'] as $key=> $lugares) {
			echo '<p>'.$lugares['name'].'</p>';
			echo '<p>'.$lugares['latitude'].'</p>';
			echo '<p>'.$lugares['longitude'].'</p>';
			if($lugares['latitude']>0){echo "<p>polo norte</p>";}
			else{echo "<p>polo sur</p>";}
			echo "<p>----</p>";
		}
		
	}
	?>
</form>
</body>
</html>