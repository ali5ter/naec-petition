<head>
<meta charset="utf-8" />
<style>
@import url('./texgyreschola/f.css');

body,p,div { 
  background: #FFF url("window-tile.jpg") repeat;
  font-family: texgyreschola, Myriad, Optima, sans-serif;
  font-size: 13pt;
  line-height: 16pt;
}

body { margin: 0; }

td  { vertical-align: top; font-size: 11pt; }
h1  { font: 16pt texgyreschola, Myriad, Tahoma, Optima; margin: 0 0 1em; }
s   { color: rgb(180,0,30); font-weight: bold; text-decoration: none; }

#navigate { font-size: 13px; width: 70%; text-align: left; margin: 0 auto 8px }
.entry,.name,.hide,.entry p,.address,.date,.message { background: #f2f2f2; }
.entry    { border: dashed 1px #dddddd; width: 70%; padding: 10px 10px 0px 10px; margin: 0 auto 15px; text-align: left }
.name     { font-weight: bold; float: left;}
.hide     { visibility: hidden; }
.off      { pointer-events: none; cursor: default; }
.entry p  { clear: both; margin-top: 0; margin-bottom: 1em }
.address  { visibility: hidden; font-size: 10px; float: left; }
.date     { font-size: 10pt; text-align: right; color:#aaa; margin-bottom: 0px; }
.message  { font: 12pt texgyreschola, Georgia, serif; line-height: 15pt; margin: 20px 0 0 0; text-align: left; }
label     { float: left; text-align: left; font: 12pt texgyreschola, Myriad-Pro, Verdana, Arial; font-weight: bold; width: 80px; margin-left: 0px }
input, textarea { 
  width: 80%; 
  border: solid #e6e6b6 1px; 
  padding:3px; 
  background: #ffffdd; 
  font: 12pt texgyreshcola, Tahoma, Verdana, Arial, Helvetica, sans-serif;
  font-family: texgyreschola;
}
input.submit { 
  font-family: texgyreschola,serif; 
  font-weight: bold; width: auto; color:#050;
  font-size:84%;
  font-weight:bold;
  background-color:#ffffdd;
  border:2px solid;
  border-top-color:#696;
  border-left-color:#696;
  border-right-color:#363;
  border-bottom-color:#363;
  border-style:outset; 
}
input.btnhov {
  color:#f22;
  border-top-color:#c63;
  border-left-color:#c63;
  border-right-color:#930;
  border-bottom-color:#930;
  border-style:inset;
}
#submit   { font-weight: bold; margin-left: 0px; text-align: left; background: #f2f2f2; }
* html #submit { margin-left: 133px }
form      { margin-bottom: 1em }
.spacer   { clear: both; background: #f2f2f2; height: 6px }
a         { color: rgb(0,150,0); text-decoration: none; }
a:hover   { color: rgb(0,200,0); background:transparent; text-decoration: underline }

.sign {
  margin-left: 28px;
  padding-left: 3px;
  font-size: 14pt;
}
.deny {
  margin: 0;
  padding: 0;
  width: 100%;
  height:auto;
}
.text {
  margin: 28px;
}

@media screen and (device-aspect-ration: 2/3) { /* iPhone < 5 */
  body,p,s,div,.entry,.name,.address,.message,input,label,form,.sign {
    font-size: 135%;
    line-height: 135%;
  }
  label { font-size: 100%; width: 20%; }
  input { width: 75%; }
  .entry { width: 100%; }
}

@media screen and (device-aspect-ratio: 40/71) /* and (orientation: portrait) */ {
  body,p,s,div,.entry,.name,.address,.message,input,label,form,.sign {
    font-size: 135%;
    line-height: 135%;
  }
  label { font-size: 100%; width: 20%; }
  input { width: 75%; }
  .entry { width: 100%; }
}
</style>
</head>
<body>

<?

$file = 'entries.txt';
$lines = file($file);
$entries = count($lines);
$numPages = 1;

function numsigners(){
  global $entries;
  printf("%d",$entries);
}

function numpages(){
  global $entries, $numPages;
  if(!$_SERVER['QUERY_STRING']) { $n = 1; }
  else { $n = $_GET['n']; }

  $d = $entries / 10;
  $f = floor($d);
  $numPages = ($d == $f)? $f : $f + 1;

  if ($n > 1) { echo '<a href="?n='.($n - 1).'">&#9669;</a> '; }
  for ($i = 1; $i <= $numPages; $i++) {
    if ($i == $n) { echo $i.' '; }
    else { echo '<a href="?n='.$i.'">'.$i.'</a> '; }
  }
  if ($n < $numPages) { echo '<a href="?n='.($n + 1).'">&#9659;</a> '; }
}

function showbook(){
  global $lines,$entries;
  $n = (!$_SERVER['QUERY_STRING'])? 1 : $_GET['n'];
  $min = 10 * ($n - 1);
  $max = 10 * $n - 1;

  foreach($lines as $i => $line){
    if ($i > $max) break;
    if ($i >= $min){
      $entryNum = $entries - $i;
      echo $line;
    }
  }
}

?>

<style>

</style>

<title>Petition: DENY THE PERMITS (SP#288) for Proposed Redevelopment of Sullivan Courthouse</title>

<a href="#petition"><img class=deny src="deny.jpg"></a>
<p>
<div class=text>
<p>
What's wrong with this picture?  <b>Everything</b>.  See: <a href="http://40thorndike.org" target=_blank>http://40thorndike.org</a>
<br>
<div class=sign><a name="petition" href="#write"><b>Sign the petition!</b>  <span style="font-size:18pt">&#9997;</span></a></div>
<br><p>

<table>
<tr><td>To:</td><td>Cambridge Mayor; City Council; City Manager; Planning Board; Head of Community Development; State Representatives Decker & Toomey; Commissioner, Department of Environmental Protection</td>
</tr><tr><td>From:</td><td>Concerned Residents of Cambridge, Massachusetts</td>
</tr><tr><td>Date:</td><td>23 February 2014</td>
</tr></table>
<p>
We, concerned residents of Cambridge, hereby make it known to our City representatives that:  
<br>
<s>We vigorously oppose</s> the redevelopment proposed by Leggat McCall for the Sullivan Courthouse.  
<br>
<s>We would applaud</s> development that is wisely planned, that conforms with existing zoning rules,
and that has a character appropriate for this quiet, historic, residential neighborhood.
<p>
Any new development should conform to the zoned 80’ height limit adjoining a 35' residential area, and should not result in
a significantly more damaging impact than what came before. Whatever is done here should <s>respect the 
historic founding gift, which gave this property to the people of Middlesex County for public use forever</s>.
The donors demanded the highest standards of design and construction, and they realized that vision beautifully. 
That trust established a healthy balance of public and private space around which a vibrant and dedicated community could blossom.
<p>
However, as most in the City and Commonwealth would agree: <s>the Sullivan Courthouse Building should
never have been built</s>. The process that created it was corrupt and illegitimate. 
At 22 stories nearly 300 feet in height and over 500,000 square feet, it is wildly inappropriate 
in size for the neighborhood, badly built, riddled with asbestos, had inadequate parking, 
created a wind tunnel, and eventually had to be abandoned because it was an environmental hazard, 
among other problems. <s>It was a very big mistake</s>.
<p>
Most people would also agree: when you make a mistake, you should clean it up. 
The Commonwealth has not cleaned up this one. Instead, it seeks profit from it. 
It auctioned the property to the highest bidder in disregard of any sensible neighborhood plan, 
and is exacting such a high price that any developer is forced to repurpose the <s>full bulk</s> of 
this building to pay for the State’s mistake. But this doesn’t fix the mistake.  
It perpetuates it, and in many ways, makes it worse. It shovels the whole burden of that mistake onto developers, and ultimately, onto the community. And it privatizes a civic-minded founding gift that was clearly intended to be public forever. <s>This is wrong</s>.
<p>
The Sullivan Building is fully <s>amortized</s>, effectively <s>abandoned</s> and an <s>environmental hazard</s>.  
It was a <s>mistake</s>. It needs to go. This small piece of property should be approached with 
the duty of care, visionary enthusiasm and public excellence that put East Cambridge 
on the map in the first place.   And thus, we ask our representatives:
<div style="padding-left: 10px">
Please <s>deny the Application for Special Permits #288</s>.
<br>
Please <s>deny the request for waiver of project review under Mass. Environmental Policy Act (MEPA)</s>.
<br>
Please <s>deny the request to lease the 425 public spaces from the municipal garage</s>.
<br>
Please <s>declare the nonconforming status of the failed building to be effectively terminated</s>.
<br>
Please <s>wisely enforce both the letter and the spirit of zoning laws</s> and <s>insist</s> that any redevelopment
of the former Courthouse site respects the finest standards of public planning, strengthens the historic integrity of the neighborhood, and conforms properly to local limits</s>.
</div>
<p>
East Cambridge deserves better.
</div>

<p>
<div id="navigate"><b><? numsigners(); ?></b> signatories.<br>page: <? numpages() ?></div>

<? showbook() ?>

<p>
<div id="navigate"><span style="font-size:11pt; color:#aaa">&#9688;</span> page: <? numpages() ?></div>

</div>

<div class=sign><s>Sign the petition.</s>
<p>
<a name="write"></a>
Write your message here and push <b>Sign!</b> to post it.
(<a href="mailto:info@40thorndike.org">Mail us</a> if you have any difficulties.)
</div>

<div class="entry">
<form method="post" action="signbook.php">
<div class="spacer"></div>
<label>name:</label><input type="text" name="signername" />
<div class="spacer"></div>
<label>email:</label><input type="text" name="email" />
<div class="spacer"></div>
<label>address:</label><input type="text" name="address" />
<div class="spacer"></div>
<label>message:</label><textarea name="message" rows="5" cols="20"></textarea>
<input type="hidden" name="bookurl" value="<?=$_SERVER['PHP_SELF']?>" />
<div class="spacer"></div>
<div id="submit"><input type="submit" name="submit" value="Sign!" class="submit" onmouseover="this.className='submit btnhov'" onmouseout="this.className='submit'"/></div>
</form>
</div>

</body>
</html>
