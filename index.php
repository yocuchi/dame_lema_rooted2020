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


?>
<html>
	<head>
		<link href="https://fonts.googleapis.com/css?family=Tomorrow&display=swap" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script>
			$(document).ready(function(){
				$( ".boton" ).click(function() {
					$( ".boton" ).fadeOut("slow");
					var image = Math.floor(Math.random()*4)+1;
					if(image==1){
						$( ".resultado" ).css("background","url(https://images.pexels.com/photos/32237/pexels-photo.jpg)");
					}else if(image==2){
						$( ".resultado" ).css("background","url(https://images.pexels.com/photos/169647/pexels-photo-169647.jpeg)");
					}else if(image==3){
						$( ".resultado" ).css("background","url(https://images.pexels.com/photos/1434608/pexels-photo-1434608.jpeg)");
					}else if(image==4){
						$( ".resultado" ).css("background","url(https://3.bp.blogspot.com/-auaLS9Hlre8/VZLCd85ycGI/AAAAAAAABYI/Efqt7Zvx-OM/s1600/YRBRRRI.png)");
					}
					
					$( ".resultado" ).delay(800).fadeIn(2000);
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
				padding: 35px;
				font-weight: 600;
				font-size: 28px;
				color: #ffffff;
				background-color: #1883ba;
				border-radius: 6px;
				border: 2px solid #0016b0;
				font-family: 'Tomorrow', sans-serif;
			}

			.boton{
				    margin-top: 21%;
			}
			
			 a:hover{
				color: #1883ba;
				background-color: #ffffff;
				
			 }
			.frase{
				padding-top: 18%;
				font-family: 'Tomorrow', sans-serif;
				color:white;
				font-size:80px;
			}
			.frase div{
				width: 100%;
				background-color: rgba(0, 0, 0, 0.6);
				
			}
			.resultado{
				display:none;
				//background:url(https://images.pexels.com/photos/32237/pexels-photo.jpg);
				background-size:100% 100% !important;
				width:100% !important;
				height:100% !important;
			}
		
			   
		</style>
	</head>
	<body>
		<div class="resultado">
			<div class="frase">
			<div><b><?=$msg ?></b></div>
		</div>
		</div>
		<div class="boton"><a href="#">Pulsa aquÃ­ ðŸ˜‰</a></div>
	</body>
</html>
