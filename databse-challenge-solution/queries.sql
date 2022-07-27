-- Find author by name "Leo"
SELECT
    id,
    name
FROM
    "authors"
WHERE
        LOWER(name) LIKE LOWER('%Leo%')
LIMIT 1;

-- Find books of author "Fitzgerald"
SELECT
    b.id,
    b.name,
    b.author_id
FROM
    "books" AS b
        JOIN "authors" AS a ON b.author_id = a.id
WHERE
        LOWER(a.name)
        LIKE LOWER('%Fitzgerald%');


-- Count books per country
SELECT
    COUNT(*),
    a.country_id
FROM
    "books" AS b
        JOIN "authors" AS a ON b.author_id = a.id
GROUP BY
    a.country_id;

-- Count average book length (in pages) per author
SELECT
    id,
    AVG(pages),
    author_id
FROM
    "books"
GROUP BY id;
