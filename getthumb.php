<?php

// Thumbnail Generator
if (isset($_POST["thumb"])) {

	$ffmpeg = '/ffmpeg/bin/';
	$image = 'thumb/image.jpg';;
	$size = '320x240';

	$video = $_POST['videofile'];
	$interval  = $_POST['ttime'];

	// Only thumb
	shell_exec("ffmpeg -i $video -deinterlace -an -ss $interval -f mjpeg -t 1 -r 1 -y -s $size $image 2>&1");
}

echo 'Thumb created';
?>
<br>
<img src="<?php echo $image; ?>" alt="">