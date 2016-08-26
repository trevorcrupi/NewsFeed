<?php

// Home Page
$router->get("/", "HomeController@home");

// Login
$router->get("/login", "UserController@login");

// Log out
$router->get("/logout", "UserController@logout");

// Register
$router->get("/register", "UserController@register");

// Inbox
$router->get("/inbox", "MessageController@all");

// Follow User
$router->get("/follow/{id}", "UserController@follow");

// Unfollow User
$router->get("/unfollow/{id}", "UserController@unfollow");
// Get specific Message
$router->get("/messages/{id}", "MessageController@show");

$router->post("/add/message", "MessageController@add");
$router->post("/user", "UserController@add");
$router->post("/login/user", "UserController@loginUser");

// Profile Page
$router->get("/{user_name}", "UserController@profile");

/*
 #goals 
	
	$app->get('/', function(App $app) {
		return $app['home']->render('/user/:id');
	});
*/