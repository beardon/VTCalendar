var objHttpSessions = new Array();

function makeHttp() {
	// branch for native XMLHttpRequest object
	if (window.XMLHttpRequest) {
		try {
			return new XMLHttpRequest();
		}
		catch (e) {
			return null;
		}
	}
	
	// branch for IE/Windows ActiveX version
	else if (window.ActiveXObject) {
		try {
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e) {
			try {
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e) {
				return null;
			}
		}
	}
	
	// Otherwise, the XMLHttpRequest object could not be created.
	else {
		return null;
	}
}

function httpGet(url, sessionID, externalHandler)
{
	objHttpSessions[sessionID] = new Array(makeHttp(), externalHandler);
	
	// If the xmlHttpRequest object was created...
	if (objHttpSessions[sessionID][0]) {
		// Set the processing function.
		objHttpSessions[sessionID][0].onreadystatechange = new Function("processSession(" + sessionID + ");");
		
		// Set up the connection.
		objHttpSessions[sessionID][0].open("GET", url, true);
		
		// branch for native XMLHttpRequest object
		if (window.XMLHttpRequest) {
			objHttpSessions[sessionID][0].send(null);
		}
		// branch for IE/Windows ActiveX version
		else if (window.ActiveXObject) {
			objHttpSessions[sessionID][0].send();
		}
		
		return true;
	}
	
	// If the xmlHttpRequest object was NOT created...
	else {
		return false;
	}
}

function processSession(sessionID) {
	// If the processing has completed...
	if (objHttpSessions[sessionID][0].readyState == 4) {
		if (objHttpSessions[sessionID][0].status == 200) {
			// Execute the processing function and pass the response text.
			objHttpSessions[sessionID][1](sessionID, objHttpSessions[sessionID][0].responseText);
		}
		else {
			// Execute the processing function and pass the response text as an error.
			objHttpSessions[sessionID][1](sessionID, "ERROR:" + objHttpSessions[sessionID][0].status);
		}
	}
}