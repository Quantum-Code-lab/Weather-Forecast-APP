<?php
    $status="";
    $msg="";
    if(isset($_POST["submit"]))
    {
        $city=$_POST["city"];

        $api_key="http://api.openweathermap.org/data/2.5/weather?q=$city&appid=1923839bd68a2a93fd04e7e9dba0d752";
        $amir=curl_init();
        curl_setopt($amir,CURLOPT_URL,$api_key);
        curl_setopt($amir,CURLOPT_RETURNTRANSFER,true);
        $result=curl_exec($amir); 
        curl_close($amir);
        $result=json_decode($result,true);
        if($result['cod']==200)
        {
            $status="ok";
        }
        else
        {
            $msg="Inavlaid City Could Not Found";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="include/css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
</head>

<body style="background-image: url(media/32.jpg);background-position: center;background-repeat: no-repeat;background-size: cover;">
        <div class="overlay"></div>
        <?php if($status=="ok"){?>

            <div class="weather-card" data-aos="fade-right">
                <img src="media/Cloud.png" alt="Cloud" class="cloud">
                <img src="media/sun228.png" alt="sun" class="sun">

                <span class="condition">
                    <?php
                        echo $result ['weather'] [0] ['main'];
                    ?>
                </span>
                <span class="temperature">
                    <?php
                        echo round($result ['main'] ['temp']-273);
                    ?>
                    <sup>&#9900</sup>                   
                </span>
                <span class="temp_fells" data-aos="fade-down-right">
                    <?php
                        echo "Feels Like ".round($result ['main'] ['feels_like']-273);
                    ?>
                    <sup>&#9900</sup>                   
                </span>
                <span class="temp_min_max" data-aos="fade-down-left">
                    <?php
                        echo "Min:Temp ".round($result ['main'] ['temp_min']-273);
                    ?>
                    <sup>&#9900</sup>               
                </span>
            </div>
            <div class="card-footer" data-aos="fade-left">
                <span class="cf">
                    <?date_default_timezone_set('Asia/dhaka');?>
                    <?php 
                        echo $result['name']."<br>";
                        echo date('d l')."<br>";
                        $time=time();
                        echo date('h:i: A',$time+14400);
                    ?>
                </span>
                <span class="cf">
                    <p>Humidity</p>
                    <?php
                        echo $result ['main'] ['humidity']."<br>";
                        echo "Atm:pressure<br>".$result ['main'] ['pressure']." Hpa<br>";
                    ?>
                </span>
                <span class="cf">
                    <p>Wind Speed</p>
                    <?php
                        echo $result ['wind'] ['speed']." M/s<br>";
                        echo "Cloudness <br>".$result ['clouds'] ['all']." %<br>";

                    ?>
                </span>
            </div>
        <?php } ?>

        <form method="post">
            <input type="text" class="city" placeholder="Enter Your City" name="city">
            <input type="submit" name="submit" value="Submit">
        </form>
        <div class="message">
            <?php echo $msg;?>
        </div>
        <footer class="end">
            <p>All&copy;Right Reserved By Amir Hossain Khalifa ||</p><br><p>&copy2021</p>
        </footer>
    <script src="include/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init({duration: 1000,});
    </script>
</body>

</html>