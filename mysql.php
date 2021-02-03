<?
if (!function_exists('db_error')) {
	function db_error ($_err, $_query = "", $_errors_to=array()) {
		global $_SERVER;
		$_t = array();
		if (isset($_errors_to)) {
			if (!is_array($_errors_to)) {
				$_u = explode("|", $_errors_to);
			}
			else {
				$_u = $_errors_to;
			}
			while (list($_k, $_v) = each($_u)) {
				if (strstr($_v, "@")) {
					$_t[] = $_v;
				}
			}
		}
		if (count($_t) == 0) {
			$_t[] = "errors@domain.com";
		}
		unset($_SERVER["PHP_AUTH_PW"]);
		while (list($_k, $_v) = each($_t)) {
			mail($_v, "MySQL Error", $_err . "\n\n" . $_query . "\n\n" . getenv('HTTP_HOST') . getenv('REQUEST_URI') . "\n\n" . getenv('REMOTE_ADDR'). "\n\n" . var_export($_SERVER, true));
		}
?><html><head><title>Error</title></head><body bgcolor="#FFFFFF" text="#000000"><center><blockquote><blockquote><br><br><font face="verdana, geneva, helvetica" size="1"><font color="#ff0000">An Error Occurred: </font> <? print $_err; ?><br><br><? print $_query; ?></font></blockquote></blockquote></center></body></html><?
		exit;
	}
}
if (!function_exists('db_connect')) {
	function db_connect($_dbname, $_dbserver, $_dbuser, $_dbpass, $_loops = 5) {
		$_i = 0;
		if (($_retval = mysql_pconnect($_dbserver, $_dbuser, $_dbpass)) == FALSE) {
			while($_i < $_loops) {
				if (($_retval = mysql_pconnect($_dbserver, $_dbuser, $_dbpass)) == FALSE) {
					$_i++;
				}
				else {
					break;
				}
			}
		}
		if ($_i >= $_loops) {
			db_error("Failed connection to " . $_dbserver);
		}
		if (mysql_select_db($_dbname, $_retval) == 0) {
			$_i = 0;
			while($_i < $_loops) {
				if (mysql_select_db($_dbname, $_retval) == 0)	{
					$_i++;
				}
				else {
					break;
				}
			}
			if ($_i >= $_loops) {
				db_error("Failed connection to " . $_dbserver);
			}
		}
		return($_retval);
	}
}
if (!function_exists('db_query')) {
	function db_query ($_dbid, $_query, $_skip_log = false) {
		if(!($_result = mysql_query($_query, $_dbid))) {
			db_error(mysql_errno($_dbid) . ": " . mysql_error($_dbid), $_query);
		}
		return $_result;
	}
}
if (!function_exists('db_rowfields')) {
	function db_rowfields ($_result, $_return = false) {
		if ((mysql_num_fields($_result) > 0) && (mysql_num_rows($_result) > 0)) {
			if ($_return) {
				return mysql_num_rows($_result);
			}
			else {
				return true;
			}
		}
		if ($_return) {
			return 0;
		}
		else {
			return false;
		}
	}
}
if (!function_exists('db_shortuid')) {
	function db_shortuid ($_dbid, $_table, $_length = 6, $_field = "uid") {
		$_l = "abcdefghjkmnpqrtuvwxyz";
		$_l .= "2346789";
		$_match = true;
		srand((double)microtime()*123456);
		while($_match) {
			$_token = "";
			for ($_i=0; $_i<$_length; $_i++) {
				$_token .= substr($_l, rand(0, strlen($_l)-1), 1);
			}
			if (strlen($_table) > 0) {
				if (strlen($_field) > 0) {
					$_result = db_query($_dbid, "select " . $_field . " from " . $_table . " where " . $_field . "='" . addslashes($_token) . "' limit 0,1;");
					if (!db_rowfields($_result)) {
						$_match = false;
						break;
					}
				}
				else {
					$_match = false;
				}
			}
			else {
				$_match = false;
			}
		}
		return $_token;
	}
}
if (!function_exists('db_uid')) {
	function db_uid ($_dbid, $_table, $_length = 12, $_field = "uid", $_prefix="") {
		$_match = true;
		srand((double)microtime()*123456);
		while($_match) {
			$_token = substr(md5(uniqid(rand())), 0, $_length);
			if (strlen($_table) > 0) {
				if (strlen($_field) > 0) {
					$_result = db_query($_dbid, "select " . $_field . " from " . $_table . " where " . $_field . "='" . addslashes($_token) . "' limit 0,1;");
					if (!db_rowfields($_result)) {
						$_match = false;
						break;
					}
				}
				else {
					$_match = false;
				}
			}
			else {
				$_match = false;
			}
		}
		return $_token;
	}
}
if (!function_exists('is_empty')) {
	function is_empty ($_string) {
		if (is_array($_string)) {
			if (count($_string) > 0) {
				return false;
			}
			else {
				return true;
			}
		}
		elseif (strlen($_string) == 0) {
			return true;
		}
		elseif (strlen(ereg_replace("[\r\n]", "", str_replace(" ", "", $_string))) < 1) {
			return true;
		}
		elseif ($_string == "<br>") {
			return true;
		}
		else {
			return false;
		}
	}
}
?>