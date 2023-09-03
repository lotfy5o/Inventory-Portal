<?php

function validate($input){
    // wipeout the spaces
    $input = trim($input);
    // to avoid the slashes
    $input = stripcslashes($input);
    // to ignore the html tags and never implement them
    $input = htmlspecialchars($input);
    return $input;
}