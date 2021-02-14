zoom = 1;
zoomMax = 1.5;
zoomMin = 1;
zoomIncrement = 0.05;
zoomDefault = zoom;

/*
// add keydown tracking into page to capture  shift- and shift+ to zoom
<script>
	document.onkeydown = function(evt) {
		evt = evt || window.event;
		if (event.shiftKey) {
			if ("key" in evt) {
				if ((evt.key === "_") || (evt.key === "-")) {
					zoomOut();
				}
				else if ((evt.key === "+") || (evt.key === "=")) {
					zoomIn();
				}
			}
			else {
				if (evt.keyCode == 187) {
					zoomIn();
				}
				else if (evt.keyCode == 189) {
					zoomOut();
				}
			}
		}
	};
</script>
*/

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
		boDY.style.transformOrigin = '0 0';
		boDY.style.width = (100/zoom) + '%';
		if (zoom == zoomDefault) {
			removeZoomCookie('zoom');
		}
		else {
			setZoomCookie('zoom', zoom);
		}
	}
	return false;
}
function zoomIn () {
	zoom += zoomIncrement;
	return zoomTo(zoom);
}
function zoomOut () {
	zoom -= zoomIncrement;
	return zoomTo(zoom);
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
if (zoomSaved.length > 0) {
	zoomTo(zoomSaved);
}
else if (zoom != 1) {
	zoomTo(zoom);
}
