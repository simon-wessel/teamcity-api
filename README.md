 TeamCity API
================================================================================

[![Latest Stable Version](https://poser.pugx.org/simon-wessel/teamcity-api/v/stable)](https://packagist.org/packages/simon-wessel/teamcity-api)
[![Total Downloads](https://poser.pugx.org/simon-wessel/teamcity-api/downloads)](https://packagist.org/packages/simon-wessel/teamcity-api)
[![Monthly Downloads](https://poser.pugx.org/simon-wessel/teamcity-api/d/monthly)](https://packagist.org/packages/simon-wessel/teamcity-api)
[![License](https://poser.pugx.org/simon-wessel/teamcity-api/license)](https://packagist.org/packages/simon-wessel/teamcity-api)
[![Latest Unstable Version](https://poser.pugx.org/simon-wessel/teamcity-api/v/unstable)](https://packagist.org/packages/simon-wessel/teamcity-api)

A simple PHP wrapper for the API of your TeamCity instance which may or may not be used as a Laravel package.

This package lacks most API functions provided by TeamCity due to the sheer amount of endpoints. If you need any of the missing functions, just add it to the API class and create a pull request.


 Table of Contents
--------------------------------------------------------------------------------

- [Installation](#installation)
- [Standalone usage](#standalone-usage)
- [Usage with Laravel](#usage-with-laravel)


Installation
--------------------------------------------------------------------------------

The package can be installed via composer by running

```bash
composer require simon-wessel/teamcity-api
```

Standalone usage
--------------------------------------------------------------------------------
```php
$url = "https://yoururltoteamcity.com/";
$username = "myusername";
$password = "mypassword";

$teamCityApi = new SimonWessel\TeamCityApi\TeamCityApi($url, $username, $password);

$builds = $teamCityApi->getBuilds();
```

Usage with Laravel
--------------------------------------------------------------------------------
### 1. Setup
The package supports package auto-discovery which has been introduced in Laravel 5.5. If you are using 5.5 or above, you can skip this step.

Otherwise you have to add the Service Provider to the `providers` array in your `config/app.php` file:
```php
SimonWessel\TeamcityApi\ServiceProvider::class,
```
And if you want to use the Facade, you have to add it to the `aliases` array in the same file:
```php
'TeamCity' => \SimonWessel\TeamCityApi\Facade::class,
```
### 2. Configuration
You will need to configure a TeamCity user account with all permissions for the data and actions you want to access.
You can either set the following environment variables in your `.env` file:
```bash
TEAMCITY_URL=https://yoururltoteamcity.com/
TEAMCITY_USERNAME=myusername
TEAMCITY_PASSWORD=mypassword
```
Or alternatively you can publish the package config file and adjust the settings in there. To do this run this command:
```bash
php artisan vendor:publish --provider="SimonWessel\TeamCityApi\ServiceProvider"
```
You will get a new config file `config/teamcity.php` with the available settings.
### 3. Usage
You can access the API with the Facade:
```php
TeamCity::getBuilds()
```
Or calling the Service Provider singleton directly:
```php
app('teamcity')->getBuilds()
```