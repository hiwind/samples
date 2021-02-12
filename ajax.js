debug = false;

pX.prototype.rQ = undefined;
function pX () {
}
pX.prototype.load = function (gP, gQ) {
	this.rQ = false;
	if (window.XMLHttpRequest) {
		this.rQ = new XMLHttpRequest();
	}
	else if (window.ActiveXObject) {
		try {
			this.rQ = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			try {
				this.rQ = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e) {
			}
		}
	}
	if (this.rQ) {
		var _this = this;
		this.rQ.onreadystatechange = function () {_this._onData();};
		if (gQ.length > 0) {
			this.rQ.open('POST', gP, true);
		}
		else {
			this.rQ.open('GET', gP, true);
		}
		this.rQ.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		this.rQ.setRequestHeader("Content-length", gQ.length);
		this.rQ.setRequestHeader("Connection", "close");
		this.rQ.send(gQ);
	}
}
pX.prototype._onData = function() {
	if (this.rQ.readyState == 4) {
		if (this.rQ.status == 200) {
			if (debug) {
				alert(this.rQ.responseText);
			}
			this.aN = parseInt(this.rQ.responseText.substr(0, this.rQ.responseText.indexOf('\n')));
			this.aL = this.rQ.responseText.split('\n', this.aN);
			if (this.rQ.responseText.substr(0, 9) == "response=") {
				this.aC = this.rQ.responseText.split('\n', 2);
				this.aT = this.aC[0].split('response=', 2);
				this.aD = fL(this.aT[1]);
				if (this.aD) {
					this.aD.innerHTML = this.rQ.responseText.substr(this.rQ.responseText.indexOf('\n')+1);
				}
			}
			else {
				for (this.aJ=1; this.aJ<this.aL.length; this.aJ++) {
					this.aT = this.aL[this.aJ];
					if (this.aT.indexOf('|') > 0) {
						this.aC = this.aT.split('|', 3);
						if (this.aC[0] == 'function') {
							setTimeout(this.aC[2], 1);
						}
						else {
							this.aD = fL(this.aC[0]);
							if (this.aD) {
								if (this.aC[1] == 'v') {
									this.aD.value = this.aC[2];
								}
								else if (this.aC[1] == 'i') {
									this.aD.innerHTML = this.aC[2];
								}
								else if (this.aC[1] == 't') {
									this.aD.innerText = this.aC[2];
								}
								else if (this.aC[1] == 'c') {
									this.aD.style.color = '#' + this.aC[2];
								}
								else if (this.aC[1] == 'ht') {
									this.aD.style.height = this.aC[2];
								}
								else if (this.aC[1] == 'wt') {
									this.aD.style.width = this.aC[2];
								}
								else if (this.aC[1] == 's') {
									if (this.aC[2] == '1') {
										this.aD.style.visibility = 'visible';
										this.aD.style.display = 'block';
									}
									else {
										this.aD.style.visibility = 'hidden';
										this.aD.style.display = 'none';
									}
								}
								else {
									this.aD.innerHTML = this.aC[2];
								}
							}
						}
					}
				}
			}
		}
	}
}
function fL (nM) {
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
function fP (fA, fB) {
	var gN = new pX();
	gN.load(fA, fB);
}
