SELECT name, count 
FROM category AS cat 
RIGHT JOIN ((SELECT category_id, count(film_id) AS count 
             FROM film_category 
             GROUP BY category_id 
             HAVING count(film_id) BETWEEN 55 AND 65 
             ORDER BY count(film_id))
        UNION
            (SELECT category_id, if((SELECT count(*) 
                                     FROM (SELECT count(film_id) AS count 
                                           FROM film_category 
                                           GROUP BY category_id 
                                           HAVING count(film_id) 
                                           BETWEEN 55 AND 65 ) 55cat65) = 0, 
                                    (SELECT max(count) 
                                     FROM (SELECT count(film_id) AS count 
                                           FROM film_category 
                                           GROUP BY category_id) not55cat65),
                                "NULL") count 
             FROM film_category 
             GROUP BY category_id 
             HAVING count(film_id) = count)
            ) categ
ON cat.category_id = categ.category_id;