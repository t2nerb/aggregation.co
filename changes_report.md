CSCI3287: Project 1 
===================
By: Brent Dagdagan

Changes to aggregation.co
-------------------------

### Dockerized application

To deploy the application, I _dockerized_ it. I encapsulated all the dependencies into a single container which can be deployed and configured in a few simple commands on any machine. Steps to setup the application are at the bottom of this write-up.

### Add/Delete Feeds via Web Interface

I added the ability to add and delete fields without having direct access to the database. To accomplish this, I had to find a way to dynamically generate a unique `feeds.id`. To accomplish this, I used auto_increment on the `id` attribute of the `feeds` table. This way, the user only needs to specify the RSS feed url and which column they'd like the feed to be displayed in. This is accomplished with the following queries: 

```sql
INSERT INTO feeds (displayColumn, link) VALUES(user_colnum, 'user_url');

DELETE FROM feeds WHERE link LIKE '%user_input%';
```


### Search functionality

I added a separate page linked in the navbar to aid in filtering the news feeds. This was accomplished by creating a query based on some user input, and matching the user input with the itemDesc and itemTitle attributes in the items database. All feeds matching the pattern are displayed. This is accomplished with the following query:

```sql
SELECT DISTINCT items.id as id, feedTitle, feedLink, itemTitle, itemPubDate, itemLink, itemDesc 
FROM feeds,items 
WHERE items.itemDesc LIKE '%user_input%' 
OR items.itemTitle LIKE '%user_input%';
```

New Database Schema
-------------------

```sql
CREATE TABLE `feeds` (

 `id` int(11) AUTO_INCREMENT,

 `displayColumn` int(11) NOT NULL,

 `link` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
 
 PRIMARY KEY (`id`)

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

To test the application on your local machine, you must have docker installed. Numerous helper scripts are included to aid in the deployment for this application.  

1. Pull base image: `docker pull tutum/lamp` 
2. To build the application image:`./build`
3. To create the container use: `docker run -d --name aggregation -v $(pwd):/app/ -p 80:80 -it aggregation`
4. To configure the database and start the cron job: `docker exec -it aggregation /bin/bash /app/setup.sh`
5. You should now be able to enter `localhost/index.php` into your browser to view the application. Updates are made every minute.  

Any changes made to the code while the container is running is reflected immediately. 

Teardown
--------

The container will continue to run until it is stopped or the docker daemon is shut down. To stop the container:  

```
docker stop aggregation
```

To remove the container: 

```
docker rm aggregation
```
