<?php
// cli-config.php
require_once "bootstrap/database.php";

return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($entityManager);
