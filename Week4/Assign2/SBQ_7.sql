SELECT a.first_name, a.last_name 
FROM actor AS a 
JOIN (SELECT first_name 
      FROM actor 
      WHERE actor_id = 8) AS afn 
ON a.first_name = afn.first_name 
WHERE actor_id <> 8 
UNION 
SELECT c.first_name, c.last_name 
FROM customer AS c 
JOIN (SELECT first_name 
      FROM actor 
      WHERE actor_id = 8) AS afn 
ON c.first_name = afn.first_name;