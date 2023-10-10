<?php


function errorMessage($msg){
    echo "<div class='container col-4 offset-4'>";
        echo "<p class='text-center alert alert-danger'>$msg</p>";
    echo "</div>";
}

function successMessage($msg){
    echo "<div class='container col-4 offset-4'>";
        echo "<p class='text-center alert alert-success'>$msg</p>";
    echo "</div>";
}

?>