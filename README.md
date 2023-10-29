# Yaml Compact Version

The Yaml loads and dumps YAML files.

History with a list of original committers/commits: [shortlog.txt](shortlog.txt)

## Getting Started
#### Read file
```php
use PhacMan\Yaml\Yaml;
$yaml = Yaml::parseFile('some.yaml');
print_r($yaml);
```

#### Write file
```php
use PhacMan\Yaml\Yaml;
$array = [
    'foo' => 'bar',
    'bar' => ['foo' => 'bar', 'bar' => 'baz'],
];
$yaml = Yaml::dump($array);
file_put_contents('written.yaml', $yaml);
```

Usage details: [here](https://symfony.ru/doc/current/components/yaml.html)

### Resources

* Original repository: https://github.com/symfony/yaml
