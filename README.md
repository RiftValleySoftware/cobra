[]: # \page COBRA COBRA

![COBRA](images/COBRA.png)

COBRA
======
Part of the Rift Valley Platform
--------------------------------
![Rift Valley Platform](images/RVPLogo.png)

INTRODUCTION
============
![COBRA](images/COBRALayers.png)

COBRA is a security administration toolset for the Rift Valley Platform (RVP).

It is a standalone class that is instantiated with a logged-in CHAMELEON instance. That login needs to be an instance of CO_Login_Manager (or a subclass).

COBRA will allow a manager to create and delete logins, as well as manage security tokens.

\ref CHAMELEON is the "First Layer Abstraction" from the data storage and retrieval. It implements a few higher-level capabilities, such as collections, users and places.

\ref BADGER is the "First Layer Connection" to the data storage subsystem. It uses [PHP PDO](http://php.net/manual/en/book.pdo.php) to abstract from the databases, and provide SQL-injection protection through the use of [PHP PDO Prepared Statements](http://php.net/manual/en/pdo.prepared-statements.php).

LICENSE
=======

![Little Green Viper Software Development LLC](images/viper.png)
© Copyright 2018, [Little Green Viper Software Development LLC](https://littlegreenviper.com).
This code is ENTIRELY proprietary and not to be reused, unless under specific, written license from [Little Green Viper Software Development LLC](https://littlegreenviper.com).

DESCRIPTION
===========
