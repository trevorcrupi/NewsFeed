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
 * Redirect to whatever page you feel like
 * @param string $to the uri of where you tryna go
 * $to defaults to home page.
 */
 function redirect( $to = '/' )
 {
  header("Location: ".$to);
 }
