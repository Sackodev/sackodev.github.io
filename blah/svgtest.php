<?php
$str = "Hello! How are you?? Well, actually, I am doing swell... Thanks for asking!";

function moveCharsToBack($haystack){
	$offset = 0;
	while ($num = strrpos($haystack, '?', $offset)){
		$char = substr($haystack, $num, 1);
		$str1 = substr($haystack, 0, $num);
		$str2 = substr($haystack, ($num+1));
		$haystack = $char . $str1 . $str2;
		$offset++;
	}
	$offset = 0;
	while ($num = strrpos($haystack, '!', $offset)){
		$char = substr($haystack, $num, 1);
		$str1 = substr($haystack, 0, $num);
		$str2 = substr($haystack, ($num+1));
		$haystack = $char . $str1 . $str2;
		$offset++;
	}
	$offset = 0;
	while ($num = strrpos($haystack, ',', $offset)){
		$char = substr($haystack, $num, 1);
		$str1 = substr($haystack, 0, $num);
		$str2 = substr($haystack, ($num+1));
		$haystack = $char . $str1 . $str2;
		$offset++;
	}
	while ($num = strrpos($haystack, '.', $offset)){
		$char = substr($haystack, $num, 1);
		$str1 = substr($haystack, 0, $num);
		$str2 = substr($haystack, ($num+1));
		$haystack = $char . $str1 . $str2;
		$offset++;
	}
	return $haystack;
}

//$lastSpace = strrpos($str," ");
$wordArray = explode(' ', $str);
$wordArray = array_reverse($wordArray);

$newStr = '';
$countArray = count($wordArray);
for ($i = 0; $i < count($wordArray); $i++){
	$wordArray[$i] = moveCharsToBack($wordArray[$i]);
	$newStr .= $wordArray[$i];
	if ($i != $countArray){
		$newStr .= ' ';
	}
}

$newStr = strtoupper($newStr);
$arr = str_split($newStr);
$arr = array_reverse($arr);

$speedTime = 3;
$charDelay = 63;

$content = '<link href=\'http://fonts.googleapis.com/css?family=Orbitron\' rel=\'stylesheet\' type=\'text/css\'>';

$arrNum = 0;
while (isset($arr[$arrNum])){
	$timeForChar = $arrNum * $charDelay;
	$content .='
		<div id="anim" style="position:absolute;top:0px;left:0px;">
		<svg height="720" width="1280">
		<defs>
			<path id="animPath" d="M0 100 q 150 80 300 0 q 150 -80 300 0 q 150 80 300 0 q 150 -80 300 0 q 150 80 300 0" fill="none"/>
		</defs>
		<use xlink:href="#animPath" fill="none"/>
		<text x="2" y="20%" fill="black" font-size="32" font-family="\'orbitron\'" font-weight="bold" visibility="hidden">
			<textPath class="please" xlink:href="#animPath" startOffset="0%">' . $arr[$arrNum] . '
			<set attributeName="visibility" attributeType="CSS" to="visible"
			   begin="' . $timeForChar . 'ms" dur="' . $speedTime . 's" fill="freeze" />
				<animate attributeName="startOffset" values="0;.5;1" dur="' . $speedTime . 's" fill="freeze" keyTimes="0;.5;1" begin="' . $timeForChar . 'ms" />
				<set attributeName="visibility" attributeType="CSS" to="hidden"
			   begin="' . (($speedTime * 1000) + ($charDelay * $arrNum)) . 'ms" dur="' . $speedTime . 's" fill="freeze" />
		  </textPath>
	</svg>
	</div>
	';
$arrNum++;
}
$time = ((count($arr) * $charDelay) + ($speedTime * 1000))/1000;
header("refresh: " . $time . ";");
echo $content;
?>