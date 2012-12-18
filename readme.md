# Fuel OAuth2 Server Package

A super simple OAuth2 Server package for Fuel.

## About
* Version: 1.0.0
* Author: Derek Myers

## Installation

### Git Submodule

If you are installing this as a submodule (recommended) in your git repo root, run this command:

	$ git submodule add git://github.com/dmyers/fuel-oauth2-server.git fuel/packages/oauth2server

Then you you need to initialize and update the submodule:

	$ git submodule update --init --recursive fuel/packages/oauth2server/

### Download

Alternatively you can download it and extract it into `fuel/packages/oauth2server/`.

## Setup

### Run migrations

Run the migrations which will create the table structure in your database.

	$ php oil r migrate --packages=oauth2server

## Usage

### Add a client

```php
$client_id = '123';                     // min-length is 3 chars!
$client_secret = 'test';
$redirect_uri = 'http://fuelphp.com';

$oauth = OAuth2Server::forge();
$oauth->addClient($client_id, $client_secret, $redirect_uri);
```

## Updates

In order to keep the package up to date simply run:

	$ git submodule update --recursive fuel/packages/oauth2server/
