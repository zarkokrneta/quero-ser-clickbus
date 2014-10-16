<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Zarko Krneta
 * Date: 10/16/14
 * Time: 13:00 PM
 * Cash machine problem solution
 */



function return_notes_for_withdrawal($withdraw_amount){
    //Defining available bank notes array
    $available_notes_arr= array(
        "R$ 50" => 50.00,
        "R$ 100" => 100.00,
        "R$ 20" => 20.00,
        "R$ 10" => 10.00
    );


    //Check for positive integer values
    if (!(is_int($withdraw_amount) && $withdraw_amount>0)){
        throw new Exception('InvalidArgumentException');
    }

    //Check for available notes
    $minimum_note=min($available_notes_arr);
    if (fmod($withdraw_amount, $minimum_note)>0){
        throw new Exception('NoteUnavailableException');
    }

    //Check if null
    if (is_null($withdraw_amount)){
        return array();
    }


    //Sort notes array
    arsort($available_notes_arr);

    //Finding array to return
    $return_arr=array();
    $reminder=$withdraw_amount;

    foreach($available_notes_arr as $banknote_key=>$banknote_value){
       
        $round_down=floor($reminder/$banknote_value);
        if ($round_down==0) continiue;
        for($i=1; $i<=$round_down; $i++){
            $return_arr[]=$banknote_value;
        }
        $reminder=fmod($reminder,$banknote_value);



    }
    return $return_arr;
}

print_r(return_notes_for_withdrawal(80));
