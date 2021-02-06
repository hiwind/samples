document.addEventListener('keydown', contraCode);

// up, up, down, down, left, right, left, right, b, a, space!
contraKeys = "";
contraCode = '38;38;40;40;37;39;37;39;66;65;32;';
function contraCode(e) {
	contraKeys += e.keyCode + ';';
	if (contraKeys.indexOf(contraCode) > -1) {
		alert('30 Free Lives!');
		contraKeys = '';
	}
	else if (contraKeys.length >= contraCode.length) {
		if (contraKeys.indexOf('38') > -1) {
			if (contraKeys.indexOf('40') > -1) {
				if (contraKeys.indexOf('37') > -1) {
					alert('Game Over!');
				}
			}
		}
		contraKeys = '';
	}
}
