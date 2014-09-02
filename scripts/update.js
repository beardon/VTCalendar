function setRadioButton(radioID, state) {
	if (document.getElementById) {
		if (document.getElementById(radioID)) {
			document.getElementById(radioID).checked = true;
		}
	}
}