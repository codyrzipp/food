<?php
//this is our controller!

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file
require_once ('vendor/autoload.php');

//create an instance of the base class
$f3 = Base::instance();

//define a default route
$f3->route('GET /', function() {
    $view = new Template();
    echo $view -> render('views/home.html');
});

//define a breakfast route
$f3 -> route('GET /breakfast', function() {
    $view = new Template();
    echo $view -> render('views/breakfast.html');
});

//define a lunch route
$f3 -> route('GET /lunch', function() {
    $view = new Template();
    echo $view -> render('views/lunch.html');
});

//define a order route
$f3 -> route('GET /order', function() {
    $view = new Template();
    echo $view -> render('views/form1.html');
});
//define a route that accepts a food parameter
$f3 -> route('GET /@item', function($f3, $params) {
//    var_dump($params);
    $item = $params['item'];
    echo "<p>You ordered $item</p>";

    $foodsWeServe = array("tacos", "pizza", "ice cream");
    if(!in_array($item, $foodsWeServe)) {
        echo "<p>Sorry... we dont serve $item</p>";
    }

    switch ($item) {
        case 'tacos':
            echo "<p>We serve tacos on tuesdays</p>";
            break;
        case 'pizza':
            echo "<p>Pepperoni or veggie</p>";
            break;
        case 'ice cream':
            $f3 -> reroute("/breakfast");
        default:
            $f3 -> error(404);
    }

});
//run fat free
$f3 -> run();