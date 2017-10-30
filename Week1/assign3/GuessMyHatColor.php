#!/usr/bin/php

<?php
    function solvePuzzle($array, $lengh){
        echo "\nGuesses of the persons \n";
        $GuessesArray = array();
        if($lengh%2==0){
            if(countOcc($array, 1, $lengh, "black")%2!=0){
                $primaryColor="black";
                $secondaryColor="white";
            } else{
                $primaryColor="white";
                $secondaryColor="black";
            }
            $status="Odd";
        } else {
            if(countOcc($array, 1, $lengh, "black")%2!=0){
                $primaryColor="black";
                $secondaryColor="white";
                $status="Odd";
            } else{
                $primaryColor="white";
                $secondaryColor="black";
                $status="Even";
            }
        }
        echo "$primaryColor \n";
        $GuessesArray[]=$primaryColor;
        for($i=1; $i<$lengh; $i++){
            if(testIfChangeStatus($array, $i+1, $lengh, $primaryColor, $status)){
                echo "$primaryColor \n";
                $GuessesArray[]=$primaryColor;
            } else {
                echo "$secondaryColor \n";
                $GuessesArray[]=$secondaryColor;
            }
        }
        $mistakes=0;
        for($i=0; $i<$lengh; $i++){
            if($array[$i]!=$GuessesArray[$i]){
                $mistakes++;
            }
        }
        if($mistakes==1){
            echo "Humans passed the challenge with 1 mistake\n";
        } else if($mistakes==0){
            echo "Humans passed the challenge with no mistakes\n";
        } else{
            echo "Humans failed\nAliens will destroy the Earth !!\n";
        }
    }

    function testIfChangeStatus($array, $beginning, $end, $item, &$status){
        $count=countOcc($array, $beginning, $end, $item);
        if($count%2==0 && $status=="Odd"){
            $status="Even";
            return 1;
        }
        if($count%2!=0 && $status=="Even"){
            $status="Odd";
            return 1;
        }
        return 0;
    }

    function countOcc($array, $beginning, $end, $item){
        $count=0;
        for($i=$beginning; $i<$end; $i++){
            if($array[$i] == $item){
                $count++;
            }
        }
        return $count;
    }

    $numberOfHats=$argv[1];
    if(is_int($numberOfHats-0) && $numberOfHats != 0){
        echo "Enter $numberOfHats entries (black or white): \n";
        $inputsProvided=$numberOfHats;
        $hatArray=array();
        $secondInput="";
        while($inputsProvided > 0){
            fscanf(STDIN, '%s', $secondInput);
            if(strcasecmp($secondInput, "black") == 0 || strcasecmp($secondInput, "white") == 0){
                $hatArray[$numberOfHats-$inputsProvided]=strtolower($secondInput);
                $inputsProvided--;
            } else {
                echo "Invalid input provided please enter either black or white\n";
            }
        }
        solvePuzzle($hatArray,$numberOfHats);
    } else {
        echo "$argv[1] must be a decimal number\n";
        exit();
    }  
?>