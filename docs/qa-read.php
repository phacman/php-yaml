<?php

use PhacMan\Yaml\Yaml;

require dirname(__DIR__, 1).'/vendor/autoload.php';

$yaml = Yaml::parseFile('some.yaml');

print_r($yaml);
