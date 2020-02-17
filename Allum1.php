#!/usr/bin/php
<?php

function turn($player,$nbr,$i){

        $o = 1;
        // echo $player."turn"."\n";
        if($i == 0){
            $nbr = 0;
            play($player,$nbr,$i);
        }

        while ($o <= $i) {
            echo "|";
            $o++;
        }
        echo "\n";

    if($player == "me"){

        echo "\n"."Your turn :"."\n";
        echo "Matches : ";

        $nbr = trim(fgets(STDIN));
        switch ($nbr) {
            case (1<=$nbr && $nbr <=3):
                if($i < 3){
                    if($i == 2 && $nbr == 3){
                        echo "Error : not enough matches"."\n";
                        turn($player,$nbr, $i);
                        break;
                    }
                    elseif($i == 1 && ($nbr == 3 OR $nbr == 2)){
                        echo "Error : not enough matches"."\n";
                        turn($player, $nbr,$i);
                        break;
                    }else{
                        play($player,$nbr, $i);
                        break;
                    }
                }else{
                    play($player,$nbr, $i);
                    break;
                }
            case($nbr>11):
                echo "Error : not enough matches"."\n";
                turn($player,$nbr, $i);
                break;
            default:
                echo "Error : invalid input (positive number expected)"."\n";
                turn($player,$nbr, $i);
                break;
        }

    }elseif($player == "ai"){
        
        $nbr = 0;
        play($player,$nbr, $i);
    }

}

function play($player,$nbr, $i){

    $i -= $nbr;
    // echo $player."play"."\n";
    switch (true) {

        case ($i == 0 && $player == "ai"):
            echo "You lost , too bad..."."\n"."\n";
            die;
        break;

        case ($i == 0 && $player == "me"):
            echo "I lost... snif... but I'll get you next time!!"."\n"."\n";
            die;
        break;

        default:
            if($player === "me"){
            
                $player ="ai";
                
                turn($player,$nbr,$i);
        
            }elseif($player === "ai"){
                
                $player ="me";
                $nbr = ia($i);
                $i -= $nbr;
        
                echo "\n"."AI's turn..."."\n";
                echo "AI  removed $nbr match(es)"."\n";
        
                turn($player,$nbr,$i);
            }
        break;
    }  
}

function ia($i){

    $nbr = $i%4;

    if($i == 2 OR $i == 1){
        $nbrA = 1;
    }else{
        $nbrA = 3;
    }

    switch ($nbr) {
        case 3:
            $nbrA = 2;
            break;
        case 2:
            $nbrA = 1;
            break;
    }
    return $nbrA;
}

function start(){

    $i =11;
    $nbr =0;
    $player = "me";

    turn($player,$nbr,$i);

}

start();

?>