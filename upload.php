<?php
if(isset($_POST['upd']))
{
    if(file_exists("gallery/".$_FILES['file']['name']))
    {
        echo "<font color='red'>".$_FILES['file']['name']." already exists</font>";
    }
    else{
        $supported_image = array('jpg', 'jpeg', 'png', 'bmp', 'svg');

        $src_file_name = $_FILES['file']['name'];
        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION));

        if (in_array($ext, $supported_image))
        {
            move_uploaded_file($_FILES['file']['tmp_name'], "gallery/".$_FILES['file']['name']);
            echo $_FILES['file']['name']." image uploaded";
        }
            else{
            echo "<font color='red'>please choose a valid image</font>";
            }
    }
}
?>

<form method="post" enctype="multipart/form-data">
    choose your image<input type="file" name="file" /><br/>
    <input type="submit" value="upload image" name="upd"/>
</form>
