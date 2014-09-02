function ChangeCalendar(Side,URL) {
	if (document.getElementById) {
		var objLeft = document.getElementById("LeftArrowButton");
		var objRight = document.getElementById("RightArrowButton");
		var objLeftDisabled = document.getElementById("LeftArrowButtonDisabled");
		var objRightDisabled = document.getElementById("RightArrowButtonDisabled");
		
		if (objLeft && objRight && objLeftDisabled && objRightDisabled) {
			if (Side == "Left") {
				objLeft.style.display = "none";
				objRight.style.display = "none";
				objLeftDisabled.style.display = "";
				objRightDisabled.style.display = "";
			}
			else {
				objLeft.style.display = "none";
				objRight.style.display = "none";
				objLeftDisabled.style.display = "";
				objRightDisabled.style.display = "";
			}
		}
	}
	
	var objDate = new Date();
	var returnValue = httpGet(URL, objDate.getTime(), ChangeCalendarProcessor);
	
	return !returnValue;
}

function ChangeCalendarProcessor(id, returnValue) {
	if (document.getElementById) {
		var objLittleCalendarContainer = document.getElementById("LittleCalendarContainer");
		
		if (objLittleCalendarContainer) {
			if (returnValue.indexOf("ERROR:") == 0) {
				if (document.getElementById) {
					var objLeftDisabled = document.getElementById("LeftArrowButtonDisabled");
					var objRightDisabled = document.getElementById("RightArrowButtonDisabled");
					
					if (objLeftDisabled && objRightDisabled) {
						objLeftDisabled.style.display = "none";
						objRightDisabled.style.display = "none";
					}
				}
			}
			else {
				objLittleCalendarContainer.innerHTML = returnValue;
			}
		}
		else {
			alert("Could not locate CalendarContainer after processing: " + objLittleCalendarContainer);
		}
	}
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