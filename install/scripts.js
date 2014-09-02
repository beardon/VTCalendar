function ToggleDependant(variableid) {
	if (document.getElementById) {
		objCheckbox = document.getElementById("CheckBox_" + variableid);
		objRow = document.getElementById("Dependants_" + variableid);
		if (objCheckbox && objRow) {
			if (objCheckbox.checked) {
				objRow.style.display = "";
			}
			else {
				objRow.style.display = "none";
			}
		}
	}
}

function AddCheckDSNLink() {
	if (document.getElementById) {
		var objDBStringExtra = document.getElementById("DataFieldInputExtra_DATABASE");
		
		if (objDBStringExtra) {
			objDBStringExtra.innerHTML = '<a href="#" onclick="CheckDSN(); return false;">[Check Connection]</a>';
		}
	}
}

function CheckDSN() {
	var objDBStringInput = document.getElementById("Input_DATABASE");
	if (objDBStringInput) {
		return httpGet("checkdsn.php?str=" + escape(objDBStringInput.value), 1, CheckDSNHandler);
	}
	else {
		return false;
	}
}

function CheckDSNHandler(sessionID, returnValue) {
	alert(returnValue);
}

function SetSponsorDefault(typeNum) {
	var type = "";
	if (typeNum == 1) type = "name";
	else if (typeNum == 2) type = "url";
	
	if (document.getElementById) {
		var objSelectedSponsorID = document.getElementById("selectedsponsorid");
		var objTextbox = document.getElementById("defaultsponsor" + type + "text");
		var objButton = document.getElementById("defaultsponsor" + type + "button");
		
		if (objSelectedSponsorID && objTextbox && objButton) {
			objTextbox.disabled = true;
			objButton.disabled = true;
		}
		if (objSelectedSponsorID) {
			var sponsorID = 0;
			if (objSelectedSponsorID.value && !objSelectedSponsorID.value=="") {
				sponsorID = objSelectedSponsorID.value;
			}
			else if (objSelectedSponsorID.selectedIndex && objSelectedSponsorID[objSelectedSponsorID.selectedIndex].value) {
				sponsorID = objSelectedSponsorID[objSelectedSponsorID.selectedIndex].value;
			}

			var returnValue = httpGet("getsponsorinfo.php?sponsorid=" + sponsorID + "&type=" + type, typeNum, SetSponsorDefaultProcessor);
			return !returnValue;
		}
	}
	return false;
}

function SetSponsorDefaultProcessor(id, returnValue) {
	var type = "";
	if (id == 1) type = "name";	
	else if (id == 2) type = "url";
	
	if (document.getElementById) {
		var objTextbox = document.getElementById("defaultsponsor" + type + "text");
		var objButton = document.getElementById("defaultsponsor" + type + "button");
		
		if (objTextbox && objButton) {
			if (returnValue.indexOf("ERROR:") == 0) {
				// Do nothing
			}
			else if (returnValue.indexOf("INVALID_SPONSOR_ID:") == 0) {
				// Do nothing
			}
			else if (returnValue.indexOf("SPONSOR_ID_NOTFOUND:") == 0) {
				// Do nothing
			}
			else {
				objTextbox.value = returnValue;
			}
			
			objTextbox.disabled = false;
			objButton.disabled = false;
		}
		else {
			//alert("Could not locate CalendarContainer after processing: " + objLittleCalendarContainer);
		}
	}
}