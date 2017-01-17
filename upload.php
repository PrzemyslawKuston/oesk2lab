<?php
if (isset($_POST['upd'])) {
    if (file_exists("gallery/" . $_FILES['file']['name'])) {
        echo "<font color='red'>" . $_FILES['file']['name'] . " Obraz był już dodany, przetestowałem obecne galerie</font>";
    } else {
        $supported_image = array('jpg', 'jpeg', 'png', 'bmp', 'svg');
        $src_file_name = $_FILES['file']['name'];
        $ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION));

        $info = pathinfo($src_file_name);
        $file_name = basename($src_file_name, '.' . $info['extension']);

        if (in_array($ext, $supported_image)) {
            move_uploaded_file($_FILES['file']['tmp_name'], "gallery/" . $_FILES['file']['name']);
            copy("gallery/" . $_FILES['file']['name'], "gallery_JPG/" . $_FILES['file']['name']);
            echo " Zdjęcie załadowane do galerii rastrowej";
            echo "<hr>";
            exec("java -jar ImageTracer.jar gallery/$src_file_name outfilename gallery_SVG/$file_name.svg");
            echo " Zdjęcie przekonwertowane na SVG";

            echo "<hr>";
            $img_string = 'data:image/' . $ext . ';base64,' . base64_encode(file_get_contents("gallery/" . $_FILES['file']['name']));
            echo " Zdjęcie przekonwertowane do dataURI";
            echo "<hr>";
            file_put_contents("gallery_URI/" . $file_name . ".txt", $img_string);
            $data_uri = file_get_contents('gallery_URI/' . $file_name . ".txt", FILE_USE_INCLUDE_PATH);
        } else {
            echo "<font color='red'>please choose a valid image</font>";
        }
    }

    $jpg = exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/JPG.php');
    $svg = exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/SVG.php');
    $uri = exec('phantomjs loadspeed.js http://localhost/oesk2lab/static/URI.php');

	$jpg_pomiar = $jpg;
	$svg_pomiar = $svg;
	$uri_pomiar = $uri;

    $enter = "\n";
    $fp = fopen("gallery_JPG/wyniki_jpg.txt", "r");
    $stareDane = fread($fp, filesize("gallery_JPG/wyniki_jpg.txt"));
    fclose($fp);
    $jpg .= $enter;
    $jpg .= $stareDane;
    $fp = fopen("gallery_JPG/wyniki_jpg.txt", "w");
    fputs($fp, $jpg);
    fclose($fp);

    $fp = fopen("gallery_SVG/wyniki_svg.txt", "r");
    $stareDane = fread($fp, filesize("gallery_SVG/wyniki_svg.txt"));
    fclose($fp);
    $svg .= $enter;
    $svg .= $stareDane;
    $fp = fopen("gallery_SVG/wyniki_svg.txt", "w");
    fputs($fp, $svg);
    fclose($fp);

    $fp = fopen("gallery_URI/wyniki_uri.txt", "r");
    $stareDane = fread($fp, filesize("gallery_URI/wyniki_uri.txt"));
    fclose($fp);
    $uri .= $enter;
    $uri .= $stareDane;
    $fp = fopen("gallery_URI/wyniki_uri.txt", "w");
    fputs($fp, $uri);
    fclose($fp);


    echo "<hr>";
    echo " Najnowszy pomiar:<br />";
    echo " JPG: ";
    echo $jpg_pomiar;
    echo "<br /> SVG: ";
    echo $svg_pomiar;
    echo "<br /> dataURI: ";
    echo $uri_pomiar;


    //TWORZENIE PLIKÓW CSV DLA WYKRESÓW - JPG
	$count = 1;
    $items = array();
	if ($data = fopen("gallery_JPG/wyniki_jpg.txt", "r")) {
        while (!feof($data)) {
            $line = fgets($data);
            $whatIWant = between('Loading time ', ' msec', $line);
            $items[] = $count.",".$whatIWant;
            $count++;
        }
	fclose($data);
	// print_r($items); wypisanie listy

        $file = fopen("gallery_jpg/jpg.csv","w");
        foreach ($items as $line)
        {
            fputcsv($file,explode(',',$line));
        }
        fclose($file);
    }

    //TWORZENIE PLIKÓW CSV DLA WYKRESÓW - SVG
    $count = 1;
    $items = array();
    if ($data = fopen("gallery_SVG/wyniki_svg.txt", "r")) {
        while (!feof($data)) {
            $line = fgets($data);
            $whatIWant = between('Loading time ', ' msec', $line);
            $items[] = $count.",".$whatIWant;
            $count++;
        }
        fclose($data);
      //   print_r($items); Wypisanie listy

        $file = fopen("gallery_svg/svg.csv","w");
        foreach ($items as $line)
        {
            fputcsv($file,explode(',',$line));
        }
        fclose($file);
    }

    //TWORZENIE PLIKÓW CSV DLA WYKRESÓW - JPG
    $count = 1;
    $items = array();
    if ($data = fopen("gallery_URI/wyniki_uri.txt", "r")) {
        while (!feof($data)) {
            $line = fgets($data);
            $whatIWant = between('Loading time ', ' msec', $line);
            $items[] = $count.",".$whatIWant;
            $count++;
        }
        fclose($data);
     //   print_r($items); Wypisanie listy

        $file = fopen("gallery_uri/uri.csv","w");
        foreach ($items as $line)
        {
            fputcsv($file,explode(',',$line));
        }
        fclose($file);
    }
}//KONIEC FUNKCJI NA GUZIK


  
echo "<hr>";
echo "<br />Wszystkie wyniki:";

if ($data = fopen("gallery_JPG/wyniki_jpg.txt", "r")) {
    echo "<br />JPG(ms) ";
    while (!feof($data)) {
        $line = fgets($data);
        $whatIWant = between('Loading time ', ' msec', $line);
        echo $whatIWant . "\n";
    }
    fclose($data);
}

if ($data = fopen("gallery_SVG/wyniki_svg.txt", "r")) {
    echo "<br />SVG(ms) ";
    while (!feof($data)) {
        $line = fgets($data);
        $whatIWant = between('Loading time ', ' msec', $line);
        echo $whatIWant . "\n";
    }
    fclose($data);
}

if ($data = fopen("gallery_URI/wyniki_uri.txt", "r")) {
    echo "<br />URI(ms) ";
    while (!feof($data)) {
        $line = fgets($data);
        $whatIWant = between('Loading time ', ' msec', $line);
        echo $whatIWant . "\n";
    }
    fclose($data);
}


//Zestaw funkcji wyciągających wyniki pomiarów z pliku txt
function after($this1, $inthat) {
    if (!is_bool(strpos($inthat, $this1)))
        return substr($inthat, strpos($inthat, $this1) + strlen($this1));
};

function before($this1, $inthat) {
    return substr($inthat, 0, strpos($inthat, $this1));
};

function between($this1, $that, $inthat) {
    return before($that, after($this1, $inthat));
};

?>

<form method="post" enctype="multipart/form-data"><br/>Wybierz obraz<input type="file" name="file" /><hr><br/>
    <input type="submit" class="btn btn-primary btn-xl page-scroll" value="Wykonaj test i zbierz wyniki" name="upd"/>
</form>
