<?php 
  error_reporting(E_ERROR | E_PARSE);
  $weather = "";

  $error = "";

  if (isset($_GET['city'])) {
    // получаем контент из API
  $urlContent = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.$_GET['city'].'&units=metric&appid=9c631b378f5d7edbafa16e965b02b9c8');

  $forcastArray = json_decode($urlContent, true); // через JSON переводим данные в массив

  if ($forcastArray['cod'] == 200) {
        $weather = 'The weather in '.$_GET['city'].' is'.$forcastArray['weather'][0]['description'];

        $weather = $weather.'. The temperature is '.$forcastArray['main']['temp'].'&#8451;'.'. The speed of wind is '.$forcastArray['wind']['speed'].' m/sec';
      } else {
        $error = "The city name is incorrect, please try another name";
      }
  }

?>

<!doctype html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css" >
 

    <title>WeatherAPP</title>
  </head>
  <body>
    <div class="Container" id="mainDiv">
        <h1>Weather In The City</h1>
        <form>
            <div class="form-group">
                <input type="text" class="form-control" name="city" id="city" aria-describedby="Forcast city" placeholder="Enter city name">
            </div>      
                <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>   

    <div id="forecastDiv">        
        <?php 
          if ($weather) {
              echo '<div class="alert alert-primary" role="alert">'.$weather.'</div>';
           } else if ($error) {
            echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
           }             
        ?>        
    </div>
    




    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>