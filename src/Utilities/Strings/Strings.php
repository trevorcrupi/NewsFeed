<?php

/*
 | Collection of utility functions to aid in the arduous
 | process of using string functions. It makes everything way
 | easier and much more human readable this way.
 |
 | USAGE:
 | I like to include Nucleus\Utilites as Utils and then say something like:
 | Utils\Strings\contains(...);
 */

/**
 * Split a string by a string. If necessary, alter a certain array element
 * by setting $change = [$index, $addition]
 * @var $delimeter the string delimeter to split by
 * @var $string the string to be split
 * @var $change the array to change a certain index.
 */
function splitString($delimeter, $string, $change = null)
{
  $arr = explode($delimeter, $string);
  if(is_array($change)) {
    $arr[$change[0]] = $change[1].$arr[$change[0]];
  }

  return $arr;
}

/**
 * Check if a string contains another string.
 * @var $needle the string to be found
 * @var $haystack to string to be search
 */
function contains( $needle, $haystack )
{
  return (strpos($needle, $haystack) !== false);
}
