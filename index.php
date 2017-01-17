<!doctype html>
<html class="no-js" lang="pl">
    <head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>PK & DG</title>

        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->
		<!-- Bootstrap Core CSS -->
		<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

		<!-- Custom Fonts -->
		<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

		<!-- Plugin CSS -->
		<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

		<!-- Theme CSS -->
		<link href="css/creative.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
		

<script type="text/javascript" src="http://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="http://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript">
    window.onload = function() {
        var dataPoints = [];
 
function getDataPointsFromCSV(csv) {
    var dataPoints = csvLines = points = [];
    csvLines = csv.split(/[\r?\n|\r|\n]+/);
        
    for (var i = 0; i < csvLines.length; i++)
        if (csvLines[i].length > 0) {
            points = csvLines[i].split(",");
            dataPoints.push({ 
                x: parseFloat(points[0]), 
                y: parseFloat(points[1]) 		
	    });
	}
    return dataPoints;
}
	 
	$.get("/oesk2lab/gallery_JPG/jpg.csv", function(data) {
		var chart = new CanvasJS.Chart("chartContainer", {
			animationEnabled: true,
			backgroundColor: null,
			title: {
			text: "JPG",
			},
			data: [{
			type: "column",
			dataPoints: getDataPointsFromCSV(data)
		}]
		});
			
		chart.render();
	});

    $.get("/oesk2lab/gallery_svg/svg.csv", function(data) {
        var chart2 = new CanvasJS.Chart("chartContainer2", {
            animationEnabled: true,
            backgroundColor: null,
            title: {
                text: "SVG",
            },
            data: [{
                type: "column",
                dataPoints: getDataPointsFromCSV(data)
            }]
        });

        chart2.render();
    });

    $.get("/oesk2lab/gallery_URI/uri.csv", function(data) {
        var chart3 = new CanvasJS.Chart("chartContainer3", {
            animationEnabled: true,
            backgroundColor: null,
            title: {
                text: "URI",
            },
            data: [{
                type: "column",
                dataPoints: getDataPointsFromCSV(data)
            }]
        });

        chart3.render();
    });
    }
	</script>
    </head>
   <body id="page-top" class="bcg1">
			    
	<section id="services">
        <div class="container">
            <div class="row">
			<div class="col-lg-12 text-center">
                <p>Projekt zaliczeniowy OESK - Przemysław Kustoń, Dawid Głośny</p>
				<a href="index.php?option=upload" class="btn btn-primary btn-xl page-scroll">Testy i pomiary</a>
				<a href="index.php?option=gallery" class="btn btn-primary btn-xl page-scroll">Galeria</a>
			 </div>	
			
                <div class="col-lg-7 text-left">
                    <h2 class="section-heading">&nbsp</h2>
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
			 <h2 class="section-heading">&nbsp</h2>
                </div>
                <div class="col-lg-5 text-center">
                    <h2 class="section-heading">&nbsp</h2>
                    <p>Podgląd stron testowych</p>
                    <div class="col-lg-4 text-center"><a href="static/JPG.php">JPG</a></div>
                    <div class="col-lg-4 text-center"><a href="static/SVG.php">SVG</a></div>
                    <div class="col-lg-4 text-center"><a href="static/URI.php">URI</a></div>
                </div>
				<div class="col-lg-12 text-center">
                    <h2 class="section-heading">&nbsp</h2>
                    <p>Wyniki</p>
                    <div class="col-lg-4 text-center">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                    </div>
                        <div class="col-lg-4 text-center">
                    <div id="chartContainer2" style="height: 300px; width: 100%;"></div>
                        </div>
                            <div class="col-lg-4 text-center">
                    <div id="chartContainer3" style="height: 300px; width: 100%;"></div>
                            </div>
                </div>
            </div>
        </div>
    </section>

        <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.12.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
