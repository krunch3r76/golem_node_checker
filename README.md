A live version of this is currently hosted at https://www.k-1.me/golem

Briefly this will only run on a custom server if a php script that creates a mysql database connection $dbc is added by the developer. See code for details and an example.

This database connection is made to a mysql database to which the following table was created and added unto as so:
```
create table yagna_pings (id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          ipaddress VARCHAR(255) NOT NULL,
                          lasttime INT NOT NULL,
                          UNIQUE (ipaddress)
                          );
```
ipaddress is stored as an sha1 hash which is 40 characters as a hexstring. 255 is more than enough and allows for changing the hash algorithm. sha1 was arbitrarily chosen but is sufficiently secure in this context.

the ipaddress is stored as a hash to protect the privacy of people visiting the site not only from the site website operator/developer but from anyone who might gain access to the database besides.

the ping is a narrowed down yagna specific echo request to which there is a determinate echo reply. the website uses the same echo request each time, as there is no information beyond reachability that is useful here.


references: [1] https://en.wikipedia.org/wiki/Ping_(networking_utility)

