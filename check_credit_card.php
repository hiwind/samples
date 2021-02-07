<?
if (!function_exists('ereg_replace')) {
	function ereg_replace ($_a, $_b) {
		return preg_replace("/" . $_a . "/", $_b);
	}
}
if (!function_exists('check_digit')) {
	function check_digit ($_number) {
		$_sub_string = substr($_number,0,(strlen($_number)-1));
		$_string_total = 0;
		$_every_other = "Y";
		for ($_i=(strlen($_sub_string)-1); $_i>=0; $_i--) {
			if ($_every_other == "Y") {
				$_value = (substr($_sub_string,$_i,1)) *2;
				$_every_other = "N";
			}
			else {
				$_value = (substr($_sub_string,$_i,1));
				$_every_other = "Y";
			}
			$_string_total = $_string_total + (floor($_value/10)) + ($_value%10);
			if (($_string_total%10) == 0) {
				$_check_digit = 0;
			}
			else {
				$_check_digit = 10 - ($_string_total%10);
			}
		}
		if ($_check_digit == substr($_number,(strlen($_number)-1),1)) {
			return true;
		}
		else {
			return false;
		}
	}
}
if (!function_exists('check_card')) {
	function check_card ($_method, $_number) {
		$_number = ereg_replace("[^0-9]", "", $_number);
		if ($_method == "visa") {
			if (strlen($_number) != 16) {
				return false;
			}
			elseif (substr($_number, 0, 1) != "4") {
				return false;
			}
			elseif (!check_digit($_number)) {
				return false;
			}
			else {
				return true;
			}
		}
		elseif ($_method == "mastercard") {
			if (strlen($_number) != 16) {
				return false;
			}
			elseif ((substr($_number, 0, 1) != "5") && (substr($_number, 0, 1) != "2")) {
				return false;
			}
			elseif (!check_digit($_number)) {
				return false;
			}
			else {
				return true;
			}
		}
		elseif ($_method == "discover") {
			if (strlen($_number) != 16) {
				return false;
			}
			elseif (substr($_number, 0, 4) != "6011") {
				return false;
			}
			elseif (!check_digit($_number)) {
				return false;
			}
			else {
				return true;
			}
		}
		elseif ($_method == "amex") {
			if (strlen($_number) != 15) {
				return false;
			}
			elseif ((substr($_number, 0, 2) != "34") && (substr($_number, 0, 2) != "37")) {
				return false;
			}
			elseif (!check_digit($_number)) {
				return false;
			}
			else {
				return true;
			}
		}
		else {
			return false;
		}
	}
}
?>
