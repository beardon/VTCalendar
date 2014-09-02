<?php
  session_start();
	
  if (strpos(" ".$_SERVER["HTTP_USER_AGENT"],"MSIE") > 0) { $ie = 1; }
  else { $ie = 0; }    
?>body, td, p {
  font-family: Arial,Helvetica,Sans-Serif;
	font-size: <?php if ($ie) { echo "x-"; } ?>small;
  margin : 0 0px 0px 0px;
}
.calendartitle {
	font-size: 20px;
	font-weight: bold;
}
.datetitle {
	font-size: 20px;
}
.eventtitlebig {
  font-size: 24px;
	font-weight: bold;
}
.eventtimebig {
  font-size: 18px;
}
.littlecalendardatetitle {
	font-size: <?php if ($ie) { echo "x-"; } ?>small;
	font-weight: bold;
}
.littlecalendarheader {
	font-size: <?php if ($ie) { echo "x"; } ?>x-small;
}
.littlecalendarday {
	font-size: <?php if ($ie) { echo "x"; } ?>x-small;
}
.littlecalendarday a {
	color: #0000ff;
}

.littlecalendarother {
	font-size: <?php if ($ie) { echo "x"; } ?>x-small;
	color : #cccccc;
}
.todayis {
	font-size: <?php if ($ie) { echo "x-"; } ?>small;
}
.weekheaderpast,.weekheaderfuture {
  background-color : #aaaaaa;
}
.weekheadertoday {
  background-color : #aaaaaa;
}
.monthheaderpast,.monthheaderfuture {
  background-color : #aaaaaa;
}
.monthheadertoday {
  background-color : <?php echo $_SESSION["TODAYCOLOR"]; ?>;
}
.past {
  background-color : #eeeeee;
	color : #999999;
}
.past a {
	color : #999999;
}
.today {
  background-color : <?php echo $_SESSION["TODAYCOLOR"]; ?>;
}
.future {
  background-color : #ffffff;
}
.eventtime {
	font-size: <?php if ($ie) { echo "x"; } ?>x-small;
}
.eventcategory {
	font-size: <?php if ($ie) { echo "x"; } ?>x-small;
}
.tabactive {
  background-color: <?php echo $_SESSION["MAINCOLOR"]; ?>;
}
.tabinactive {
  background-color: #cccccc;
}
.announcement {
	font-size: medium;
}
.feedbackpos {
  COLOR: #00AA00;
  FONT-WEIGHT: bold;
  FONT-SIZE: <?php if ($ie) { echo "x-"; } ?>small;
}
.feedbackneg {
  COLOR: #FF0000;
  FONT-WEIGHT: bold;
  FONT-SIZE: <?php if ($ie) { echo "x-"; } ?>small;
}
h3.boxheader {
  FONT-SIZE: medium;
}

