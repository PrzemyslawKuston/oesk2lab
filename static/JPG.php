<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>JPG TEST</title>
</head>
<body>

<?php

    $fo=opendir("../gallery_JPG");
    while($file=readdir($fo))
    {
        //echo $file;

        if($file!="." && $file!=".." && $file!="Thumbs.db")
        {
            echo "<img src='../gallery_JPG/$file'/>&nbsp;&nbsp;&nbsp;&nbsp;";
}
}
?>
</body>
</html>