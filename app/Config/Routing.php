<?php

namespace Config;

use CodeIgniter\Config\Routing as BaseRouting;

/**
 * Routing configuration
 */
class Routing extends BaseRouting
{
    /**
     * For Defined Routes.
     * An array of files that contain route definitions.
     * Route files are read in order, with the first match
     * found taking precedence.
     *
     * Default: APPPATH . 'Config/Routes.php'
     *
     * @var list<string>
     */
    public array $routeFiles = [
        APPPATH . 'Config/Routes.php',
    ];

    /**
     * For Defined Routes and Auto Routing.
     * The default namespace to use for Controllers when no other
     * namespace has been specified.
     *
     * Default: 'App\Controllers'
     */
    public string $defaultNamespace = 'App\Controllers';

    /**
     * For Auto Routing.
     * The default controller to use when no other controller has been
     * specified.
     *
     * Default: 'Home'
     */
    public string $defaultController = 'Home';

    /**
     * For Defined Routes and Auto Routing.
     * The default method to call on the controller when no other
     * method has been set in the route.
     *
     * Default: 'index'
     */
    public string $defaultMethod = 'index';

    /**
     * For Auto Routing.
     * Whether to translate dashes in URIs for controller/method to underscores.
     * Primarily useful when using the auto-routing.
     *
     * Default: false
     */
    public bool $translateURIDashes = false;

    /**
     * Sets the class/method that should be called if routing doesn't
     * find a match. It can be the controller/method name like: Users::index
     */
    public ?string $override404 = null;

    /**
     * If TRUE, the system will attempt to match the URI against
     * Controllers by matching each segment against folders/files
     * in APPPATH/Controllers, when a match wasn't found against
     * defined routes.
     *
     * Keep this enabled for compatibility with legacy behavior.
     */
    public bool $autoRoute = true;

    /**
     * If TRUE, the system will look for attributes on controller
     * class and methods that can run before and after the
     * controller/method.
     */
    public bool $useControllerAttributes = true;

    /**
     * For Defined Routes.
     * If TRUE, will enable the use of the 'prioritize' option
     * when defining routes.
     */
    public bool $prioritize = false;

    /**
     * For Defined Routes.
     * If TRUE, matched multiple URI segments will be passed as one parameter.
     */
    public bool $multipleSegmentsOneParam = false;

    /**
     * For Auto Routing (Improved).
     * Map of URI segments and namespaces.
     *
     * @var array<string, string>
     */
    public array $moduleRoutes = [];

    /**
     * For Auto Routing (Improved).
     * Whether to translate dashes in URIs for controller/method to CamelCase.
     */
    public bool $translateUriToCamelCase = true;
}
