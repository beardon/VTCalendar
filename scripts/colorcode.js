/* Example Usage:

<style type="text/css">
body {
	background-color: #EEEEEE;
}
.DeclStart, .DeclEnd, .DeclAttributes span {
	color: #990099 !important;
}
.ElementStart, .ElementEnd, .ElementName {
	color: #000099;
}
.ElementName {
	font-weight: bold;
}
.ElementAttr {
	color: #CC00CC;
}
.AttrName, .AttrEq {
	color: #009999;
}
.AttrValue, .AttrValueQuote {
	color: #0000FF;
}
.Text {
	color: #666666;
}
.CodeBox-Outer {
	border: 1px solid #666666;
	background-color: #FFFFFF;
	padding: 5px;
}
.CodeBox {
	padding: 0;
	margin: 0;
	overflow: scroll;
	width: 100%;
}
.Comment {
	color: #009900;
	font-style: italic;
}
.DocType {
	color: #0000FF;
}
</style>
<script type="text/javascript"><!-- // <![CDATA[
var colorer = new SourceCodeColorer();
colorer.UseBRTags = true;
colorer.UseNBSP = true;
var elements = document.getElementsByClassName('CodeBox');
for (var i = 0; i < elements.length; i++) {
	elements[i].innerHTML = colorer.ColorXML(elements[i].innerHTML.unescapeHTML());
}
// ]]> --></script>

<div class="CodeBox-Outer"><pre id="Example" class="CodeBox">SOME CODE</pre></div>

*/

