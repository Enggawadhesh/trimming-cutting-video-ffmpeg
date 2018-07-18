<?php

// Cutting or Triming Video

if (isset($_POST["cut"])) {
    $file  = $_POST['videofile'];
    // $filerenm = 'trimmed.mp4'; // Un-comment if rename same video
    $filerenm = 'trimvid/trimmed.mp4'; // Comment if rename same video
    $cuts  = $_POST['stime'];
    $cute  = $_POST['etime'];
    exec("ffmpeg -i $file -ss $cuts -to $cute  -c copy $filerenm");
    // rename($filerenm, $file);
    
    echo "Trim complected";
}