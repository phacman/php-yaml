<?php

use PhacMan\Yaml\Yaml;

require dirname(__DIR__, 1).'/vendor/autoload.php';

$array = [
    'foo' => 'bar',
    'bar' => ['foo' => 'bar', 'bar' => 'baz'],
];

$yaml = Yaml::dump($array);

file_put_contents('written.yaml', $yaml);
