zoom = 1;
zoomMax = 1.5;
zoomMin = 1;
zoomIncrement = 0.05;

function zoomTo (zoomLevel) {
	boDY = document.body;
	if (boDY) {
		zoom = zoomLevel;
		if (zoom < zoomMin) {
			zoom = zoomMin;
		}
		else if (zoom > zoomMax) {
			zoom = zoomMax;
		}
		boDY.style.transform = 'scale(' + zoom + ')';
		boDY.style.transformOrigin = '0 0 0 0';
		boDY.style.width = (100/zoom) + '%';
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
	}
	return false;
}

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