<?
function twitter_links ($_description, $_user="") {
	if (strlen($_user) > 0) {
		$_description = ereg_replace("^" . $_user. ": ", "", $_description);
		$_description = ereg_replace("^" . strtolower($_user) . ": ", "", $_description);
	}
	$_description = preg_replace( '/(http|ftp)+(s)?:(\/\/)((\w|\.)+)(\/)?(\S+)?/i', '<a href="\0" target=\"_blank\">\0</a>', $_description);
	if (strstr($_description, "#")) {
		$_description = preg_replace('/(^|\s)#(\w*[a-zA-Z_]+\w*)/', '\1<a href="https://twitter.com/search/?q=%23\2" target=\"_blank\">#\2</a>', $_description);
	}
	if (strstr($_description, "@")) {
		$_description = preg_replace('/(^|\s)@(\w*[a-zA-Z_]+\w*)/', '\1<a href="https://twitter.com/\2" target=\"_blank\">@\2</a>', $_description);
	}
	return $_description;
}
?>