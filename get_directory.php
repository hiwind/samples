<?
if (!function_exists('ereg')) {
	function ereg ($_a, $_b) {
		return preg_match("/" . $_a . "/", $_b);
	}
}
if (!function_exists('get_directory')) {
	function get_directory ($_directory, $_include_link = false) {
		$_dir = opendir($_directory);
		$_contents = array();
		$_files = array();
		while (($_file = readdir($_dir)) != false) {
			$_files[] = $_file;
		}
		asort($_files);
		while(list($_key, $_file) = each($_files)) {
			if ((!ereg("^\\.", $_file)) && (!ereg("\\.old$", $_file)) && (!ereg("\\.old\\.", $_file))) {
				if (is_readable($_directory . $_file)) {
					if (!is_link($_directory . $_file)) {
						if (is_dir($_directory . $_file)) {
							$_contents[] = array($_file, "D");
						}
						elseif (is_file($_directory . $_file)) {
							$_contents[] = array($_file, "F", determine_size($_directory . $_file));
						}
					}
					elseif ($_include_link) {
						if (is_dir($_directory . $_file)) {
							$_contents[] = array($_file, "DL");
						}
						elseif (is_file($_directory . $_file)) {
							$_contents[] = array($_file, "FL", determine_size($_directory . $_file));
						}
					}
				}
			}
		}
		closedir($_dir);
		return $_contents;
	}
}
if (!function_exists('determine_size')) {
	function determine_size ($_file) {
		$_file_size = filesize($_file);
		if ($_file_size >= 1073741824) {
			$_file_size = round($_file_size / 1073741824 * 100) / 100 . "GB";
		}
		elseif ($_file_size >= 1048576) {
			$_file_size = round($_file_size / 1048576 * 100) / 100 . "MB";
		}
		elseif ($_file_size >= 1024) {
			$_file_size = round($_file_size / 1024 * 100) / 100 . "K";
		}
		else {
			$_file_size = $_file_size . " Bytes";
		}
		if ($_file_size < 1) {
			$_file_size = 0 . " Bytes";
		}
		return $_file_size;
	}
}
?>