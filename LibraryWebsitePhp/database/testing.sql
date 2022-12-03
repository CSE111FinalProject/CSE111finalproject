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

-- SELECT l_loanid  FROM loans ORDER BY l_loanid DESC LIMIT 1;

-- SELECT b_title FROM Libbooks, books WHERE b_bookid = libbooks_id AND b_title LIKE "%harry%";

-- INSERT INTO "pastLoans" ("pl_loanid","pl_cardid","pl_loandate", "pl_loanstatus","pl_loanlength", "pl_fees","pl_feestatus","pl_comment") VALUES (1,2,3,4,5,6,7,8);

SELECT l_loanid , l_cardid, l_loandate, l_loanstatus, l_loanlength, l_fees, l_feestatus,l_comment, lb_bookid, lb_libraryid, lb_id FROM loans, cardholder, Loanbooks WHERE lb_loanid = l_loanid AND l_cardid = c_cardid AND c_username= "demo96";