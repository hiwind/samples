<?
if (!function_exists('write_file')) {
	function write_file ($_file_path, $_string = "", $_append = false, $_delete = false) {
		if ($_append) {
			$_file = fopen($_file_path, "a+");
		}
		else {
			if (file_exists($_file_path)) {
				if ($_delete) {
					unlink($_file_path);
				}
				else {
					rename($_file_path, $_file_path . ".old");
				}
			}
			$_file = fopen($_file_path, "w+");
		}
		fwrite($_file, $_string, strlen($_string));
		fclose($_file);
	}
}
if (!function_exists('write_file_check')) {
	function write_file_check ($_file_path, $_string = "") {
		$_do_write = true;
		if (file_exists($_file_path)) {
			$_r = implode("", file($_file_path));
			if (strlen($_r) == strlen($_string)) {
				if (substr($_r, 1, 50) == substr($_string, 1, 50)) {
					if ($_r == $_string) {
						$_do_write = false;
					}
				}
			}
		}
		if ($_do_write) {
			if (file_exists($_file_path)) {
				rename($_file_path, $_file_path . ".old");
			}
			$_file = fopen($_file_path, "w+");
			fwrite($_file, $_string, strlen($_string));
			fclose($_file);
			return true;
		}
		else {
			return false;
		}
	}
}
?>
