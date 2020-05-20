<?php

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

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

    $f3->set('options', $options);

    $view = new Template();
    echo $view->render('views/survey.html');

});
//run fat free
$f3->run();
