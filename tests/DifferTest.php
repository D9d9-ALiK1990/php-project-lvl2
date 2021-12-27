<?php

require("vendor/autoload.php");

use Webmozart\Assert\Assert;

$result = '{
 -follow:false
  host:hexlet.io
 -proxy:123.234.53.22
 -timeout:50
 +timeout:20
 +verbose:true
}
';
Assert::eq(\Differ\genDiff('/tests/fixtures/file1.json',
    '/home/otmakhov/www/hexlet/php-project-lvl2/tests/fixtures/file2.json'),
    $result, 'Функция работает неверно!');
Assert::eq(\Differ\genDiff('/notexist-file.json',
    '/home/otmakhov/www/hexlet/php-project-lvl2/tests/fixtures/file2.json'),
    'problems-file', 'Функция работает неверно!');

echo 'Все тесты пройдены!';