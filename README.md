Briefly this will only work if a php script that creates a mysql database connection $dbc is added by the developer. See code for details and an example.

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

while not fitting the strict definition of a ping, as a ping occurs as an icmp packet and this as a udp packet, it follows a similar pattern. a (echo) request bytestring followed some arbitrary payload with an (echo) reply of the same bytestring followed by a payload [1]. The payload is one-to-one so that the reply's payload is invariably the same. i discovered this ping behavior while monitoring communications from my yagna node on my ethernet interface to discover the "name" to which yagna will always reply, like, "yagna?" gets the reply "yes?" in byte talk. i call it, the evocation of yagna.

enochian like bs aside, if there is use beyond the testing phase of the new networking model, i shall further develop this to expound on the specification of the ping in both the code and in the readme. it is as of yet well hidden in the yagna code. nevertheless, the same echo request begets the same echo reply and that is sufficient for now.

references: [1] https://en.wikipedia.org/wiki/Ping_(networking_utility)

phun sufficient association for inspiration:
Matthew 6:33-34: But seek ye first the kingdom of God, and his righteousness; and all these things shall be added unto you. Take therefore no thought for the morrow: for the morrow shall take thought for the things of itself. Sufficient unto the day *is* the evil thereof. if you don't get the last sentence, then it still makes a cool "poetic anchor".
