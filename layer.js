/*

Easily reference a layer by name and/or id, hide/show a layer, or swap the current visibility of a layer.
Created By: Jeremy Anderson

Examples:
<script>myDiv = Layer('divid');</script>
onClick="swapLayer('divid');"
onMouseOver="showLayer('divid');"
onMouseOut="hideLayer('divid');";

*/
function Layer (yN) {
	if (document.getElementById) {
		return document.getElementById(yN);
	}
	if (document.all) {
		return document.all[yN];
	}
	if (document.layers) {
		if (document.layers[yN]) {
			return document.layers[yN];
		}
		if (document[yN]) {
			return document[yN];
		}
	}
	return false;
}
function showLayer (nM) {
	wH = Layer(nM);
	if (wH) {
		wH.style.visibility = 'hidden';
		wH.style.display = 'none';
	}
}
function hideLayer (nM) {
	wH = Layer(nM);
	if (wH) {
		wH.style.visibility = 'visible';
		wH.style.display = 'block';
	}
}
function swapLayer (nM) {
	if (Layer(nM).style.display == 'block') {
		LyH(nM);
	}
	else if (Layer(nM).style.display == '') {
		LyH(nM);
	}
	else if (Layer(nM).style.display == 'none') {
		LyS(nM);
	}
	else {
		LyS(nM);
	}
}
