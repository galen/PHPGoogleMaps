#PHP Google Maps API

For PHP 5.3+ and Google Maps API v3

[examples](http://galengrover.com/projects/php-google-maps/examples/)

##Autoloading

There are 2 ways to autoload.

1. Use the autoloader that comes with the App. It's located in the Core namespace.

        require( '../PHPGoogleMaps/Core/Autoloader.php' );

2. Use an [autoloading class](https://gist.github.com/221634) like the one on the [PSR-0 Final Proposal](http://groups.google.com/group/php-standards/web/psr-0-final-proposal).

        require( '_system/SplClassLoader.php' ); // This is in the examples folder
        $classLoader = new SplClassLoader('PHPGoogleMaps', '../' ); // Change the include path to reflect your filesystem
        $classLoader->register();