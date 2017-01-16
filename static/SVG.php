<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SVG TEST</title>
</head>
<body>

<?php

$fo=opendir("../gallery_SVG");
while($file=readdir($fo))
{
    //echo $file;

    if($file!="." && $file!=".." && $file!="Thumbs.db")
    {
        echo "<img src='../gallery_SVG/$file'/>&nbsp;&nbsp;&nbsp;&nbsp;";
    }
}
?>
</body>
</html>