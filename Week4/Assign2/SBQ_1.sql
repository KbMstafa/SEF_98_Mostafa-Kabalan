SELECT first_name, last_name, total_number_of_movies 
FROM actor AS a
JOIN (SELECT actor_id, count(film_id) AS total_number_of_movies 
      FROM film_actor 
      GROUP BY actor_id) AS b ON a.actor_id = b.actor_id;