<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
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
     <form class="form-horizontal" id="img2b64">
         <h2>Input</h2>
         <div class="form-group">
             <label class="col-sm-2 control-label">Convert via:</label>
             <div class="col-sm-10">
                 <select class="form-control" name="convertType">
                     <option value="Canvas" selected>Canvas</option>
                     <option value="FileReader">FileReader</option>
                 </select>
             </div>
         </div>
         <div class="form-group">
             <label class="col-sm-2 control-label">URL:</label>
             <div class="col-sm-10">
                 <input type="url" name="url" class="form-control" placeholder="Insert an IMAGE-URL" value="http://localhost/oesk2lab/gallery/it.jpg" required />
             </div>
         </div>
         <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
                 <input type="submit" class="btn btn-default">
             </div>
         </div>
     </form>

     <div class="output form-horizontal" style="display: none">
         <hr>
         <h2>Output</h2>
         <div>
             <strong class="col-sm-2 text-right">Converted via:</strong>
             <div class="col-sm-10">
                 <span class="convertType"></span>
             </div>
         </div>
         <div>
             <strong class="col-sm-2 text-right">Size:</strong>
             <div class="col-sm-10">
                 <span class="size"></span>
             </div>
         </div>
         <div>
             <strong class="col-sm-2 text-right">Text:</strong>
             <div class="col-sm-10">
                 <textarea class="form-control textbox"></textarea>
             </div>
         </div>
         <div>
             <strong class="col-sm-2 text-right">Link:</strong>
             <div class="col-sm-10">
                 <a href="#" class="link"></a>
             </div>
         </div>
         <div>
             <strong class="col-sm-2 text-right">Image:</strong>
             <div class="col-sm-10">
                 <img class="img">
             </div>
         </div>
     </div>

















        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
