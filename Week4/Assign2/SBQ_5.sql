SELECT first_name, last_name, release_year 
FROM actor AS c 
JOIN (select actor_id, release_year 
      FROM film_actor AS a 
      JOIN (SELECT film_id, release_year 
            FROM film 
            WHERE description LIKE "%crocodile%" 
              AND description LIKE "%shark%") AS b 
      ON a.film_id = b.film_id) AS d 
ON c.actor_id = d.actor_id 
ORDER BY last_name ASC;