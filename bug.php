<?php

namespace App;

use App\Controller\ExampleController;
use Symfony\Bundle\FrameworkBundle\Console\Descriptor\TextDescriptor;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\HttpKernel\Debug\FileLinkFormatter;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

require __DIR__ . '/vendor/autoload.php';

$fileLinkFormatter = new FileLinkFormatter();
$descriptor = new TextDescriptor($fileLinkFormatter);
$output = new ConsoleOutput();

// ------------------------------- Describing a route containing a string _controller works

$routes = new RouteCollection();
$routes->add('foo_a', new Route(
    '/foo/a',
    [
        '_controller' => 'App\Controller\ExampleController::foo'
    ]
));

$descriptor->describe($output, $routes);

// -------------------------------  Using an array throws an exception

$routes = new RouteCollection();
$routes->add('foo_b', new Route(
    '/foo/b',
    [
        '_controller' => [ ExampleController::class, 'foo' ]
    ]
));

$descriptor->describe($output, $routes);