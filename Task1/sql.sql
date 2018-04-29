SELECT name, count(*) as phones_amount, TIMESTAMPDIFF(YEAR, FROM_UNIXTIME(users.birth_date), NOW()) as age FROM users 
JOIN phone_numbers ON users.id = phone_numbers.user_id
WHERE users.gender = 2
GROUP BY name
HAVING age >= 18 and age <= 22