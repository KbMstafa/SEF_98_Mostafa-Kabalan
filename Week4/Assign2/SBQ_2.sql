SELECT name
FROM   language
WHERE  language_id IN (SELECT language_id
                       FROM film
                       WHERE release_year = '2006'
                       GROUP BY language_id
                       ORDER BY Count(language_id) DESC);