function SourceCodeColorer(id) {
	this._HasInit = false;
	this.UseBRTags = false;
	this.UseNBSP = false;
	
	this.init = function() {
		this._HasInit = true;
		
		// Extended (from http://search.cpan.org/src/TJMATHER/XML-RegExp-0.03/lib/XML/RegExp.pm)
		/*var BaseChar = '(?:[a-zA-Z]|\\xC3[\\x80-\\x96\\x98-\\xB6\\xB8-\\xBF]|\\xC4[\\x80-\\xB1\\xB4-\\xBE]|\\xC5[\\x81-\\x88\\x8A-\\xBE]|\\xC6[\\x80-\\xBF]|\\xC7[\\x80-\\x83\\x8D-\\xB0\\xB4\\xB5\\xBA-\\xBF]|\\xC8[\\x80-\\x97]|\\xC9[\\x90-\\xBF]|\\xCA[\\x80-\\xA8\\xBB-\\xBF]|\\xCB[\\x80\\x81]|\\xCE[\\x86\\x88-\\x8A\\x8C\\x8E-\\xA1\\xA3-\\xBF]|\\xCF[\\x80-\\x8E\\x90-\\x96\\x9A\\x9C\\x9E\\xA0\\xA2-\\xB3]|\\xD0[\\x81-\\x8C\\x8E-\\xBF]|\\xD1[\\x80-\\x8F\\x91-\\x9C\\x9E-\\xBF]|\\xD2[\\x80\\x81\\x90-\\xBF]|\\xD3[\\x80-\\x84\\x87\\x88\\x8B\\x8C\\x90-\\xAB\\xAE-\\xB5\\xB8\\xB9]|\\xD4[\\xB1-\\xBF]|\\xD5[\\x80-\\x96\\x99\\xA1-\\xBF]|\\xD6[\\x80-\\x86]|\\xD7[\\x90-\\xAA\\xB0-\\xB2]|\\xD8[\\xA1-\\xBA]|\\xD9[\\x81-\\x8A\\xB1-\\xBF]|\\xDA[\\x80-\\xB7\\xBA-\\xBE]|\\xDB[\\x80-\\x8E\\x90-\\x93\\x95\\xA5\\xA6]|\\xE0(?:\\xA4[\\x85-\\xB9\\xBD]|\\xA5[\\x98-\\xA1]|\\xA6[\\x85-\\x8C\\x8F\\x90\\x93-\\xA8\\xAA-\\xB0\\xB2\\xB6-\\xB9]|\\xA7[\\x9C\\x9D\\x9F-\\xA1\\xB0\\xB1]|\\xA8[\\x85-\\x8A\\x8F\\x90\\x93-\\xA8\\xAA-\\xB0\\xB2\\xB3\\xB5\\xB6\\xB8\\xB9]|\\xA9[\\x99-\\x9C\\x9E\\xB2-\\xB4]|\\xAA[\\x85-\\x8B\\x8D\\x8F-\\x91\\x93-\\xA8\\xAA-\\xB0\\xB2\\xB3\\xB5-\\xB9\\xBD]|\\xAB\\xA0|\\xAC[\\x85-\\x8C\\x8F\\x90\\x93-\\xA8\\xAA-\\xB0\\xB2\\xB3\\xB6-\\xB9\\xBD]|\\xAD[\\x9C\\x9D\\x9F-\\xA1]|\\xAE[\\x85-\\x8A\\x8E-\\x90\\x92-\\x95\\x99\\x9A\\x9C\\x9E\\x9F\\xA3\\xA4\\xA8-\\xAA\\xAE-\\xB5\\xB7-\\xB9]|\\xB0[\\x85-\\x8C\\x8E-\\x90\\x92-\\xA8\\xAA-\\xB3\\xB5-\\xB9]|\\xB1[\\xA0\\xA1]|\\xB2[\\x85-\\x8C\\x8E-\\x90\\x92-\\xA8\\xAA-\\xB3\\xB5-\\xB9]|\\xB3[\\x9E\\xA0\\xA1]|\\xB4[\\x85-\\x8C\\x8E-\\x90\\x92-\\xA8\\xAA-\\xB9]|\\xB5[\\xA0\\xA1]|\\xB8[\\x81-\\xAE\\xB0\\xB2\\xB3]|\\xB9[\\x80-\\x85]|\\xBA[\\x81\\x82\\x84\\x87\\x88\\x8A\\x8D\\x94-\\x97\\x99-\\x9F\\xA1-\\xA3\\xA5\\xA7\\xAA\\xAB\\xAD\\xAE\\xB0\\xB2\\xB3\\xBD]|\\xBB[\\x80-\\x84]|\\xBD[\\x80-\\x87\\x89-\\xA9])|\\xE1(?:\\x82[\\xA0-\\xBF]|\\x83[\\x80-\\x85\\x90-\\xB6]|\\x84[\\x80\\x82\\x83\\x85-\\x87\\x89\\x8B\\x8C\\x8E-\\x92\\xBC\\xBE]|\\x85[\\x80\\x8C\\x8E\\x90\\x94\\x95\\x99\\x9F-\\xA1\\xA3\\xA5\\xA7\\xA9\\xAD\\xAE\\xB2\\xB3\\xB5]|\\x86[\\x9E\\xA8\\xAB\\xAE\\xAF\\xB7\\xB8\\xBA\\xBC-\\xBF]|\\x87[\\x80-\\x82\\xAB\\xB0\\xB9]|[\\xB8\\xB9][\\x80-\\xBF]|\\xBA[\\x80-\\x9B\\xA0-\\xBF]|\\xBB[\\x80-\\xB9]|\\xBC[\\x80-\\x95\\x98-\\x9D\\xA0-\\xBF]|\\xBD[\\x80-\\x85\\x88-\\x8D\\x90-\\x97\\x99\\x9B\\x9D\\x9F-\\xBD]|\\xBE[\\x80-\\xB4\\xB6-\\xBC\\xBE]|\\xBF[\\x82-\\x84\\x86-\\x8C\\x90-\\x93\\x96-\\x9B\\xA0-\\xAC\\xB2-\\xB4\\xB6-\\xBC])|\\xE2(?:\\x84[\\xA6\\xAA\\xAB\\xAE]|\\x86[\\x80-\\x82])|\\xE3(?:\\x81[\\x81-\\xBF]|\\x82[\\x80-\\x94\\xA1-\\xBF]|\\x83[\\x80-\\xBA]|\\x84[\\x85-\\xAC])|\\xEA(?:[\\xB0-\\xBF][\\x80-\\xBF])|\\xEB(?:[\\x80-\\xBF][\\x80-\\xBF])|\\xEC(?:[\\x80-\\xBF][\\x80-\\xBF])|\\xED(?:[\\x80-\\x9D][\\x80-\\xBF]|\\x9E[\\x80-\\xA3]))';
		var Ideographic = '(?:\\xE3\\x80[\\x87\\xA1-\\xA9]|\\xE4(?:[\\xB8-\\xBF][\\x80-\\xBF])|\\xE5(?:[\\x80-\\xBF][\\x80-\\xBF])|\\xE6(?:[\\x80-\\xBF][\\x80-\\xBF])|\\xE7(?:[\\x80-\\xBF][\\x80-\\xBF])|\\xE8(?:[\\x80-\\xBF][\\x80-\\xBF])|\\xE9(?:[\\x80-\\xBD][\\x80-\\xBF]|\\xBE[\\x80-\\xA5]))';
		var Digit = '(?:[0-9]|\\xD9[\\xA0-\\xA9]|\\xDB[\\xB0-\\xB9]|\\xE0(?:\\xA5[\\xA6-\\xAF]|\\xA7[\\xA6-\\xAF]|\\xA9[\\xA6-\\xAF]|\\xAB[\\xA6-\\xAF]|\\xAD[\\xA6-\\xAF]|\\xAF[\\xA7-\\xAF]|\\xB1[\\xA6-\\xAF]|\\xB3[\\xA6-\\xAF]|\\xB5[\\xA6-\\xAF]|\\xB9[\\x90-\\x99]|\\xBB[\\x90-\\x99]|\\xBC[\\xA0-\\xA9]))';
		var Extender = '(?:\\xC2\\xB7|\\xCB[\\x90\\x91]|\\xCE\\x87|\\xD9\\x80|\\xE0(?:\\xB9\\x86|\\xBB\\x86)|\\xE3(?:\\x80[\\x85\\xB1-\\xB5]|\\x82[\\x9D\\x9E]|\\x83[\\xBC-\\xBE]))';
		var CombiningChar = '(?:\\xCC[\\x80-\\xBF]|\\xCD[\\x80-\\x85\\xA0\\xA1]|\\xD2[\\x83-\\x86]|\\xD6[\\x91-\\xA1\\xA3-\\xB9\\xBB-\\xBD\\xBF]|\\xD7[\\x81\\x82\\x84]|\\xD9[\\x8B-\\x92\\xB0]|\\xDB[\\x96-\\xA4\\xA7\\xA8\\xAA-\\xAD]|\\xE0(?:\\xA4[\\x81-\\x83\\xBC\\xBE\\xBF]|\\xA5[\\x80-\\x8D\\x91-\\x94\\xA2\\xA3]|\\xA6[\\x81-\\x83\\xBC\\xBE\\xBF]|\\xA7[\\x80-\\x84\\x87\\x88\\x8B-\\x8D\\x97\\xA2\\xA3]|\\xA8[\\x82\\xBC\\xBE\\xBF]|\\xA9[\\x80-\\x82\\x87\\x88\\x8B-\\x8D\\xB0\\xB1]|\\xAA[\\x81-\\x83\\xBC\\xBE\\xBF]|\\xAB[\\x80-\\x85\\x87-\\x89\\x8B-\\x8D]|\\xAC[\\x81-\\x83\\xBC\\xBE\\xBF]|\\xAD[\\x80-\\x83\\x87\\x88\\x8B-\\x8D\\x96\\x97]|\\xAE[\\x82\\x83\\xBE\\xBF]|\\xAF[\\x80-\\x82\\x86-\\x88\\x8A-\\x8D\\x97]|\\xB0[\\x81-\\x83\\xBE\\xBF]|\\xB1[\\x80-\\x84\\x86-\\x88\\x8A-\\x8D\\x95\\x96]|\\xB2[\\x82\\x83\\xBE\\xBF]|\\xB3[\\x80-\\x84\\x86-\\x88\\x8A-\\x8D\\x95\\x96]|\\xB4[\\x82\\x83\\xBE\\xBF]|\\xB5[\\x80-\\x83\\x86-\\x88\\x8A-\\x8D\\x97]|\\xB8[\\xB1\\xB4-\\xBA]|\\xB9[\\x87-\\x8E]|\\xBA[\\xB1\\xB4-\\xB9\\xBB\\xBC]|\\xBB[\\x88-\\x8D]|\\xBC[\\x98\\x99\\xB5\\xB7\\xB9\\xBE\\xBF]|\\xBD[\\xB1-\\xBF]|\\xBE[\\x80-\\x84\\x86-\\x8B\\x90-\\x95\\x97\\x99-\\xAD\\xB1-\\xB7\\xB9])|\\xE2\\x83[\\x90-\\x9C\\xA1]|\\xE3(?:\\x80[\\xAA-\\xAF]|\\x82[\\x99\\x9A]))';
		var Letter = "(?:" + BaseChar + "|" + Ideographic + ")";
		var NameChar = "(?:[-._:]|" + Letter + "|" + Digit + "|" + Extender + "|" + CombiningChar + ")";*/
		
		// Basic Parts
		var Char = '(?:[\\x09\\x0A\\x0D\\x20-\\xFF])';
		var CharNoHyphen = '(?:[\\x09\\x0A\\x0D\\x20-\\x2C\\x2E-\\xFF])';
		var BaseChar = '(?:[a-zA-Z])';
		var Digit = '(?:[0-9])';
		var Extender = '(?:\\xB7)';
		var Letter = "(?:" + BaseChar + ")";
		var NameChar = "(?:[-._:]|" + Letter + "|" + Digit + "|" + Extender + ")";
		var Eq = '\\s*=\\s*';
		
		// Element Parts
		var Name = "(?:(?:[:_]|" + Letter + ")" + NameChar + "*)";
		var NmToken = "(?:" + NameChar + "+)";
		var EntityRef = "(?:\\&" + Name + ";)";
		var CharRef = "(?:\\&#(?:[0-9]+|x[0-9a-fA-F]+);)";
		var Reference = "(?:" + EntityRef + "|" + CharRef + ")";
		var AttValue = "(?:\"(?:[^\"&<]*|" + Reference + ")\"|'(?:[^\'&<]|" + Reference + ")*')";
		var Attribute = Name + Eq + AttValue;
		
		// Text Decl Parts
		var VersionInfo = '(?:\\s+version' + Eq + '[\'"]1.0[\'"])';
		var EncodingDecl = '(?:\\s+encoding' + Eq + '[\'"]' + EncName + '[\'"])';
		var SDDecl = '(?:\\s*standalone' + Eq + '[\'"](?:yes|no)[\'"])';
		var EncName = '(?:[A-Za-z]([A-Za-z0-9._]|-)*)';
		
		// DocType Parts
		var SystemLiteral = '(?:(?:"[^"]*")|(?:\'[^\']*\'))';
		var PubidChar = '(?:[\\x20\\x0D\\x0Aa-zA-Z0-9-\'()+,./:=?;!*#@$_%])';
		var PubidLiteral = '(?:(?:"' + PubidChar + '*")|(?:\'' + PubidChar.replace("'", "") + '*\'))';
		var ExternalID = '(?:(?:SYSTEM\\s+' + SystemLiteral + ')|(?:PUBLIC\\s+' + PubidLiteral + '\\s+' + SystemLiteral + '))';
		
		// DocType Declaration (most of it commented out due to complexity)
		//var PEReference = '(?:%' + Name + ';)';
		//var DeclSep = '(?:' + PEReference + '|\\s+)';
		//var Mixed = '(?:(?:\\(\\s*#PCDATA(?:\\s*\\|\\s*' + Name + ')*\\s*\\)\\*)|(?:\\(\\s*#PCDATA\\s*\\)))';
		//var Children = '(?:(?:' + Choice + '|' + Seq + ')[?*+]?)'; // (choice | seq) ('?' | '*' | '+')?
		//var ContentSpec = '(?:EMPTY|ANY|' + Mixed + '|' + Children + ')';
		//var ElementDelc = '(?:<!ELEMENT\\s+' + Name + '\\s+' + ContentSpec + '\\s*>)';
		//var MarkupDecl = '(?:' + ElementDecl + '|' + AttlistDecl + '|' + EntityDecl + '|' + NotationDecl + '|' + PI + '|' + Comment + ')';
		//var IntSubset = '(?:(?:' + MarkupDecl + '|' + DeclSep ')*)'
		var DocTypeDecl = '(?:<!DOCTYPE\\s+' + Name + '(?:\\s+' + ExternalID + ')?\\s*>)'; // (?:\\[' + IntSubset + '\\]\\s*)?
		
		var Element = '(?:</?' + Name + '(?:\\s*' + Attribute + ')*\\s*/?>)';
		var Comment = '(?:<!--(?:(?:' + CharNoHyphen + ')|(?:-' + CharNoHyphen + '))*-->)';
		
		// Create the pattern matching objects.
		this.XMLDeclPattern = '^(<\\?xml)(' + VersionInfo + EncodingDecl + '?' + SDDecl + '?\\s*)(\\?>)';
		this.SearchPattern = '('+DocTypeDecl+')|('+Element+')|('+Comment+')';
		this.ElementPattern = '(</?)(' + Name + ')((?:\\s*' + Attribute + ')*)(\\s*/?>)';
		this.AttributePattern = '(' + Name + ')(' + Eq + ')(' + AttValue + ')';
		
		this.reXMLDecl = new RegExp(this.XMLDeclPattern);
		this.reSearch = new RegExp(this.SearchPattern, 'g');
		this.reAttribute = new RegExp(this.AttributePattern, 'g');
		this.reElement = new RegExp(this.ElementPattern);
	}
	
	this.escapeHTML = function(source) {
		var result = source.escapeHTML();
		if (this.UseNBSP) {
			result = result.replace(/ /g, '&nbsp;').replace(/\t/g, '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');
		}
		if (this.UseBRTags) {
			result = result.replace(/(\r\n)|\r|\n/g, '<br/>');
		}
		return result;
	}
	
	this.ColorXML = function(source) {
		if (!this._HasInit) this.init();
		
		
		var result = '';
		var match;
		
		if ((match = this.reXMLDecl.exec(source)) != null) {
			if (match.index != 0) {
				result += this.escapeHTML(source.substring(0, match.index));
			}
			result += '<span class="DeclStart">' + this.escapeHTML(match[1]) + '</span>';
			result += '<span class="DeclAttributes">' + this.ColorAttributes(match[2]) + '</span>';
			result += '<span class="DeclEnd">' + this.escapeHTML(match[3]) + '</span>';
			source = source.substring(match[0].length, source.length);
		}
		
		var lastIndex = 0;
		while ((match = this.reSearch.exec(source)) != null) {
			if (match.index != lastIndex) {
				result += '<span class="Text">' + this.escapeHTML(source.substring(lastIndex, match.index)) + '</span>';
			}
			
			if (match[1]) {
				result += '<span class="DocType">' + this.escapeHTML(match[1]) + '</span>';
			}
			else if (match[2]) {
				result += this.ColorElement(match[2]);
			}
			else if (match[3]) {
				result += '<span class="Comment">' + this.escapeHTML(match[3]) + '</span>';
			}
			
			lastIndex = this.reSearch.lastIndex;
		}
		
		return result;
	}
	
	this.ColorElement = function(source) {
		if (!this._HasInit) this.init();
		
		var result = '';
		var match = this.reElement.exec(source);
		if (match != null) {
			result += '<span class="ElementStart">' + this.escapeHTML(match[1]) + '</span>';
			result += '<span class="ElementName">' + this.escapeHTML(match[2]) + '</span>';
			if (match[3]) {
				result += '<span class="ElementAttr">' + this.ColorAttributes(match[3]) + '</span>';
			}
			result += '<span class="ElementEnd">' + this.escapeHTML(match[4]) + '</span>';
			return result;
		}
		else {
			return source;
		}
	}
	
	this.ColorAttributes = function(attributes) {
		if (!this._HasInit) this.init();
		
		var result = '';
		
		var lastIndex = 0;
		var match;
		while ((match = this.reAttribute.exec(attributes)) != null) {
			if (match.index != lastIndex) {
				result += this.escapeHTML(attributes.substring(lastIndex, match.index));
			}
			
			result += '<span class="AttrName">' + this.escapeHTML(match[1]) + '</span>';
			result += '<span class="AttrEq">' + this.escapeHTML(match[2]) + '</span>';
			result += '<span class="AttrValueQuote">' + this.escapeHTML(match[3].substring(0, 1)) + '</span>';
			result += '<span class="AttrValue">' + this.escapeHTML(match[3].substring(1,match[3].length-1)) + '</span>';
			result += '<span class="AttrValueQuote">' + this.escapeHTML(match[3].substring(0, 1)) + '</span>';
			lastIndex = this.reAttribute.lastIndex;
		}
		
		return result;
	}
}