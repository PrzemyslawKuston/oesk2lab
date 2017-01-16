<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>URI TEST</title>
</head>
<body>

<?php

    $fo=opendir("../gallery_URI");
    while($file=readdir($fo))
    {
        //echo $file;
     //   $data_uri = file_get_contents($file);

        if($file!="." && $file!=".." && $file!="Thumbs.db")
        {
            $content = file_get_contents('../gallery_URI/'.$file);
            echo "<img src='$content'/>&nbsp;&nbsp;&nbsp;&nbsp;";
}
}
?>
</body>
</html>