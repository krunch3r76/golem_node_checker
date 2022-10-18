Briefly this is made complete with a php script that creates a database connection $dbc. See code for details.

The connection is made to a mysql database to which the following table was created and added unto as so:
```
create table yagna_pings (id INT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
                          ipaddress VARCHAR(255) NOT NULL,
                          lasttime INT NOT NULL,
                          UNIQUE (ipaddress)
                          );
```
ipaddress is stored as an sha1 hash which is 40 characters as a hexstring. 255 is more than enough and allows for changing the hash algorithm. sha1 was arbitrarily chosen but is sufficiently secure in this context.

the ipaddress is stored as a hash to protect the privacy of people visiting the site not only from the site website operator/developer but from anyone who might gain access to the database besides.

the ping works by sending a specific stream of bytes to which yagna invariably responds in the same way every time. it is a "word" that yagna recognizes and makes the same response to every time. it is not a ping by definition of a ping, that is, the bytestream sent is not echo'ed back, instead, a different word, but always the same, is read back. yagna speaks! thus yagna can be "pinged"! It is akin to calling yagna by its name and getting a "yes?" in return. furthermore, a ping is an ICMP packet whereas these are udp packets. tl;dr: this website pings yagna.
