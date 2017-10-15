CREATE TABLE person (
	email VARCHAR(64) PRIMARY KEY,
	name VARCHAR(64) NOT NULL,
	phone NUMERIC NOT NULL,	-- UNIQUE,
	creditcard VARCHAR(64),
	password VARCHAR(64) NOT NULL
);

CREATE TABLE car(
	carid VARCHAR(64) PRIMARY KEY,
	model VARCHAR(64) NOT NULL,
	color VARCHAR(64) NOT NULL,
	capacity NUMERIC NOT NULL,
	owner VARCHAR(64) REFERENCES person(email)
);

CREATE TABLE ride(
	carid VARCHAR(64) REFERENCES car(carid),
	time_stamp TIMESTAMP,
	origin VARCHAR(64) NOT NULL,
	destination VARCHAR(64) NOT NULL,
	price NUMERIC NOT NULL,
	rideid VARCHAR(64) UNIQUE,
	PRIMARY KEY(carid,time_stamp)
);


CREATE TABLE complete_ride(
	client VARCHAR(64) REFERENCES person(email),
	final_price NUMERIC NOT NULL,
	rideid VARCHAR(64) REFERENCES ride(rideid),
	-- carid VARCHAR(64),
	-- time_stamp TIMESTAMP,
	-- FOREIGN KEY(carid,time_stamp) REFERENCES ride(carid,time_stamp),
	PRIMARY KEY(rideid,client)
);