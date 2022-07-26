-- Filling of country
INSERT INTO country (id, "name")
VALUES (1, 'US'),
       (2, 'UK'),
       (3, 'RU'),
       (4, 'CN'),
       (5, 'DE'),
       (6, 'LV');

-- Filling of authors
INSERT INTO authors ("name", country_id)
VALUES
    ('J. D. Salinger', 1),
    ('F. Scott. Fitzgerald', 1),
    ('Jane Austen', 2),
    ('Leo Tolstoy', 3),
    ('Sun Tzu', 4),
    ('Johann Wolfgang von Goethe', 5),
    ('Janis Eglitis', 6);

-- Filling of books
INSERT INTO books ("name", author_id, pages)
VALUES ('The Catcher in the Rye', 1, 300),
       ('Nine Stories', 1, 200),
       ('Franny and Zooey', 1, 150),
       ('The Great Gatsby', 2, 400),
       ('Tender is the Night', 2, 500),
       ('Pride and Prejudice', 3, 700),
       ('The Art of War', 5, 128),
       ('Faust I', 6, 300),
       ('Faust II', 6, 300);


