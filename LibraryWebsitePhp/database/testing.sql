-- CREATE TABLE login (
--    person_id INTEGER PRIMARY KEY,
--    username TEXT NOT NULL ,
--    password TEXT NOT NULL
-- );

-- DELETE FROM login;
--  INSERT INTO login (username,password)VALUES("ralphilou","r03129824");

-- Insert data to table here

INSERT INTO books 
VALUES (1, 978-0590353427, 'Harry Potter and the Sorcerer`s Stone', 2015, 'Fiction', 'Good', 'Review -');
INSERT INTO books 
VALUES (2, 978-1668001226, 'It Starts with Us: A Novel (It Ends with Us)', 2022, 'Novel', 'Good', 'Review -');
INSERT INTO books 
VALUES (3, 978-0-380-60012-0, 'The Indian in the Cupboard', 1980, 'Fantasy', 'Good', 'Review -');
INSERT INTO books 
VALUES (4, 978-0-7432-4722-1, 'Fahrenheit 451', 1953, 'Fantasy', 'Good', 'Review -');
INSERT INTO books 
VALUES (5, 978-0199588220, 'The Secret Garden', 2011, 'Childrens Novel', 'Good', 'Review -');
INSERT INTO books 
VALUES (6, 978-0-439-02352-8, 'The Hunger Games', 2008, 'Sci-fi', 'Good', 'Review -');
INSERT INTO books 
VALUES (7, 978-0-545-22724-7, 'Catching Fire', 2009, 'Sci-fi', 'Good', 'Review -');
INSERT INTO books 
VALUES (8, 978-0-439-02351-1, 'Mockingjay', 2010, 'Sci-fi', 'Good', 'Review -');
INSERT INTO books 
VALUES (9, 978-0931988653, 'Your Atari Computer: A Guide to Atari 400/800 Computers', 1982, 'Manual', 'Good', 'Review -');
INSERT INTO books 
VALUES (10, 0-935696-01-6, 'Players Handbook', 1978, 'Manual', 'Good', 'Review -');


INSERT INTO movies
VALUES (1, 'Top Gun: Maverick', 130, 'Tom Cruise', 'Drama, Adventure, Action', 2022, 'Good', 'Review - Good Movie');
INSERT INTO movies
VALUES (2, 'Bullet Train', 126, 'Brad Pitt', 'Suspense, Comedy, Action', 2022, 'Good', 'Review - Good Movie');
INSERT INTO movies
VALUES (3, 'The Adventures of Sharkboy and Lavagirl in 3-D', 93, 'Taylor Lautner', 'Superhero, Adventure', 2005, 'Good', 'Review - Good Movie');
INSERT INTO movies
VALUES (4, 'Speed', 116, 'Keanu Reeves', 'Action', 1994, 'Good', 'Review - Good Movie');
INSERT INTO movies
VALUES (5, 'Speed 2: Cruise Control', 126, 'Sandra Bullock', 'Action', 1997, 'not as good', 'Review - Good Movie');
INSERT INTO movies
VALUES (6, 'The Matrix', 136, 'Keanu Reeves', 'Action, Sci-fi', 1999, 'Good', 'Review - Very Good Movie');
INSERT INTO movies
VALUES (7, 'The Matrix Reloaded', 138, 'Keanu Reeves', 'Action, Sci-fi', 2003, 'Good', 'Review - Very Good Movie');
INSERT INTO movies
VALUES (8, 'The Matrix Revolutions', 129, 'Keanu Reeves', 'Action, Sci-fi', 2003, 'Good', 'Review - Very Good Movie');
INSERT INTO movies
VALUES (9, 'The Matrix Resurrections', 148, 'Keanu Reeves', 'Action, Sci-fi', 2021, 'Good', 'Review - Very Good Movie');
INSERT INTO movies
VALUES (10, 'The Matrix Revisited', 123, 'Lana & Lilly Wachowski', 'Documentory', 2001, 'Good', 'Review - Good Movie');

SELECT *
FROM books, library, Libbooks
WHERE b_title LIKE '%?%'
    AND b_booksid = libbooks_bookid
    AND libbooks_libid = lib_libid
    AND lib_name = '%?%';

SELECT * 
FROM movies, library, Libmovies
WHERE m_title LIKE '%?%'
    AND m_movieid = libmovies_movieid
    AND libmovies_libid = lib_libid
    AND lib_name = '%?%'