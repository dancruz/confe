<?php
?>
<script>
function goLastMonth(month, year){
// If the month is January, decrement the year
if(month == 1){
--year;
month = 13;
}
document.location.href = '<?=$_SERVER['PHP_SELF'];?>?month='+(month-1)+'&year='+year;
}
//next function
function goNextMonth(month, year){
// If the month is December, increment the year
if(month == 12){
++year;
month = 0;
}
document.location.href = '<?=$_SERVER['PHP_SELF'];?>?month='+(month+1)+'&year='+year;
} 

function remChars(txtControl, txtCount, intMaxLength)
{
if(txtControl.value.length > intMaxLength)
txtControl.value = txtControl.value.substring(0, (intMaxLength-1));
else
txtCount.value = intMaxLength - txtControl.value.length;
}

function checkFilled() {
var filled = 0
var x = document.form1.calName.value;
//x = x.replace(/^\s+/,""); // strip leading spaces
if (x.length > 0) {filled ++}

var y = document.form1.calDesc.value;
//y = y.replace(/^s+/,""); // strip leading spaces
if (y.length > 0) {filled ++}

if (filled == 2) {
document.getElementById("Submit").disabled = false;
}
else {document.getElementById("Submit").disabled = true} // in case a field is filled then erased

}

</script>
<style>
.today{
/*background-color:#00CCCC;*/
font-weight:bold;
background-repeat:no-repeat;
background-position:center;
position:relative;
}
.today span{
position:absolute;
left:0;
top:0; 
}

.today a{
color:#000000;
padding-top:10px;
}
.selected {
color: #FFFFFF;
background-color: #C00000;
}
.event {
background-color: #C6D1DC;
border:1px solid #ffffff;
} 
.normal {

} 
table{
border:1px solid #cccccc;
padding:3px;
}
th{
width:36px;
background-color:#cccccc;
text-align:center;
color:#ffffff;
border-left:1px solid #ffffff;
}
td{
text-align:center;
padding:10px;
margin:0;
}
table.tableClass{
width:350px;
border:none;
border-collapse: collapse;
font-size:85%;
border:1px dotted #cccccc;
}
table.tableClass input,textarea{
font-size:90%;
}
#form1{
margin:5px 0 0 0;
}
#greyBox{
height:10px;
width:10px;
background-color:#C6D1DC;
border:1px solid #666666;
margin:5px;
}
#legend{
margin:5 0 10px 50px;
width:200px;
}
#hr{border-bottom:1px solid #cccccc;width:300px;}
.output{width:300px;border-bottom:1px dotted #ccc;margin-bottom:5px;padding:6px;}
h5{margin:0;}
</style>
</head>

<body>
<div id="container">
<div class="maincontent" id="content">
<?php
function mesnom($d){
switch($d){
case 1: $e='Enero'; break;
case 2: $e='Febrero'; break;
case 3: $e='Marzo'; break;
case 4: $e='Abril'; break;
case 5: $e='Mayo'; break;
case 6: $e='Junio'; break;
case 7: $e='Julio'; break;
case 8: $e='Agosto'; break;
case 9: $e='Septiembre'; break;
case 10: $e='Octubre'; break;
case 11: $e='Noviembre'; break;
case 12: $e='Diciembre'; break;
}
return $e;
}
$day = (isset($_GET["day"])) ? $_GET['day'] : "";
$month = (isset($_GET["month"])) ? $_GET['month'] : "";
$year = (isset($_GET["year"])) ? $_GET['year'] : "";
if(empty($day)){ $day = date("j"); }

if(empty($month)){ $month = date("n"); }

if(empty($year)){ $year = date("Y"); } 
//set up vars for calendar etc
$currentTimeStamp = strtotime("$year-$month-$day");
$monthName = mesnom($month);
$numDays = date("t", $currentTimeStamp);
$counter = 0;
function hiLightEvt($eMonth,$eDay,$eYear){
$todaysDate = date("n/j/Y");
$dateToCompare = $eMonth . '/' . $eDay . '/' . $eYear;
if($todaysDate == $dateToCompare){
$aClass='class="today"';
}
else{
$result = mysql_query("SELECT * FROM ponencias WHERE dates = '" . $eYear . '-' . $eMonth . '-' . $eDay . "'");
if($row = mysql_fetch_array($result)){
$aClass = 'class="event"';
}else{
$aClass ='class="normal"';
}
}
return $aClass;
}
?>
<div>
<table width="350" cellpadding="0" cellspacing="0">
<tr>
<td width="50" colspan="1">
<input type="button" value=" < " onClick="goLastMonth(<?php echo $month . ", " . $year; ?>);">
</td>
<td width="250" colspan="5">
<span class="title"><?php echo $monthName . " " . $year; ?></span><br>
</td>
<td width="50" colspan="1" align="right">
<input type="button" value=" > " onClick="goNextMonth(<?php echo $month . ", " . $year; ?>);">
</td>
</tr> 
<tr>
<th>D</td>
<th>L</td>
<th>M</td>
<th>M</td>
<th>J</td>
<th>V</td>
<th>S</td>
</tr>
<tr>
<?php
for($i = 1; $i < $numDays+1; $i++, $counter++){
$dateToCompare = $month . '/' . $i . '/' . $year;
$timeStamp = strtotime("$year-$month-$i");
if($i == 1){
// Workout when the first day of the month is
$firstDay = date("w", $timeStamp);
for($j = 0; $j < $firstDay; $j++, $counter++){
echo "<td>&nbsp;</td>";
} 
}
if($counter % 7 == 0){
?>
</tr><tr>
<?php
}
?>
<!--right here-->
<td width="50" <?=hiLightEvt($month,$i,$year);?>><a href="<?=$_SERVER['PHP_SELF'] . '?month='. $month . '&day=' . $i . '&year=' . $year;?>&v=1"><?=$i;?></a></td> 
<?php
}
?>
</table>
</div>
<div style="float: right; margin: -45% -60%; z-index: 1;">
<h3><?php echo  $day. '-' . $monthName . '-' . $year; ?></h3>
<?php
if(isset($_GET['v'])){
$result = mysql_query("SELECT nom_confe,hours FROM ponencias WHERE dates = '" . $year . '-' . $month . '-' . $day . "'",$cnx);
$numRows = mysql_num_rows($result);
if($numRows == 0 ){
echo '<h3>No tienes eventos</h3><div class="output"></div>';
}else{
echo '<h3>Eventos</h3>';
while($row = mysql_fetch_array($result)){
?>
<div class="output">
<h3><?php echo $row['nom_confe'];?></h3>
Hora: <?php echo $row['hours'];?>
</div>
<?php
}
}
}
else {
echo '<div class="output"></div>';
}
?>
 </div>
 </div>
 <?php
mysql_close();
?>