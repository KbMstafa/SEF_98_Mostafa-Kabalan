<?php
	$rows=array("qwertyuiop", "asdfghjkl", "zxcvbnm");
	$words=array();
	$lengh=0;
	if(isset($argv[1])){
		if(is_numeric($argv[1])){
			for($numberOfWords=0; $numberOfWords<$argv[1]-0; $numberOfWords++){
				$words[]=trim(fgets(STDIN));
			}
		}else if(is_file($argv[1])){
			$arrayOfLines=file($argv[1]);
			foreach ($arrayOfLines as &$value) {
				$value=trim($value);
			}
			$stringOfWords=implode(" ", $arrayOfLines);
			$words=explode(" ", $stringOfWords);
			
		}
	}
	else{
		echo "\ntype after $argv[0] a number or words or a file\n";
        exit();
	}
	foreach($words as $word){
		if($word!=""){
			foreach ($rows as $row) {
					if(stripos($row, $word[0]) !== False){
						break;
					}
			}
			for($letters=1; $letters<strlen($word); $letters++){
				if(stripos($row, $word[$letters]) === False){
					break;
				}
			}
			if($letters==strlen($word) && strlen($word)>$lengh){
				$output=$word;
				$lengh=strlen($word);
			}
		}
	}
	if(isset($output)){
		echo"\n$output\n";
	} else{
		echo"\nNO word from the same row\n";
	}
?>