<?php

create_graph("calls-gw-usw-halfday-wall.png", 	"-12h", 	"Calls last 12 hours",	 	   "200", "1100");
create_graph("calls-gw-usw-month-wall.png",    	"-1m",          "Calls last 1 month",              "150", "1100");
create_graph("calls-gw-usw-year-wall.png",     	"-1y",          "Calls last 1 year",               "150", "1100");

echo "<html><head>";
#echo "<style> div.outer {display:block; margin-left:auto; margin-right:auto;}</style>";
echo "<meta http-equiv=\"refresh\" content=\"30\">";
echo "</head><body bgcolor='#080808'>";

echo "<font color='#808080' size ='9' face='verdana'>US West Gateway </font>";
echo "<font color='#608080' size ='2' face='verdana'>timezone : ";
date_default_timezone_set('America/Los_Angeles');
echo date('T');
echo "</font>";

echo "<div align='center'>";

#echo "<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-gw-usw-halfday-wall.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";

#echo "<BR>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-gw-usw-month-wall.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";

#echo "<BR>";

echo "<table>";
echo "<tr><td>";
echo "<img src='calls-gw-usw-year-wall.png' alt='Generated RRD image'>";
echo "</td></tr>";
echo "</table>";

echo "</div>";

echo "<BR>";

echo "<font color='#606080' size ='2' face='verdana'>last update : ";

date_default_timezone_set('Europe/London');
echo date('H:i T');
echo "   ,   ";

date_default_timezone_set('Europe/Berlin');
echo date('H:i T');
echo "   ,   ";

date_default_timezone_set('Europe/Tallinn');
echo date('H:i T');
echo "   ,   ";

date_default_timezone_set('Asia/Tokyo');
echo date('H:i T');

echo "</font>";

echo "</body></html>";

exit;

function create_graph($output, $start, $title, $height, $width) {

  $options = array(
    "--slope-mode",
    "--start", $start,
    "--title=$title",
    "--vertical-label=Calls",
    "--lower=0",
    "--height=$height",
    "--width=$width",
    "-cBACK#161616",
    "-cCANVAS#1e1e1e",
    "-cSHADEA#000000",
    "-cSHADEB#000000",
    "-cFONT#c7c7c7",
    "-cGRID#888800",
    "-cMGRID#ffffff",
    "-nTITLE:10",
    "-nAXIS:12",
    "-nUNIT:10",
    "-y 1:5",
    "-cFRAME#ffffff",
    "-cARROW#000000",
    "DEF:callmax=/usr/local/scripts/git/jcall2/data/jcall-gw-usw.rrd:callstot:MAX",
    "CDEF:transcalldatamax=callmax,1,*",
    "AREA:transcalldatamax#a0b84240",
    "LINE4:transcalldatamax#a0b842:Calls",
    "COMMENT:\\n",
#    "GPRINT:transcalldatamax:LAST:Calls Now %6.2lf",
    "GPRINT:transcalldatamax:MAX:Calls Max %6.2lf"
  );

 $ret = rrd_graph($output, $options, count($options));

  if (! $ret) {
    echo "<b>Graph error: </b>".rrd_error()."\n";
  }
}

?>
