<?php

require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use FileFinder\Finder;

$path = getcwd();
$finder = new Finder($path);
//$finder = new Finder($path, 0);

//find all php files in the given path
//findByName($finder, ['pattern' => '/^.+\.php$/i']);

//find the first file which name matches the pattern
//findByName($finder, ['pattern' => '/^.*file.+/i'], true);

//find all files that contain the given string
//findByContent($finder, ['searched' => 'abv', 'portionSize' => 3]);

//find all files that contain the given string with a smaller portionSize
findByContent($finder, ['searched' => 'suscipit laboriosam, nisi', 'portionSize' => 25]);

function findByContent($finder, $params, $firstMatchStop = false) {
    try {
        $filesByContent = $finder->find($params, 'content', $firstMatchStop);
        echo count($filesByContent) . ' founded files: ' . PHP_EOL;
        print_r($filesByContent);
    } catch (\Exception $ex) {
        echo 'Error occured during searching: ' . PHP_EOL;
        echo $ex->getMessage() . PHP_EOL;
    }
}

function findByName($finder, $params, $firstMatchStop = false) {
    try {
        $filesByName = $finder->find($params, 'name', $firstMatchStop);
        echo count($filesByName) . ' founded files: ' . PHP_EOL;
        print_r($filesByName);
    } catch (\Exception $ex) {
        echo 'Error occured during searching: ' . PHP_EOL;
        echo $ex->getMessage() . PHP_EOL;
    }
}
