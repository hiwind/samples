function var_export(vA, vB) {
	if (isJSON(vA)) {
		for (var vK in vA) {
			if (isJSON(vA[vK])) { var_export(vA[vK], vB + '[' + vK + ']'); }
			else { console.log('(' + typeof vA[vK] + ') ' + vB + '[' + vK + '] = ' + vA[vK]); }
		}
	}
	else { console.log('(' + typeof vA + ') ' + vB + ' = ' + vA); }
}
function isJSON(jO) {
	return ((typeof jO === 'object') || (jO instanceof Array));
}