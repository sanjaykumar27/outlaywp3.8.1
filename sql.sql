-- SELECT category_id, sum(amount) as total from expense group by category_id order by total desc;

-- SELECT category_id, count(*) as total from expense group by category_id order by total desc

-- SELECT invoice_number, invoice_name, sum(amount) as total from expense group by invoice_number order by total desc