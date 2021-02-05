<?
if (!function_exists('ereg')) {
	function ereg ($_a, $_b) {
		return preg_match("/" . $_a . "/", $_b);
	}
}
if (!function_exists('ereg_replace')) {
	function ereg ($_a, $_b) {
		return preg_replace("/" . $_a . "/", $_b);
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
		else {
			return false;
		}
	}
}
if (!function_exists('set_vars')) {
	function set_vars () {
		global $_GET, $_POST, $HTTP_POST_VARS, $HTTP_GET_VARS;
		$_VARS = array();
		if (isset($_GET)) {
			if (is_array($_GET)) {
				if (count($_GET) > 0) {
					$_save = $_GET;
					while (list($_key, $_val) = each($_save)) {
						$_VARS[$_key] = $_val;
					}
				}
			}
		}
		elseif (isset($HTTP_GET_VARS)) {
			if (is_array($HTTP_GET_VARS)) {
				if (count($HTTP_GET_VARS) > 0) {
					$_save = $HTTP_GET_VARS;
					while (list($_key, $_val) = each($_save)) {
						$_VARS[$_key] = $_val;
					}
				}
			}
		}
		if (isset($_POST)) {
			if (is_array($_POST)) {
				if (count($_POST) > 0) {
					$_save = $_POST;
					while (list($_key, $_val) = each($_save)) {
						$_VARS[$_key] = $_val;
					}
				}
			}
		}
		elseif (isset($HTTP_POST_VARS)) {
			if (is_array($HTTP_POST_VARS)) {
				if (count($HTTP_POST_VARS) > 0) {
					$_save = $HTTP_POST_VARS;
					while (list($_key, $_val) = each($_save)) {
						$_VARS[$_key] = $_val;
					}
				}
			}
		}
		if (count($_VARS) > 0) {
			$_save = $_VARS;
			while (list($_key, $_val) = each($_save)) {
				if (!is_array($_val)) {
					if (is_empty($_val)) {
						$_VARS[$_key] = "";
					}
				}
			}
		}
		return $_VARS;
	}
}
if (!function_exists('set_var')) {
	function set_var ($_var) {
		global $_VARS;
		if (!isset($_VARS[$_var])) {
			$_VARS[$_var] = "";
			return false;
		}
		elseif (is_array($_VARS[$_var])) {
			return true;
		}
		elseif (is_empty($_VARS[$_var])) {
			$_VARS[$_var] = "";
			return false;
		}
		else {
			return true;
		}
	}
}
?>