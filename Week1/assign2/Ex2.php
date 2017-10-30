<?php
	$line=file("/var/log/apache2/access.log");

	foreach($line as $value)
	{
		$first_comma=strpos($value, '"');
		$second_comma=strpos($value, '"', $first_comma+1);
		$first_space_after_second_comma=strpos($value, " ", $second_comma+1);
		$second_space_after_second_comma=strpos($value, " ", $first_space_after_second_comma+1);
		$first_space=strpos($value, ' ');
		$open_bracket=strpos($value, '[');
		$plus=strpos($value, '+');
		
		echo substr($value, 0, $first_space)." -- ";
		$d=trim(substr($value, $open_bracket+1, $plus-$open_bracket-1));
		$date= date_create_from_format("d/M/Y:H:i:s", $d);
		echo date_format($date,"l, F d Y : H-i-s")." -- \"";
		echo substr($value, $first_comma+1, $second_comma-$first_comma-1)."\" -- ";	
		echo substr($value, $first_space_after_second_comma+1, $second_space_after_second_comma-$first_space_after_second_comma-1)."\n";
	}

?>