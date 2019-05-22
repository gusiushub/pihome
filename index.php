<?php
include __DIR__.'/vendor/autoload.php';
use PiPHP\GPIO\GPIO;
use PiPHP\GPIO\Pin\PinInterface;



function pinOutOn($pin){
    exec('gpio mode 1 out');
    exec('gpio write 1 1');
    echo 'вкл';
}

function pinOutOff($pin){
    exec('gpio write 1 0');
    echo 'выкл';
}
if (isset($_POST['ledOn'])){
    pinOutOn(1);
}

if (isset($_POST['ledOff'])){
    pinOutOff(1);
}
if (isset($_POST['hc'])){
    exec('python /var/www/html/hc.py',$hcOut);
    sleep(5);
    var_dump($hcOut);
}

if (isset($_POST['temp'])){
    exec('cat /sys/bus/w1/devices/28-02039245b780/w1_slave',$tempOut);
//    var_dump($tempOut);
    if(isset($tempOut[1])) {
        $temp = explode('=',$tempOut[1])[1]/1000    ;
       echo '<h3>'.$temp.'</h3>';
    }
}

if (isset($_POST['scan'])){
    exec('gpio readall',$output);
//    foreach ($output as $line){
//
//        print_r($line);
////        echo '<br>';
//    }
    print_r($output);
}
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Умный дом</title>
</head>
<body>
<div class="container">
    <div class="col-lg-12">
        <h1>Панель управления</h1>
        <form method="post" action="">
            <input name="temp" type="submit" class="btn btn-primary" value="температура">
            <input name="hc" type="submit" class="btn btn-primary" value="hc">
            <input name="ledOn" type="submit" class="btn btn-primary" value="on">
            <input name="ledOff" type="submit" class="btn btn-primary" value="off">
            <input name="scan" type="submit" class="btn btn-primary" value="scan gpio">
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


