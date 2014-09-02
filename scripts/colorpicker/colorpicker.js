document.ColorChangeHandler = null;
document.PickerOpenedHandler = null;
document.PickerClosedHandler = null;

var ie = false;
if (document.all) { ie = true; nocolor = ''; }
function getObj(id) {
	if (ie) { return document.all[id]; } 
	else {	return document.getElementById(id);	}
}

function PickerIsOpen() {
	var picker = getObj("ColorPicker");
	if (picker) {
		return picker.style.display != 'none';
	}
	return false;
}

function PickColor(id, hex) {
	curId = id;
	var thelink = getObj(id);
	var color = "";
	var picker = getObj("ColorPicker");
	if (picker) {
		if (hex) {
			color = "?color=" + hex;
		}
		picker.style.top = getAbsoluteOffsetTop(thelink) + 20;
		picker.style.left = getAbsoluteOffsetLeft(thelink);     
		picker.style.display = 'block';
		picker.src="scripts/colorpicker/index.php" + color;
		if (document.PickerOpenedHandler) document.PickerOpenedHandler();
	}
}

function SetColor(hex) {
	if (document.ColorChangeHandler) {
		document.ColorChangeHandler(hex);
	}
	var picker = getObj("ColorPicker");
	picker.style.display = 'none';
	//picker.src="scripts/colorpicker/blank.html";
}

function ClosePicker() {
	var picker = getObj("ColorPicker");
	picker.style.display = 'none';
	//picker.src="scripts/colorpicker/blank.html";
	if (document.PickerClosedHandler) document.PickerClosedHandler();
}

function getAbsoluteOffsetTop(obj) {
	var top = obj.offsetTop;
	var parent = obj.offsetParent;
	while (parent != document.body) {
		top += parent.offsetTop;
		parent = parent.offsetParent;
	}
	return top;
}

function getAbsoluteOffsetLeft(obj) {
	var left = obj.offsetLeft;
	var parent = obj.offsetParent;
	while (parent != document.body) {
		left += parent.offsetLeft;
		parent = parent.offsetParent;
	}
	return left;
}