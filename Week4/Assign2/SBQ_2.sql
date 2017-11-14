SELECT name
FROM   language AS l 
JOIN (SELECT language_id
      FROM film
      WHERE release_year = '2006'
      GROUP BY language_id
      ORDER BY Count(language_id) DESC LIMIT 3) AS c
ON l.language_id = c.language_id;