var CKEditorSourceID = "ckeditor5";

// <textarea name="ckeditor5" id="ckeditor5"></textarea>
// <input type="button" onClick="this.blur(); return showSource();" value="Source Toggle">

function Layer (nM) {
	if (document.getElementById) {
		return document.getElementById(nM);
	}
	if (document.all) {
		return document.all[nM];
	}
	if (document.layers) {
		if (document.layers[nM]) {
			return document.layers[nM];
		}
		if (document[nM]) {
			return document[nM];
		}
	}
	return false;
}
function hideLayer (nM) {
	wH = Layer(nM);
	if (wH) {
		wH.style.visibility = 'hidden';
		wH.style.display = 'none';
	}
}
function showLayer (nM) {
	wH = Layer(nM);
	if (wH) {
		wH.style.visibility = 'visible';
		wH.style.display = 'block';
	}
}
function LayerValue (nM) {
	if (Layer(nM)) {
		return Layer(nM).value;
	}
	else {
		return "";
	}
}
function setLayerValue (nM, vL) {
	if (Layer(nM)) {
		Layer(nM).value = vL;
	}
}
function showSource() {
	if (editor != null) {
		window.editor = editor;
	}
	if (window.editor != null) {
		x = document.getElementsByClassName("ck-editor");
		if (layerShown(CKEditorSourceID)) {
			for (i=0; i<x.length; i++) {
				x[i].style.display='block';
				x[i].style.visibility='visible';
			}
			window.editor.setData(LayerValue(CKEditorSourceID));
			setLayerValue(CKEditorSourceID, '');
			hideLayer(CKEditorSourceID);
			CKEditorSource = false;
		}
		else {
			for (i=0; i<x.length; i++) {
				x[i].style.display='none';
				x[i].style.visibility='hidden';
			}
			setLayerValue(CKEditorSourceID, window.editor.getData());
			showLayer(CKEditorSourceID);
			CKEditorSource = true;
		}
	}
	return false;
}