<?php

// autoload_real.php @generated by Composer

<<<<<<< HEAD
class ComposerAutoloaderInit0f128b730ec7aaf1abfd8935d3e62d39
=======
class ComposerAutoloaderInit895f80cffc7117a1f9e4375b83b2bcce
>>>>>>> OCR5/master
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

<<<<<<< HEAD
        spl_autoload_register(array('ComposerAutoloaderInit0f128b730ec7aaf1abfd8935d3e62d39', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit0f128b730ec7aaf1abfd8935d3e62d39', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit0f128b730ec7aaf1abfd8935d3e62d39::getInitializer($loader));

        $loader->register(true);

        $filesToLoad = \Composer\Autoload\ComposerStaticInit0f128b730ec7aaf1abfd8935d3e62d39::$files;
        $requireFile = \Closure::bind(static function ($fileIdentifier, $file) {
=======
        spl_autoload_register(array('ComposerAutoloaderInit895f80cffc7117a1f9e4375b83b2bcce', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit895f80cffc7117a1f9e4375b83b2bcce', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit895f80cffc7117a1f9e4375b83b2bcce::getInitializer($loader));

        $loader->register(true);

        $filesToLoad = \Composer\Autoload\ComposerStaticInit895f80cffc7117a1f9e4375b83b2bcce::$files;
        $requireFile = static function ($fileIdentifier, $file) {
>>>>>>> OCR5/master
            if (empty($GLOBALS['__composer_autoload_files'][$fileIdentifier])) {
                $GLOBALS['__composer_autoload_files'][$fileIdentifier] = true;

                require $file;
            }
<<<<<<< HEAD
        }, null, null);
        foreach ($filesToLoad as $fileIdentifier => $file) {
            $requireFile($fileIdentifier, $file);
=======
        };
        foreach ($filesToLoad as $fileIdentifier => $file) {
            ($requireFile)($fileIdentifier, $file);
>>>>>>> OCR5/master
        }

        return $loader;
    }
}
