# KRL Online

[![Build Status](https://secure.travis-ci.org/jefrip/KRLOnline.png)](http://travis-ci.org/jefrip/KRLOnline)

KRL Online is webservices for viewing KRL position. Using Slim framework (PHP)

* Data from http://infoka.krl.co.id

## Features

* Get Stasiuns (http://localhost/krlonline/stasiuns)
* Get Jadwal (http://localhost/krlonline/jadwal/jak)

* Online Examples 
  * Get Stasiuns (http://krlonline.ap01.aws.af.cm/stasiuns)
  * Get Jadwal (http://krlonline.ap01.aws.af.cm/jadwal/jak)

## Getting Started

### Install
* Import database krl.sql
* Change db.php for database setting

### System Requirements

You need **PHP >= 5.3.0**. If you use encrypted cookies, you'll also need the `mcrypt` extension.

## Todos
* Create examples service
* Integrate test with Travis-CI
* Other