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
if (!function_exists('encode_email')) {
	function encode_email ($_R) {
		$_E = "";
		for ($_i=0; $_i<strlen($_R); $_i++) {
			$_E .= "&#" . ord(substr($_R, $_i, 1));
		}
		return $_E;
	}
}
if (!function_exists('trim_email')) {
	function trim_email ($_email) {
		return str_replace(" ", "", ereg_replace("[\t\r\n]", "", strtolower($_email)));
	}
}
if (!function_exists('validate_email')) {
	function validate_email ($_email) {
		$_email = trim_email($_email);
		if ((!strpos( $_email, "@" )) || (!strpos( $_email, "." ))) {
			return false;
		}
		elseif (strlen($_email) < 6) {
			return false;
		}
		else {
			$_parts = split("@", $_email, 2);
			$_user = $_parts[0];
			$_domain = $_parts[1];
			if (!ereg("\\.",$_domain)) {
				return false;
			}
			elseif (strlen($_domain) < 2) {
				return false;
			}
			elseif (ereg("^\\.",$_domain)) {
				return false;
			}
			elseif (ereg("\\.\\.",$_domain)) {
				return false;
			}
			else {
				if (strlen($_user) < 1) {
					return false;
				}
				elseif (ereg("\\,", $_user)) {
					return false;
				}
				else {
					$_parts = split("\\.", $_domain);
					if (count($_parts) < 2) {
						return false;
					}
					else {
						$_name_at = count($_parts) - 2;
						$_name = $_parts[$_name_at];
						$_ext_at = count($_parts) - 1;
						$_ext = $_parts[$_ext_at];
						$_first_name = substr($_name, 0, 1);
						if (strlen($_name) < 1) {
							return false;
						}
						if (strlen($_name) > 64) {
							return false;
						}
						elseif ((strlen($_ext) > 255) || (strlen($_ext) < 2)) {
							return false;
						}
						elseif (strspn($_name, "abcdefghijklmnopqrstuvwxyz0123456789-.") != strlen($_name)) {
							return false;
						}
						elseif (strspn($_first_name, "abcdefghijklmnopqrstuvwxyz0123456789") < 1) {
							return false;
						}
						elseif (strspn($_ext, "abcdefghijklmnopqrstuvwxyz0123456789") != strlen($_ext)) {
							return false;
						}
						else {
							return true;
						}
					}
				}
			}
		}
	}
}
?>