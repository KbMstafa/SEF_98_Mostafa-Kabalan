SELECT store_id,
       Month(rental_date) AS month,
       Year(rental_date)  AS year,
       Sum(amount)        AS total,
       Avg(amount)        AS average
FROM payment AS p
RIGHT JOIN (SELECT store_id,
                   rental_id,
                   rental_date
            FROM customer AS c
            RIGHT JOIN (SELECT customer_id,
                               rental_id,
                               rental_date
                        FROM  rental
                        ORDER BY Year(rental_date),
                                 Month(rental_date)) AS fj
            ON c.customer_id = fj.customer_id) AS sj
ON p.rental_id = sj.rental_id
GROUP BY year, month, store_id
ORDER BY store_id, year, month;