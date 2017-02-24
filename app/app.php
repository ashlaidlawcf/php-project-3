<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";

    $app = new Silex\Application();

    $server = "mysql:host=localhost:8889;dbname=hair_salon";
    $username = "root";
    $password = "root";
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array("twig.path" => __DIR__."/../views"));

    $app->get("/", function() use ($app) {
        return $app["twig"]->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->post("/add_stylist", function() use ($app) {
        $new_stylist = new Stylist($id, $_POST["first_name"], $_POST["last_name"], $_POST["phone_number"]);
        $new_stylist->save();
        return $app["twig"]->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->post("/delete_all_stylists", function() use ($app) {
        Stylist::deleteAll();
        return $app["twig"]->render("index.html.twig", array("stylists" => Stylist::getAll()));
    });

    $app->get("/stylists/{id}", function($id) use ($app) {
        $new_stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylists' => $new_stylist, 'clients' => $new_stylist->getClients()));
    });

    return $app;
?>
