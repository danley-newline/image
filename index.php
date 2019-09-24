<?php
$msg = "";
include('db.php');
    if (isset($_POST['upload'])) {
       //store image uploaded
       $target = "images/".basename($_FILES['image']['name']);

       $db = mysqli_connect('localhost','root','  haz','photo');

       //image submit
       $image = $_FILES['image']['name'];
       $text = $_POST['text'];

       $sql ="INSERT INTO images (image,text) VALUES ('$image','$text')";
       mysqli_query($db,$sql);

       if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
           $msg = "données envoyé";
       }else {
           $msg = "probleme lors de l'envoi";
       }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>text</title>
</head>
<body>
<?php
       $db = mysqli_connect('localhost','root','  haz','photo');
    $sql = "SELECT * FROM images";
    $result = mysqli_query($db,$sql);
    while ($row = mysqli_fetch_array($result)) {
     echo "<div >";
     echo "<img src='".$row['image']."'>";
    echo "<p>".$row['text']."</p>";
     echo "</div>";
    }
?>
    <form method="POST" action="index.php" enctype="multipart/form-data">
    <input type="hidden" name="size" value="1000000">
        <div>
            <input type="file" name="image">
        </div>
        <div>
            <textarea name="text" cols="40" rows="4"></textarea>
        </div>
        <div>
            <input type="submit" name="upload" value="upload image">
        </div>
    </form>
    
</body>
</html>
