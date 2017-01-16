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

    //    $imageData = base64_encode(file_get_contents($src_file_name));
        $info = pathinfo($src_file_name);
        $file_name =  basename($src_file_name,'.'.$info['extension']);

        if (in_array($ext, $supported_image))
        {
            move_uploaded_file($_FILES['file']['tmp_name'], "gallery/".$_FILES['file']['name']);
            copy("gallery/".$_FILES['file']['name'],"gallery_JPG/".$_FILES['file']['name']);
            echo " Zdjęcie załadowane do galerii rastrowej";
            echo "<hr>";
            exec("java -jar ImageTracer.jar gallery/$src_file_name outfilename gallery_SVG/$file_name.svg");
            echo " Zdjęcie przekonwertowane na SVG";

            echo "<hr>";
            $img_string = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents("gallery/".$_FILES['file']['name']));
            echo " Zdjęcie przekonwertowane do dataURI";
            echo "<hr>";
            file_put_contents("gallery_URI/".$file_name.".txt",$img_string);
            $data_uri = file_get_contents('gallery_URI/'.$file_name.".txt", FILE_USE_INCLUDE_PATH);


        }
            else{
            echo "<font color='red'>please choose a valid image</font>";
            }
    }

    $jpg = exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/JPG.php');
    $svg = exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/SVG.php');
    $uri = exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/URI.php');

    $enter = "\n";
// otwarcie pliku do odczytu
    $fp = fopen("gallery_JPG/wyniki_jpg.txt", "r");
//odczytanie danych
    $stareDane = fread($fp, filesize("gallery_JPG/wyniki_jpg.txt"));
// zamknięcie pliku
    fclose($fp);
// stworzenie nowych danych
//    $stareDane .= $enter;
    $jpg .= $enter;
    $jpg .= $stareDane;
// otwarcie pliku do zapisu
    $fp = fopen("gallery_JPG/wyniki_jpg.txt", "w");
// zapisanie danych
    fputs($fp, $jpg);
// zamknięcie pliku
    fclose($fp);

// otwarcie pliku do odczytu
    $fp = fopen("gallery_SVG/wyniki_svg.txt", "r");
//odczytanie danych
    $stareDane = fread($fp, filesize("gallery_SVG/wyniki_svg.txt"));
// zamknięcie pliku
    fclose($fp);
// stworzenie nowych danych
    $svg .= $stareDane;
// otwarcie pliku do zapisu
    $fp = fopen("gallery_SVG/wyniki_svg.txt", "w");
// zapisanie danych
    fputs($fp, $svg);
// zamknięcie pliku
    fclose($fp);

// otwarcie pliku do odczytu
    $fp = fopen("gallery_URI/wyniki_uri.txt", "r");
//odczytanie danych
    $stareDane = fread($fp, filesize("gallery_URI/wyniki_uri.txt"));
// zamknięcie pliku
    fclose($fp);
// stworzenie nowych danych
    $uri .= $stareDane;

// otwarcie pliku do zapisu
    $fp = fopen("gallery_URI/wyniki_uri.txt", "w");
// zapisanie danych
    fputs($fp, $uri);
// zamknięcie pliku
    fclose($fp);


    echo "<hr>";
    echo " Pomiary stron:";
    echo " JPG: ";
    echo exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/JPG.php');
    echo "<hr>";
    echo " SVG: ";
    echo exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/SVG.php');
    echo "<hr>";
    echo " dataURI: ";
    echo exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/URI.php');
}



if ($data = fopen("gallery_JPG/wyniki_jpg.txt", "r")) {
    while(!feof($data)) {
        echo "<hr>";
        echo "<hr>";
        $line = fgets($data);
        $whatIWant = substr($line, strpos($line, "Loading time ") + 13);
        echo $whatIWant;
    }
    fclose($data);
}


?>

<form method="post" enctype="multipart/form-data">
    Wybierz obraz<input type="file" name="file" /><hr><br/>
    <input type="submit" value="Załaduj" name="upd"/>
</form>
