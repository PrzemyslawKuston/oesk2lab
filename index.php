<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>ABC</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    </head>
    <body>

     <!-- Add your site or application content here -->
        <p>Projekt zaliczewniowy z OESK, Przemysław Kustoń i Dawid Głośny</p>
<table width="744" border="1">
    <tr><th height="41" scope="row">
            <a href="index.php?option=upload" style="margin-left:100px">Upload Image</a>
            <a href="index.php?option=gallery" style="margin-left:10px">Image gallery</a>
        </th></tr>
    <tr>
        <th height="401" scope="row">
            <?php
            @$gall=$_GET['option'];
                switch ($gall)
                {
                    case 'upload':
                        include ('upload.php');
                        break;
                    case 'gallery':
                        include ('gallery.php');
                        break;
                }

            ?>
        </th>
    </tr>
</table>


        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
