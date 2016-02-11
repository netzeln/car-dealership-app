<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();
    if(empty($_SESSION['list_of_cars'])){
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'

    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('home_page.html.twig');
    });

    $app->post("/new_car", function() use ($app){
        $newCar = new Car($_POST['make_model'], $_POST['asking_price'], $_POST['mileage'], NULL);
        $newCar->saveCar();

        return $app['twig']->render('new_car.html.twig', array('postCar' => $newCar));

    });

    $app->post("/view_cars", function() use ($app) {

        // $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/911.jpg");
        // $ford = new Car("2011 Ford F450", 55995, 14241, "img/f450.jpg");
        // $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "img/rx350.jpg");
        // $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "img/cls550.jpg");
        //
        // $cars = array($porsche, $ford, $lexus, $mercedes);
        // $cars_matching_search = array();
        // foreach ($cars as $car) {
        //     if ($car->worthBuying($_POST["price"], $_POST["mileage"])) {
        //         array_push($cars_matching_search, $car);
        //     }
        // }



        return $app['twig']->render('view_cars.html.twig');
    });

    return $app;
?>
