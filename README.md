Briefly this is made complete with a php script that creates a database connection $dbc. See code for details.

The connection is made to a mysql database to which the following table was created and added unto as so:
```
create table yagna_pings (id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          ipaddress VARCHAR(255) NOT NULL,
                           lasttime INT NOT NULL,
                           UNIQUE (ipaddress)
                           );
```
