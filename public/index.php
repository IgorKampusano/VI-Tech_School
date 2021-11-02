<?php
namespace App;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ExceptionInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

ini_set('display_errors', 1);

require_once '../vendor/autoload.php';

//$routes = new RouteCollection();

//$routes->add('hello', new Route('/hello/{name}', [
//    'name' => 'World',
//    '_controller' => function ($request) {
//        extract($request->attributes->all(), EXTR_SKIP);
//        ob_start();
//        include sprintf('./page/%s.php', $_route);
//
//        return new Response(ob_get_clean());
//    },
//]));

//$routes->add('leap_year', new Routing\Route('/is_leap_year/{year}', [
//    'year' => null,
//    '_controller' => [new LeapYearController(), 'index'],
//]));

//function render_template(Request $request)
//{
//    extract($request->attributes->all(), EXTR_SKIP);
//    ob_start();
//    include sprintf('./page/%s.php', $_route);
//
//    return new Response(ob_get_clean());
//}

$request = Request::createFromGlobals();
$routes = include __DIR__ . '/page/app.php';

$context = new RequestContext();
$context->fromRequest($request);
$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Simplex\Framework($matcher, $controllerResolver, $argumentResolver);
$response = $framework->handle($request);

//try {
//    $request->attributes->add($matcher->match($request->getPathInfo()));
//    $controller = $controllerResolver->getController($request);
//    $arguments = $argumentResolver->getArguments($request, $controller);
//    $response = call_user_func($controller, $arguments);
//} catch (ResourceNotFoundException $exception) {
//    $response = new Response('Страница не существует', 404);
//} catch (\Exception $exception) {
//    $exception->getMessage();
//    $response = new Response('Ошибка на сервере', 500);
//}

$response->send();










