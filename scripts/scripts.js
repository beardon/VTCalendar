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