-- Creation of country table
CREATE TABLE IF NOT EXISTS country
(
    id   INT          NOT NULL,
    name varchar(100) NOT NULL,
    PRIMARY KEY (id)
);

-- Creation of authors table
CREATE TABLE IF NOT EXISTS authors
(
    id         BIGSERIAL   NOT NULL,
    name       VARCHAR(75) NOT NULL,
    country_id INT         NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_country_authors
        FOREIGN KEY (country_id)
            REFERENCES country (id)
);

-- add index to the books name as it has multiple searches based on name
CREATE INDEX pattern_index_on_authors_name ON authors (LOWER(name) varchar_pattern_ops);

-- Creation of books table
CREATE TABLE IF NOT EXISTS books
(
    id        BIGSERIAL   NOT NULL,
    name      VARCHAR(75) NOT NULL,
    author_id INT         NOT NULL,
    pages     INT         NOT NULL,
    PRIMARY KEY (id),
    CONSTRAINT fk_author_books
        FOREIGN KEY (author_id)
            REFERENCES authors (id)
);

-- add index to the books name as it has multiple searches based on name
CREATE INDEX pattern_index_on_books_name ON books (LOWER(name) varchar_pattern_ops);
