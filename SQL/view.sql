CREATE VIEW ride_price AS 
SELECT distinct r.price , r.carid, r.time_stamp, r.origin, r.destination, r.rideid, b.bid_price
FROM ride r LEFT OUTER JOIN bid b
ON (r.rideid = b.rideid 
AND b.bid_price >= ALL(SELECT b2.bid_price FROM bid b2 WHERE b2.rideid = r.rideid)
AND b.bid_price >= r.price);