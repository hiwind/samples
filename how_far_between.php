<?
function round_number ($_number, $_rounded=-1) {
	if ($_rounded > 0) {
		$_number = floatval(number_format($_number, $_rounded, ".", ""));
	}
	return $_number;
}
function how_far_between ($_latOrigin, $_lonOrigin, $_latDestination, $_lonDestination, $_rounded=10) {
	$_feet_in_a_mile = 5280;
	$_kilometers_in_a_mile = 1.609344;
	$_minutes_in_a_degree = 60;
	$_miles_in_a_nautical_mile = 1.1515;
	$_feet_in_a_yard = 3;
	$_inches_in_a_foot = 12;
	$_meters_in_a_kilometer = 1000;

	$_miles =
		(sin(deg2rad($_latOrigin)) * sin(deg2rad($_latDestination))) +
		(cos(deg2rad($_latOrigin)) * cos(deg2rad($_latDestination)) *
		(cos(deg2rad($_lonOrigin - $_lonDestination)))
	);
	$_miles = rad2deg(acos($_miles)) * $_minutes_in_a_degree * $_miles_in_a_nautical_mile;

	return array(
		"miles" => round_number($_miles, $_rounded),
		"yards" => round_number($_miles * ($_feet_in_a_mile/$_feet_in_a_yard), $_rounded),
		"feet" => round_number($_miles * $_feet_in_a_mile, $_rounded),
		"inches" => round_number($_miles * ($_feet_in_a_mile*$_inches_in_a_foot), $_rounded),
		"kilometers" => round_number($_miles * $_kilometers_in_a_mile, $_rounded),
		"meters" => round_number($_miles * $_kilometers_in_a_mile * $_meters_in_a_kilometer, $_rounded),
		"centimeters" => round_number($_miles * $_kilometers_in_a_mile * $_meters_in_a_kilometer * $_meters_in_a_kilometer, $_rounded)
	);
}

/** EXAMPLE **/
$_origin = array(
	"lat" => 44.5133,
	"lon" => -88.0133
); // green bay, wi

$_destination = array(
	"lat" => 43.0389,
	"lon" => -87.9065
); // milwaukee, wi

print_r(how_far_between($_origin["lat"], $_origin["lon"], $_destination["lat"], $_destination["lon"]));
?>