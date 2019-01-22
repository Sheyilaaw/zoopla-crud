
<?php

class Routes {

    // Insert the route into the $Routes array.
    private static function registerRoute($route) {
        global $Routes;
        $Routes[] = $route;
    }

    // Register the route and run the closure using __invoke().
    public static function set($route) {
        self::registerRoute($route);
    }
}
