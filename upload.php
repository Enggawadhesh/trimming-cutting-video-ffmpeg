<?php
	if(is_uploaded_file($_FILES['uploaded_file']['tmp_name'])) {
		$sourcePath = $_FILES['uploaded_file']['tmp_name'];
		$targetPath = "temp/".$_FILES['uploaded_file']['name'];
			if(move_uploaded_file($sourcePath,$targetPath)) { 
				?>
				<div>
    		        <video id="vid" autoplay="" loop="" style="margin-top: -8px; margin-left: -8px;">
    		        <source src="<?php echo $targetPath; ?>" type="video/mp4">
    		        </video>
    		    </div>
				<?php
			}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="cache-control" content="no-cache" />
	<title>Video Thumb</title>
	<link rel="stylesheet" href="">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <br><br>	
    <form method="post" action="getthumb.php" enctype="multipart/form-data">
        <div class="input-group">
        <input type="hidden" name="videofile" id="videofile" value="<?php echo $targetPath; ?>">
        <input class="form-control" type="text" name="ttime" id="ttile">
            
            <span class="input-group-btn">
                <input class="btn btn-primary" type="submit" name="thumb" id="thumb" value="Generate Thumb">
            </span>
            <span> Pause video and click Generate Thumb</span>
        </div>
    </form>

	<button class="btn btn-primary" onclick="ply()">Play</button>
    <button class="btn btn-primary" onclick="pus()">Pause</button>
    <button class="btn btn-primary" onclick="show()">Show Controls</button>
    
    <br><br><br>

    <div class="row">
        <form method="post" action="trim_video.php" enctype="multipart/form-data">
            <?php 
                $fileo = $targetPath;
                $time = exec("ffmpeg -i $fileo 2>&1 | 
                grep Duration | cut -d ' ' -f 4 | sed s/,//");
            ?>
            <div class="col-md-6">
                <lable>Start Time : </lable><input class="form-control" type="text" name="stime" id="starttime" value="00:00:00" placeholder="HH:MM:SS" required><br><br>
                <lable>End Time : </lable><input class="form-control" type="text" name="etime" id="endtime" value="<?php echo $time; ?>" placeholder="HH:MM:SS" required><br>
            </div>
            <br>
            <div>
                <input type="hidden" name="videofile" id="videofile" value="<?php echo $targetPath; ?>">
                <input class="btn btn-primary" type="submit" name="cut" id="cut" value="Trim By Time">
            </div>
        </form>
        </div>

    <script>

        var myVideo = document.getElementById( 'vid' );
        function ply(){
            myVideo.play();
        }
        function pus(){
            myVideo.pause();
        }
        function show(){
            myVideo.setAttribute( 'controls', '' );
        }

        function fromSeconds(seconds, showHours) {
            if(showHours) {
                var hours = Math.floor(seconds / 3600),
                seconds = seconds - hours * 3600;
            }
            var minutes = ("0" + Math.floor(seconds/60)).slice(-2);
            var seconds = ("0" + parseInt(seconds%60,10)).slice(-2);

            if(showHours) {
                var timestring = hours + ":" + minutes + ":" + seconds;
            } else {
                var timestring = minutes + ":" + seconds;
            }
            return timestring;
        }
        
        var video = $('#vid');
        
        video.bind("timeupdate", function () {
            var stime = video[0].currentTime;
            stime = stime.toString();
            stime = stime.split(".").pop();
            stime = stime.substr(0,3);
            $('#starttime').html(stime);
            $('#endtime').html(video[0].currentTime);
            $('#ttile').val(fromSeconds(video[0].currentTime)+'.'+stime);
            // $('#remTime').html(fromSeconds(video[0].duration - video[0].currentTime));
            // $('#totalTime').html(fromSeconds(video[0].duration));
        });

    </script>

</body>
</html>

