-- SELECT b_title, b_isbn, b_year, b_genre, b_condition 
--             FROM books, library, Libbooks
--             WHERE b_bookid = libbooks_bookid
--                 AND libbooks_libid = lib_libid
--                 AND lib_name LIKE %Merced%
--              GROUP BY b_title
--             ORDER BY b_genre ASC; 
-- DELETE FROM cardholder WHERE c_username = "demo1";
-- SELECT libbooks_id,b_title,b_year,lib_name FROM Libbooks, library,books WHERE libbooks_libid = lib_libid AND libbooks_bookid = b_bookid and b_title LIKE "%Lord%";
-- -- .mode csv
-- -- .separator ,
-- -- .import database/bookss books
-- DELETE FROM cardholder;

-- .eqp on
-- .expert on
-- select c_address, c_phone, c_acctbal
-- from customer
-- where c_name='Customer#000000010';

<<<<<<< HEAD
-- SELECT l_loanid  FROM loans ORDER BY l_loanid DESC LIMIT 1;

-- SELECT b_title FROM Libbooks, books WHERE b_bookid = libbooks_id AND b_title LIKE "%harry%";
=======
SELECT b_title, b_author, b_isbn, b_year, b_genre --search book by title
FROM books 
WHERE b_title LIKE '%?%'

SELECT m_title, m_length, m_star, m_year, m_genre




>>>>>>> 0159df0e38cc1a2dcdff042b12f3e4d1e9941af6

