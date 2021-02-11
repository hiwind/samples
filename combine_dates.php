<?
if (!function_exists('ereg')) {
	function ereg ($_a, $_b) {
		return preg_match("/" . $_a . "/", $_b);
	}
}
if (!function_exists('ereg_replace')) {
	function ereg_replace ($_a, $_b, $_c) {
		return preg_replace("/" . $_a . "/", $_b, $_c);
	}
}
if (!function_exists('combine_dates')) {
	function combine_dates ($_s, $_e, $_t = "M. j, Y") {
		$_s = str_replace("-", "", $_s);
		$_e = str_replace("-", "", $_e);
		$_a = stamp_to_date($_s, $_t);
		$_r = $_a;
		if (!is_empty($_e)) {
			if ($_s != $_e) {
				if (!strstr($_e, "zz")) {
					if (!strstr($_e, "99")) {
						$_b = stamp_to_date($_e, $_t);
						if (substr($_s, 0, 4) == substr($_e, 0, 4)) {
							if (substr($_s, 4, 2) == substr($_e, 4, 2)) {
								$_c = explode(" ", $_a, 3);
								$_d = explode(" ", $_b, 3);
								$_r = $_c[0] . " " . str_replace(",", "", $_c[1]) . "-" . $_d[1] . " " . $_c[2];
							}
							else {
								$_r = substr($_a, 0, strlen($_a)-6) . " - " . $_b;
							}
						}
						else {
							$_r .= " - " . $_b;
						}
					}
				}
			}
		}
		return $_r;
	}
}
if (!function_exists('build_lists')) {
	function build_lists ($_LISTS = array()) {
			$_LISTS["month"] = array(
				"1" => "Jan",
				"2" => "Feb",
				"3" => "Mar",
				"4" => "Apr",
				"5" => "May",
				"6" => "June",
				"7" => "July",
				"8" => "Aug",
				"9" => "Sep",
				"10" => "Oct",
				"11" => "Nov",
				"12" => "Dec"
			);

			$_LISTS["day"] = array(
				1 => 1,
				2 => 2,
				3 => 3,
				4 => 4,
				5 => 5,
				6 => 6,
				7 => 7,
				8 => 8,
				9 => 9,
				10 => 10,
				11 => 11,
				12 => 12,
				13 => 13,
				14 => 14,
				15 => 15,
				16 => 16,
				17 => 17,
				18 => 18,
				19 => 19,
				20 => 20,
				21 => 21,
				22 => 22,
				23 => 23,
				24 => 24,
				25 => 25,
				26 => 26,
				27 => 27,
				28 => 28,
				29 => 29,
				30 => 30,
				31 => 31
			);
			return $_LISTS;
	}
}
if (!function_exists('stamp_to_date')) {
	function stamp_to_date ($_date, $_alternate = "", $_date_alternate = "", $_at = " @ ") {
		global $_LISTS;
		if (!isset($_LISTS)) {
			$_LISTS = build_lists();
		}
		elseif (!is_array($_LISTS)) {
			$_LISTS = build_lists();
		}
		elseif (count($_LISTS) == 0) {
			$_LISTS = build_lists();
		}
		$_exact_time = "";
		if ($_date == "zzzz-zz-zz") {
			$_date = "";
			$_date_first = "";
			$_date_last = "";
			$_exact_time = "";
		}
		elseif (strlen($_date) == 8) {
			if (ereg("^([0-9][0-9][0-9][0-9])([0-9][0-9])([0-9][0-9])$", $_date, $_dates)) {
				$_date = $_dates[1] . "-" . $_dates[2] . "-". $_dates[3];
				$_date_last = "";
				$_date_first = $_date;
			}
			else {
				$_date_first = "";
				$_date_last = "";
			}
		}
		else {
			$_date_first = substr($_date, 0, 10);
			if (strlen($_date) > 10) {
				$_date_last = substr($_date, 11, strlen($_date) - 11);
			}
			else {
				$_date_last = "";
			}
		}
		if (ereg("^([0-9][0-9][0-9][0-9])-([0-9][0-9])$", $_date_first)) {
			$_date_first .= "-zz";
		}
		if (ereg("^(.*)-(.*)-(.*)$", $_date_first, $_dates)) {
			$_dates[2] = ereg_replace("^0", "", $_dates[2]);
			$_dates[3] = ereg_replace("^0", "", $_dates[3]);
			if ($_alternate != "") {
				if ($_dates[2] != "zz") {
					if ($_dates[3] == "zz") {
						$_exact_time = date($_alternate, mktime(0, 0, 0, $_dates[2], 1, $_dates[1]));
					}
					else {
						$_exact_time = date($_alternate, mktime(0, 0, 0, $_dates[2], $_dates[3], $_dates[1]));
					}
				}
			}
			else {
				if (!is_empty($_dates[2])) {
					if (isset($_LISTS["month"][$_dates[2]])) {
						$_exact_time .= substr($_LISTS["month"][$_dates[2]], 0, 3) . ".";
						if (!is_empty($_dates[3])) {
							if (isset($_LISTS["day"][$_dates[3]])) {
								if (!is_empty($_exact_time)) {
									$_exact_time .= " ";
								}
								$_exact_time .= $_LISTS["day"][$_dates[3]];
							}
						}
					}
				}
				if (!is_empty($_dates[1])) {
					if (($_dates[1] != "0000") && ($_dates[1] != "zzzz") && ($_dates[1] != "9999")) {
						if (!is_empty($_exact_time)) {
							$_exact_time .= ", ";
						}
						$_exact_time .= $_dates[1];
					}
				}
			}
			if ($_dates[2] == "6") {
				$_exact_time = str_replace("Jun.", "June", $_exact_time);
			}
			elseif ($_dates[2] == "7") {
				$_exact_time = str_replace("Jul.", "July", $_exact_time);
			}
			elseif ($_dates[2] == "5") {
				$_exact_time = str_replace("May.", "May", $_exact_time);
			}
			elseif ($_dates[2] == "9") {
				$_exact_time = str_replace("Sep.", "Sept.", $_exact_time);
			}
		}
		if (strlen($_date_last) == 8) {
			if ($_date_alternate != "") {
				$_exact_time .= $_at . date($_date_alternate, mktime(substr($_date_last, 0, 2), substr($_date_last, 3, 2), substr($_date_last, 6, 2), date("m"), date("d"), date("Y")));
			}
			else {
				$_exact_time .= $_at . $_date_last;
			}
		}
		return $_exact_time;
	}
}
?>