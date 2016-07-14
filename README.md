# generator-import
A demo of using generators for doing imports

1. What's a generator?
    1. [Generator](http://php.net/manual/en/language.generators.overview.php)
    1. [Function](http://php.net/manual/en/language.generators.syntax.php)
    1. [Generator vs Iterator](http://php.net/manual/en/language.generators.comparison.php)
1. DataGenerator.php
    1. Separates data generation from usage
    1. `yield $x`
1. Importing - old school...ish
    1. ImportDemo.php
1. Turning it inside out
    1. `$data = yield`
1. Feeding your generator
    1. GeneratorImportDemo.php
1. Maybe not better, but more elegant