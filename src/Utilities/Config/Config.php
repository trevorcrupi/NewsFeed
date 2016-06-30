<?php

use Nucleus\Utilites;

/*
 | Collection of utility functions to aid in the arduous
 | process of using string functions. It makes everything way
 | easier and much more human readable this way.
 |
 | USAGE:
 | I like to include Nucleus\Utilites and then just say:
 | config(...);
 */

 /**
  * Get a value from the configuration array.
  * @var $config the config option you are finding
  */
function config( $key )
{
  global $config;
  if(!contains(".", $key))
    return $config[$key];

  $key = splitString(".", $key);
  return $config[$key[0]][$key[1]];
}
