<?php

function contains($needle, $haystack)
{
    return (strpos($haystack, $needle) !== false);
}

var_dump(contains(".", "hi.hey"));
