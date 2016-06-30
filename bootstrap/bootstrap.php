<?php
/**
 * The bootstrap file creates and returns the container.
 */

use DI\ContainerBuilder;
use Provider\Provider;

// Require the autoloader because what else would we do??
require __DIR__ . '/../vendor/autoload.php';

// Start up ye old database with the good ol' doctrine
$entityManager = require __DIR__ . '/database.php';

// Snag all of the dependencies from the registered providers
$dependencies = require __DIR__ . '/../config/register.php';

// Create a new provider, set dependencies from file, and then register it.
$provider = new Provider;
$provider->dependencies = $dependencies;
$provider->register();

// Build the container.
$containerBuilder = new ContainerBuilder;

// Add Custom Providers to Container
foreach($provider->getRegistered() as $registered)
  $containerBuilder->addDefinitions($registered);

// Add Appplication-Wide Container
$containerBuilder->addDefinitions(__DIR__ . '/register.php');
$container = $containerBuilder->build();

return $container;
