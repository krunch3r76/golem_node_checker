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

while not fitting the strict definition of a ping, as a ping occurs as an icmp packet and this as a udp packet, it follows a similar pattern. a request bytestring followed some arbitrary payload with an reply of the same bytestring followed by a payload. The payload is one-to-one so that the reply's payload is invariably the same. i discovered this ping behavior while monitoring communications from my yagna node on my ethernet interface to discover the "name" to which yagna will always reply, like, "yagna?" gets the reply "yes?" is byte talk. i call it, the evocation of yagna.

references: [1] https://en.wikipedia.org/wiki/Ping_(networking_utility)
