Technical test for Flooved.com
=======================

Introduction
------------
This simple application is based on the skeleton application using the ZF2 MVC layer and module
systems provide by Zend Framework. The initial skeleton is available on : https://github.com/zendframework/ZendSkeletonApplication


Installation
------------

Please follow the initial installation process provided by ZendSkeletonApplication. 

Database
--------
Add a `local.php` file to `config/autoload/` with your credentials as follow:

```php
<?php
return array(
    'db' => array(
        'username' => 'YOURUSERNAME',
        'password' => 'YOURPASSWORD',
    ),
);
```
Table structure:

```sql
CREATE TABLE `book` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(500) NOT NULL DEFAULT '',
  `path` varchar(1000) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

```
