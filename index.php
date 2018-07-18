<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Upload file with percent progess bar</title>
  <link rel="stylesheet" href="">
  <style>
    body {
      width: 75%;
      margin: 50px auto;
    }
  </style>
</head>
<body> 
  <form enctype="multipart/form-data" method="post" action="upload.php">
    Choose your file here:
    <input name="uploaded_file" type="file"/><br /><br />
    <input type="submit" value="Upload It"/>
  </form>
</body>
</html>