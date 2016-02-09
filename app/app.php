<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    $app = new Silex\Application();

    $app->get("/", function() {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css' integrity='sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7' crossorigin='anonymous'>
            <title>Find A Car</title>
        </head>
        <body>
            <div class='container'>
            <h1>Find a Car!</h1>
                <form action='/view_cars'>
                    <div class='form-group'>
                        <label for='price'>Enter Maximum Price:</label>
                        <input id='price' name='price' class='form-control' type='number'>
                        <label for='mileage'>Enter Maximum Mileage:</label>
                        <input id='mileage' name='mileage' class='form-control' type='number'>
                    </div>
                    <button type='submit' class='btn-success'>Submit</button>
                </form>
            </div>
        </body>
        </html>
        ";
    });

    $app->get("/view_cars", function() {

        $porsche = new Car("2014 Porsche 911", 114991, 7864, "img/911.jpg");
        $ford = new Car("2011 Ford F450", 55995, 14241, "img/f450.jpg");
        $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "img/rx350.jpg");
        $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "img/cls550.jpg");
        $cars = array($porsche, $ford, $lexus, $mercedes);
        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ($car->worthBuying($_GET["price"], $_GET["mileage"])) {
                array_push($cars_matching_search, $car);
            }
        }

        $car_list = "";
        if (!empty($cars_matching_search)) {
            foreach ($cars_matching_search as $car) {
                $car_list = $car_list . "<img src='" . $car->getImage() . "'>
                            <p>" . $car->getMakeModel() . "</p>
                            <ul>
                                <li>$" . $car->getPrice() . "</li>
                                <li>" . $car->getMileage() . "</li>
                            </ul>";
            }
        } else {
            return "<h1>There are no cars to show</h1>";
        }
        return $car_list;
    });

    return $app;
?>
