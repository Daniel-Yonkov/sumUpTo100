<?php
$nums = array(1,2,3,4,5,6,7,8,9);
$operators = array('+','-','');
$permutations = array();
$i = 0;
$base = count($operators);
$elements = count($nums);
$results=array();
while(count($permutations) !== pow($base,$elements)){
	$permutations[$i]=convertToBase($i, $base, $elements);
	$i++;
}
$sumTo100 = upTo100($nums,$permutations);

foreach($sumTo100 as $key => $val){
	foreach ($val as $k => $v) {
		echo "Permutation $k with values $v<br>";		
	}
}
 // create all possible permutations based on the number of 
function convertToBase($num, $base, $elements){
	$index = 0;
	$digit = array_fill(0, $elements, 0);
	while($num != 0){
		$remained = $num % $base;
		$num = (int)($num / $base);
		$digit[$index] = $remained;
		$index++;
	}
	return array_reverse($digit);
}

function upTo100($nums, $permutations){
	foreach ($permutations as $key => $value) {
	$sum=0;
	$prevNumber=0;
	$lastElement = count($value)-1;
	foreach ($value as $k => $v) {
		if($k == 0){
			$prevNumber=$nums[$k];
			$results = array($key => "");
			if($v == 1){
				$prevNumber = -$nums[$k];
			}
			continue;
		}
		switch ($v) {

			case 0:
				$sum += $prevNumber;
				$results[$key].="$prevNumber + ";
				$prevNumber=$nums[$k];
				break;
			case 1:
				$sum +=$prevNumber;
				$results[$key].="$prevNumber ";
				$prevNumber= -$nums[$k];
				
				break;
			default:
				$prevNumber.=$nums[$k];
				break;
		}
		if($k == $lastElement){
			$sum+=$prevNumber;
			$results[$key] .= $prevNumber;
		}
	}
	if($sum == 100){
		$results[$key].=" = 100";
		$sumTo100[]=$results;
		continue;
	}
}
unset($results);
return $sumTo100;
}
