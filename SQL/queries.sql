
-- Query to check available rides
SELECT * 
FROM ride r
WHERE r.rideid NOT IN (
	SELECT c.rideid FROM complete_ride c 
	);

SELECT 'Il faut '+ r.price +' pour aller à '+ r.destination from ride r where r.origin='Utown';
