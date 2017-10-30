#!/usr/local/bin/php

<?php
	function getContents($directory)
	{
		$cont=array();
		$cont=scandir ( $directory );
		foreach ( $cont as $file )
		{
			if ( $file != "." && $file != ".." )
			{
				if ( is_dir( $directory."/".$file ))
				{
					getContents($directory."/".$file);
					echo "$file (folder)\n";
					

				}
				else
				{
					echo "$file:\t \t".realpath($directory)."\n";
				}
			}
		}
	}




	if( $argv[1] == "-i" )
	{
		$options = getopt("i:");
		if ( isset( $options["i"] ) )
		{
			if ( is_dir( $options["i"] ))
			{
				echo "Files within ".$options["i"]." :\n \n";
				getContents($options["i"]);
			}
			else 
				echo "No such file or directory '".$options["i"]."'\n";
		}
		else
			echo "No such file or directory";
	}
	else
		echo "Type -i as option then the directory path";
?> 



