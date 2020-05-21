<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//start session
session_start();

//require autoload file
require_once('vendor/autoload.php');

//instantiate the F3 Base class
$f3 = Base::instance();

//default
$f3->route('GET /', function(){
    echo '<h1>Midterm Survey</h1>';
    echo '<a href="survey">Take my Midterm Survey</a>';
});

//survey
$f3->route('GET|POST /survey', function($f3) {

    $options = array('This midterm is easy', 'I like midterms', 'Today is Monday');

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        //validate data
        if (empty($_POST['name'])) {
            $f3->set('errors["name"]', "Please enter name");
        }
        if(empty($_POST['options'])){
            $f3->set('errors["option"]', "Please select option");
        }

        if(empty($f3->get('errors'))) {

            //store data in the session array
            $_SESSION['name'] = $_POST['name'];
            $_SESSION['option'] = $_POST['options'];

            //redirect to summary page
            $f3->reroute('summary');
        }
    }

    $f3->set('name', $_POST['name']);
    $f3->set('selectedOption', $_POST['options']);

    $f3->set('options', $options);

    $view = new Template();
    echo $view->render('views/survey.html');

});

//summary
$f3->route('GET /summary', function(){
    $view = new Template();
    echo $view->render('views/summary.html');
});
//run fat free
$f3->run();
