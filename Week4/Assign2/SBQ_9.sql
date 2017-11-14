SELECT first_name, last_name, nbr, year 
FROM (SELECT first_name, last_name, nbr, year,                 
        @year_rank := IF(@current_year = year, @year_rank + 1, 1) AS year_rank,                 
        @current_year := year 
      FROM (SELECT first_name, last_name, count(rental_id) AS nbr, 
                                         year(rental_date) AS year  
            FROM rental AS r, customer AS c  
            WHERE r.customer_id = c.customer_id   
            GROUP BY year, r.customer_id  
            ORDER BY year, nbr DESC
           ) rank
     ) ranked 
WHERE year_rank <= 3;