<?
if (!function_exists('make_img_responsive')) {
	function make_img_responsive ($_s) {
		if (stristr("<img", $_s)) {
			preg_match_all('/(<img[^>]*>)/i', $_s, $_mt);
			if (count($_mt[1]) > 0) {
				while (list($_kt, $_vt) = each($_mt[1])) {
					if (strstr($_vt, " style=\"")) {
						$_vtn = $_vt;
						list($_null, $_vs) = explode(" style=\"", $_vt, 2);
						list($_vs, $_null) = explode("\"", $_vs, 2);
						$_vsn = str_replace("width:", "max-width:", $_vs);
						$_vsn = str_replace("max-max-width:", "null:", $_vsn);
						$_vsn = str_replace("height:", "null:", $_vsn);
						$_vtn = str_replace($_vs, $_vsn, $_vtn);
						$_vtn = str_ireplace(" width=", " null=", $_vtn);
						$_vtn = str_ireplace(" height=", " null=", $_vtn);
						if (!strstr($_vtn, "width=\"100%\"")) {
							$_vtn = str_ireplace("<img", "<img width=\"100%\"", $_vtn);
						}
						$_vtn = str_ireplace(" null=\"100%\"", "", $_vtn);
						$_s = str_replace($_vt, $_vtn, $_s);
					}
				}
			}
		}
		return $_s;
	}
}
?>