zoom = 1;
zoomMax = 1.5;
zoomMin = 1;
zoomIncrement = 0.05;
function zoomTo (zoomLevel) {
	boDY = document.body;
	if (boDY) {
		zoom = parseFloat(zoomLevel);
		if (zoom < zoomMin) {
			zoom = zoomMin;
		}
		else if (zoom > zoomMax) {
			zoom = zoomMax;
		}
		boDY.style.transform = 'scale(' + zoom + ')';
		boDY.style.transformOrigin = '0 0 0 0';
		boDY.style.width = (100/zoom) + '%';
		setCookie('zoom', zoom);
	}
	return false;
}
function zoomIn () {
	boDY = document.body;
	if (boDY) {
		zoom += zoomIncrement;
		if (zoom > zoomMax) {
			zoom = zoomMax;
		}
		boDY.style.transform = 'scale(' + zoom + ')';
		boDY.style.transformOrigin = '0 0 0 0';
		boDY.style.width = (100/zoom) + '%';
		setZoomCookie('zoom', zoom);
	}
	return false;
}
function zoomOut () {
	boDY = document.body;
	if (boDY) {
		zoom -= zoomIncrement;
		if (zoom < zoomMin) {
			zoom = zoomMin;
		}
		boDY.style.transform = 'scale(' + zoom + ')';
		boDY.style.transformOrigin = '0 0 0 0';
		boDY.style.width = (100/zoom) + '%';
		setZoomCookie('zoom', zoom);
	}
	return false;
}

function setZoomCookie (name, value) {
	document.cookie = name + '=' + value + '; expires=Thu, 31 Dec 2099 12:00:00 UTC; path=/';
}
function removeZoomCookie (name) {
	document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
}
function getZoomCookie(name) {
	value = name + "=";
	ca = document.cookie.split(';');
	for(var i=0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1, c.length);
		}
		if (c.indexOf(value) == 0) {
			return "" + c.substring(value.length, c.length);
		}
	}
	return "";
}
zoomSaved = getZoomCookie('zoom');
zoomSaved = getZoomCookie('zoom');
if (zoomSaved.length > 0) {
	zoomTo(zoomSaved);
}
else if (zoom != 1) {
	zoomTo(zoom);
}
