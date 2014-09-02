/**
 * Checks the installed version of VTCalendar against the latest release version.
 * 
 * Returns "OLDER" if the installed version is older than the latest release version;
 *         "EQUAL" if the the installed version matches the latest release version;
 *         "NEWER" if the installed version is newer than the latest release version (possibly beta);
 *         or "ERROR" if something went wrong.
 */
function CheckVTCalendarVersion(InstalledVersion, LatestVersion) {
	if (InstalledVersion && LatestVersion
		&& typeof InstalledVersion == 'string' && typeof LatestVersion == 'string'
		&& VersionIsNumeric(InstalledVersion) && VersionIsNumeric(LatestVersion)) {
		
		// If the strings are equal, then the versions must be equal as well.
		if (InstalledVersion == LatestVersion) {
			return "EQUAL";
		}
		else {
			// Split the versions at the periods.
			var splitInstalledVersion = InstalledVersion.split(".");
			var splitLatestVersion = LatestVersion.split(".");
			
			// Check each part of the versions
			for (i = 0; i < splitInstalledVersion.length; i++) {
				if (splitLatestVersion.length <= i) {
					return "NEWER";
				}
				
				var installedNum = parseInt(splitInstalledVersion[i]);
				var latestNum = parseInt(splitLatestVersion[i]);
				
				if (installedNum < latestNum) {
					return "OLDER";
				}
				else if (installedNum > latestNum) {
					return "NEWER";
				}
			}
			
			if (splitInstalledVersion.length < splitLatestVersion.length) {
				return "OLDER";
			}
			
			// If all parts are numerically equal, then return EQUAL.
			// This can happen if the versions are something like 2.3.0 and 2.03.0.
			// The '3' and '03' are not equal strings but are numerically equal.
			return "EQUAL";
		}
	}
	else {
		return "ERROR";
	}
}

function VersionIsNumeric(strtocheck) {
	var ValidCharacters = "0123456789.";
	
	for (i = 0; i < strtocheck.length; i++)
		if (ValidCharacters.indexOf(strtocheck.charAt(i)) < 0)
			return false;
	
	return true;
}


