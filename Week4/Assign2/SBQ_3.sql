SELECT country AS top_3_countries 
FROM customer_list 
GROUP BY country 
ORDER BY count(ID) DESC LIMIT 3;