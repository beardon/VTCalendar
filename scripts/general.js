function isIE4() { return is_ie4; }
		
function new_window(freshurl) {
	SmallWin = window.open(freshurl, 'Calendar','scrollbars=yes,resizable=yes,toolbar=no,height=300,width=400');
	if (!isIE4())	{
		if (window.focus) { SmallWin.focus(); }
	}
	if (SmallWin.opener == null) SmallWin.opener = window;
	SmallWin.opener.name = "Main";
}