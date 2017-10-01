aggregation.co
==============
This code implements an RSS aggregator website using PHP.  It requires the use of a database to hold information about RSS feeds.

The code uses SimplePie to collect RSS feeds that are then tucked into the
database.

This code is currently used by the site http://aggregation.co

Database tables
---------------

```
CREATE TABLE `feeds` (

 `id` int(11) NOT NULL,

 `displayColumn` int(11) NOT NULL,

 `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL

) ENGINE=MyISAM DEFAULT CHARSET=utf8

CREATE TABLE `items` (

 `id` int(11) NOT NULL,

 `feedTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

 `feedLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

 `itemTitle` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

 `itemPubDate` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

 `itemLink` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,

 `itemDesc` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL

) ENGINE=MyISAM DEFAULT CHARSET=utf8

```

Setup
-----

This application requires Docker to be installed. 

1. To build the image that this application depends on: `./build`. 
2. To create a container containing the app: `./run`. 
3. To configure the database and start the cron job: `docker exec -it aggregation /bin/bash ./setup.sh`
4. You should now be able to enter 'localhost/index.php' into your browser to view the application. Updates are made every minute.  

Teardown
--------

The container will continue to run until it is stopped or the docker daemon is shut down. To stop and delete the container use: 

```
docker kill aggregation && docker rm aggregation 
```
