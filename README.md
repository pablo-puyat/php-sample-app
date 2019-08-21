PHP Developer Challenge
==============================

## Introduction

Spicy Deli has started to expand their business and need a complete rewrite of their current online presence. They have asked you to build a simple cataloging system as a RESTful API so that they can integrate with mobile and desktop applications in the future.

## Requirements

### General requirements

The challenge is to be completed using:

* Git
* PHP 7.*
* [Composer](https://getcomposer.org)
* MySQL 5.7.*

You are free to use any PHP libraries, modules and frameworks as you deem necessary.

A [Vagrant](https://www.vagrantup.com) setup is available to you with most of those software requirements already installed (more on this below).

### API Requirements

The API should allow its users to:

* list all products
* retrieve a single product
* create a product
* delete a product
* list all product categories

## Bonus Points

* Use the Vagrant setup (see below)
* Use Symfony or Laravel
* Use [Codeception](http://codeception.com) for your tests
* Split your tests into unit and acceptance/API tests
* Allow the API users to update one or more attributes of a product at once
* Allow the API users to update all attributes of a product at once (i.e., replace a product)
* Use YAML for configuration

## Data

Products should have the following attributes:

* name
* category
* SKU
* price
* date and time of creation
* date and time of latest update

Categories should have the following attributes:

* name

### Seed Data

The seed data is written in JSON and needs to be *translated* into SQL before being inserted into MySQL. The database table structures need to be created as well. It is up to you how (and if) you want to construct relations between tables and what data types and indexing schemes you want to use.

The seed data can be found at [spicy-deli.json](data/seeds/spicy-deli.json).

## Criteria

For full transparency, the test will be scored according to the following:

* Ability to transform requirements into code
* Reusable & decoupled code
* Proper RESTful structure
* RDBMS and MySQL best practices
* PHP best practices
* Validation
* Use of dependency injection, controllers, and data layer(s) (DBAL, ORM etc.)



* Unit and acceptance testing (bonus)

## Vagrant setup

A [Vagrantfile](./Vagrantfile) is available to you if you don't want to set up your own environment from scratch. It uses the official Ubuntu 16.04 (Xenial) as a base box and installs the following software:

* PHP 7.0
* MySQL 5.7
* Nginx 1.10
* Composer 1.2

In order to use the Vagrantfile, you need to install [Virtual Box](https://www.virtualbox.org/wiki/Downloads), [Virtual Box Guest Additions](https://docs.oracle.com/cd/E36500_01/E36502/html/qs-guest-additions.html) and [Vagrant](https://www.vagrantup.com/downloads.html) in your local machine.

Refer to the Vagrant [official documentation](https://www.vagrantup.com/docs/getting-started/index.html) if you have any doubt.

### Database credentials

The Vagrantfile creates a MySQL database with the following credentials:

* Database name:      `spicy`
* Database user:      `spicy`
* Database password:  `spicy`

### Accessing the website from your host machine

After running `vagrant up` from the project directory, you can access the website from your host machine (with a web browser, for example) through the IP `192.168.33.10`.

To see all the details of the PHP installation in the VM, for example, you can check [info.php](http://192.168.33.10/info.php) from your host machine.

### Updating the Vagrantfile

You are free to modify the Vagrantfile according to your needs. All changes to that file should be commited to Git as part of the challenge.