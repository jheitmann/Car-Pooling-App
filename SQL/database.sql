CREATE TABLE person (
	email VARCHAR(64) PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	phone NUMERIC NOT NULL,	
	creditcard VARCHAR(64),
	password VARCHAR(64) NOT NULL,
	is_admin BOOLEAN NOT NULL DEFAULT FALSE
);

CREATE TABLE car(
	carid VARCHAR(64) PRIMARY KEY,
	model VARCHAR(64) NOT NULL,
	color VARCHAR(64) NOT NULL,
	capacity NUMERIC NOT NULL,
	owner VARCHAR(64) REFERENCES person(email) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE ride(
	carid VARCHAR(64) REFERENCES car(carid) ON UPDATE CASCADE ON DELETE CASCADE,
	time_stamp TIMESTAMP,
	origin VARCHAR(64) NOT NULL,
	destination VARCHAR(64) NOT NULL,
	price NUMERIC NOT NULL,
	rideid NUMERIC PRIMARY KEY,
	UNIQUE(carid,time_stamp)
);

CREATE TABLE bid(
	client VARCHAR(64) REFERENCES person(email) ON UPDATE CASCADE ON DELETE CASCADE,
	bid_price NUMERIC NOT NULL,
	rideid NUMERIC REFERENCES ride(rideid) ON UPDATE CASCADE ON DELETE CASCADE,
	PRIMARY KEY(rideid,client),
	UNIQUE(rideid,bid_price)
);

CREATE TABLE complete_ride(
	rideid NUMERIC PRIMARY KEY,
	client VARCHAR(64),
	FOREIGN KEY(rideid,client) REFERENCES bid(rideid,client) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE VIEW ride_price AS 
SELECT distinct r.price , r.carid, r.time_stamp, r.origin, r.destination, r.rideid, b.bid_price, 			b.client
FROM ride r LEFT OUTER JOIN bid b
ON (r.rideid = b.rideid 
AND b.bid_price >= ALL(SELECT b2.bid_price FROM bid b2 WHERE b2.rideid = r.rideid)
AND b.bid_price >= r.price);
