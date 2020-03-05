<?php

require_once('TwitterAPIExchange.php');


/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
include("config.php");
$url = "https://api.twitter.com/1.1/search/tweets.json";

$requestMethod = "GET";

$getfield = '?include_entities=true&q=#123improtaapp&tweet_mode=extended';


$twitter = new TwitterAPIExchange($settings);
$string = json_decode($twitter->setGetfield($getfield)
             ->buildOauth($url, $requestMethod)
	     ->performRequest(),$assoc = TRUE);

if(array_key_exists("errors", $string)) {echo "<h3>Sorry, there was a problem.</h3><p>Twitter returned the following error message:</p><p><em>".$string[errors][0]["message"]."</em></p>";exit();}


//var_dump($string);
$hits=array();
foreach($string["statuses"] as $items)
    {
	//echo "<h1>ITEM</h1>";    
	//echo $items['created_at']."<br />";
	$hit=str_replace("#123improtaapp","",$items['full_text']);
	//echo $hit. "<br/>";
	array_push($hits,$hit);
	//var_dump($string);
    }

//vamos a por la frase
$array_nombres = array("Gañán", "Pataliebre", "Tolai", "pequeño saltamontes", "hacker de gameboys");
$s=array_rand($hits,2);
$msg="Recuerda ". $array_nombres[(array_rand($array_nombres))] . ",<br/>  " . $hits[$s[0]] . " no es un " . $hits[$s[1]];
$msg="Recuerda ". $array_nombres[(array_rand($array_nombres))] . ",<br/>  " . htmlspecialchars($hits[$s[0]]) . " no es un " . htmlspecialchars($hits[$s[1]]);


//$msg=htmlspecialchars($msg);

?>

<html>
	<head>
		<link href="http://fonts.googleapis.com/css?family=Tomorrow&display=swap" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./css/style.css" />
        <link rel="stylesheet" type="text/css" href="./css/font-awesome.css" />
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			
			$(document).ready(function(){
				function imgRand(pulsado) {
					if(pulsado==1){
					$( ".boton" ).fadeOut();
						$( ".resultado" ).fadeIn(1300);
					}else{
						$( ".boton" ).fadeOut(1500);
						$( ".resultado" ).delay(1600).fadeIn(2000);
					}
					var image = Math.floor(Math.random()*7)+1;
					if(image==1){
						$( ".resultado" ).css("background","url(img/Stars.jpg)");
					}else if(image==2){
						$( ".resultado" ).css("background","url(img/pexels-photo-169647.jpeg)");
					}else if(image==3){
						$( ".resultado" ).css("background","url(img/pexels-photo-1434608.jpeg)");
					}else if(image==4){
						$( ".resultado" ).css("background","url(img/YRBRRRI.png)");
					}else if(image==5){
						$( ".resultado" ).css("background","url(img/06bc1bbd29c978e2a3ca5a4ab73d9dc7.jpg)");
					}else if(image==6){
						$( ".resultado" ).css("background","url(img/1518607998_924815_1518608760_noticia_normal.jpg)");
					}else if(image==7){
						$( ".resultado" ).css("background","url(img/k2_46924cb7_1500x978.jpg)");
					}
					
					
			
				};
				
				if(window.location=='index.php?pulsado=1'){
					imgRand(1);
				}
				
				$( ".boton" ).click(function() {
					imgRand(0);
				});
				$( ".frase div" ).click(function() {
					$(location).attr('href','index.php?pulsado=1');
				});
			
			});
		</script>
		<style>
			body{
				
				margin:0px;
				text-align:center;
				
			}
			a{
				text-decoration: none;
				//padding: 35px;
				font-weight: 600;
				font-size: 28px;
				//color: #ffffff;
				//background-color: #1883ba;
				//border-radius: 6px;
				//border: 2px solid #0016b0;
				font-family: 'Tomorrow', sans-serif;
			}
			a img{
				width: 86%;
				margin-top: 7%;
			}

			.boton{
				    margin-top: 260px;
			}
			
			 a:hover{
				color: #1883ba;
				background-color: #ffffff;
				
			 }
			.frase{
				padding-top: 17%;
				font-family: 'Tomorrow', sans-serif;
				color:white;
				font-size:80px;
			}
			.frase div{
				width: 100%;
				background-color: rgba(0, 0, 0, 0.6);
				padding-top: 2%;
				padding-bottom: 2%;
				
			}
			.resultado{
				display:none;
				background-size:100% 100% !important;
				width:100% !important;
				height:100% !important;
			}
		
			   
		</style>
	</head>
	<body>
		<div class="resultado">
			<div class="frase">
				<div><b>

<?=$msg ?>
</b></div>
		</div>
		</div>
		<div class="boton"><a href="#"><div class="switch demo4">
					<input type="checkbox">
					<label><img src="img/nuke.png"/></label>
				</div></a></div>
	</body>
