function modNavClick(mod) {
	var elem;

	elem = document.getElementById('moduleId'+mod);
	if (elem) {
		if (elem.className == 'pluginMenu') {
			elem.className = 'pluginMenuActive';
		} else {
			elem.className = 'pluginMenu';
		}
	}
}
