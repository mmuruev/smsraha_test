<?php
use app\auth\UserProvider;
use app\env\Constants;
use Symfony\Component\HttpFoundation\Request;

require_once __DIR__ . '/security.php';


/**
 *  Registration Providers
 */
$app->register(new Silex\Provider\SecurityServiceProvider(), array(
    'security.firewalls' => array(
        'login' => array('pattern' => '^/login$'), // Example of an url available as anonymous user
        'default' => array(
            'pattern' => '^.*$',
            //'anonymous' => true, // Needed as the login path is under the secured area
            'form' => array('login_path' => '/login', 'check_path' => 'login_check'),
            'logout' => array('logout_path' => '/logout'), // url to call for logging out
            'users' => $app->share(function () use ($app) {
                    // Specific class App\User\UserProvider is described below
                    return new UserProvider($app['db']);
                }),
        ),
    ),
    'security.access_rules' => array(
        // Order is matter narrowest rules first!!!
        array('^/$', array(Constants::ROLE_USER)),
        array('^/.*$', Constants::ROLE_ADMIN)
    )
));

/**
 *  Apply all roles for admin user
 */
$app['security.role_hierarchy'] = array(
    Constants::ROLE_ADMIN => array(Constants::ROLE_USER),
);

/**
 *  Login controller
 */
$app->get('/login', function (Request $request) use ($app) {
    /** @noinspection PhpUndefinedMethodInspection */
    $error = $app['security.last_error']($request);
    return new \Symfony\Component\HttpFoundation\Response($app['twig']->render('login.html.twig', array(
        'error' => $error,
        'last_username' => $app['session']->get('_security.last_username'),
    )), isset($error) ? 403 : 200);
});
