SELECT address_id, address2 
FROM address 
WHERE address2 NOT IN ("NULL", "")
ORDER BY address2 ASC;