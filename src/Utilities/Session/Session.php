<?php

/*
 | Collection of utility functions to aid in the tedious nonsensicality
 | that is PHP sessions.
 |
 | USAGE:
 | I like to include Nucleus\Utilites and then say something like:
 | session("user_logged_in");
 */

/**
 * Start a Session if it doesn't exist already.
 */
 function init()
 {
   if (session_id() == '') {
       session_start();
   }
 }

 /**
  * Get a Session Variable.
  * @param string $key
  * @return Session variable
  */
function session($key = null)
{
  init();
  if($key == null)
    return $_SESSION;

  if(contains($key, ".")) {
    $key = splitString(".", $key);
    return $_SESSION[$key[0]][$key[1]] ?? false;
  }

  return $_SESSION[$key] ?? false;
}

/**
 * Get a Session Variable.
 * @param string $key
 * @param string $value
 */
function set($key, $value)
{
  init();
  if(!is_array($key)) {
    $_SESSION[$key] = $value;
    return;
  }

  $_SESSION[$key[0]][$key[1]] = $value;
}

/**
 * Check if user is logged_in
 * @return bool
 */
function logged_in()
{
  return session("user_logged_in") ? true : false;
}

/**
 * Destroy Session!!!
 */
function destroy()
{
  init();
  session_destroy();
}
