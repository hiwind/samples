<?
$_a = array(
	"DOCUMENT_ROOT",
	"REQUEST_URI",
	"QUERY_STRING",
	"HTTP_HOST",
	"PHP_SELF",
	"REMOTE_USER",
	"REMOTE_ADDR",
	"HTTP_USER_AGENT"
);
while (list($_k, $_v) = each($_a)) {
	if (!isset($$_v)) {
		if (isset($_SERVER[$_v])) {
			$$_v = $_SERVER[$_v];
		}
		else {
			$$_v = getenv($_v);
		}
	}
}
unset($_a);
?>
