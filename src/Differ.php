<?php
namespace Differ;

function genDiff(string $pathToFile1, string $pathToFile2)
{

    $p1 = convertPath($pathToFile1);
    $p2 = convertPath($pathToFile2);
    if (($p1 == false) || ($p2 == false)) {
        return 'problems-file';
    }
    $f1 = json_decode(file_get_contents($p1), true);
    $f2 = json_decode(file_get_contents($p2), true);
    $keys = array_unique(array_merge(array_keys($f1), array_keys($f2)));
    sort($keys);
    $result = '{' . PHP_EOL;
    foreach ($keys as $value) {
        if (array_key_exists($value, $f1) && array_key_exists($value, $f2)) {
            if ($f1[$value] === $f2[$value]) {
                $result .= '  ' . $value . ':' . verifyBool($f1[$value]) . PHP_EOL;
            } else {
                $result .= ' -' . $value . ':' . verifyBool($f1[$value]) . PHP_EOL . ' +' . $value . ':' . verifyBool($f2[$value]) . PHP_EOL;
            }
        } elseif (array_key_exists($value, $f1)) {
            $result .= ' -' . $value . ':' . verifyBool($f1[$value]) . PHP_EOL;
        } else {
            $result .= ' +' . $value . ':' . verifyBool($f2[$value]) . PHP_EOL;
        }
    }
    $result .= '}' . PHP_EOL;
    return $result;
}

function convertPath(string $path)
{
    if (realpath($path)) {
        return realpath($path);
    } elseif (realpath(__DIR__ . '/../' . $path)) {
        return realpath(__DIR__ . '/../' . $path);
    } else {
        return false;
    }
}

function verifyBool($var)
{
    if (is_bool($var)) {
        if ($var) {
            return 'true';
        } else {
            return 'false';
        }
    }
    return $var;
}