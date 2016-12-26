# MVC Framework

PHP MVC Framework is a lightweight, fast and extensible designed for web developers.

## PHP Version

Version >= 5.5.9

## Installation

```bash
# Cloning the repository
$ https://github.com/aduartem/mvc-framework
```

**Install project dependencies:**

At the root of the project run the following command:

```bash
$ composer install
```

**Note:** It is required to have composer previously installed.

## Directory Structure

- app

- framework

- public

- .gitignore

- .htaccess

- composer.example.json

- composer.json

- index.php

- LICENSE

- README.md

### The app Directory

The app directory, contains the code of your application. Has MVC Architecture (Model, View, Controller), directories for the configuration, helpers and libraries.

### The framework Directory

The framework directory, contains the core code of the framework.

### public

The public directory, contains all files of public access. This directory also houses your assets such as JavaScript, CSS, and images.

## Implementation of design patterns

- Front Controller (index.php): Autoload, includes files, define constants for the system and invoke the methods main for the class Bootstrap and CliController. Is the entry point for all requests entering your application.

- Factory

- Strategy

- Dependency injection

- Active Record

## ORM

The framework with a minimalist object-relational mapping (ORM), which implements the active record pattern through the QueryBuilder class and has the basic methods for querying the database. Active record methods prevent SQL injection attacks by using prepared statements.

A model will always refer to a table in the database. All models inherit ORM methods.

### Methods:

**select - Defines which fields to show** 

**get - Executes a query by returning the data in an associative array** 

Receive an array as an optional input parameter.

Examples:

1.-

```php
$oUser = new User();
$aUsers = $oUser->select()
       	 	  	->get();
```

2.-

```php
$oUser = new User();
$aUsers = $oUser->select(array('email', 'name'))
                	  ->get();
```

**where - Clause WHERE, multiple conditions "and"** 

Example:

```php
$oUser = new User();
$aUsers = $oUser->select(array('email', 'name'))
                	  ->where(array('id' => 6))
                	  ->get();
```

**like - This method enables you to generate LIKE clauses, useful for searching. ** 

Example:

```php
$oUser = new User();
$aUsers = $oUser->select(array('email', 'name'))
                ->where()
                ->like('email', 'gmail')
                ->get();
```

**fetchObj - Find records from a table, return object array** 

```php
$obj::fetchObj(); // Fetch all records from a table.

$obj::fetchObj($aParams); // Returns an array indexed by column name as returned in your result set
```

**fetchArray - Find records from a table, return associative array** 

```php
$obj::fetchArray(); // Fetch all records from a table.

$obj::fetchArray($aParams); // Returns an array indexed by column name as returned in your result set
```

**save - Inserts or updates a record from a table** 

```php
$obj::save($aParams); // Executes an INSERT statement

$obj::save($aParams, $id); // Executes an UPDATE statement
```

**delete - Deletes a record from a table** 

```php
$obj::delete($aParams); // Executes an DELETE statement
```

## License

The framework is open-sourced software licensed under the MIT license.