## Database schema creation

Create a database schema to hold the following information:

**Authors:**
```
"name", "country"
"J. D. Salinger", "US"
"F. Scott. Fitzgerald", "US"
"Jane Austen", "UK"
"Leo Tolstoy", "RU"
"Sun Tzu", "CN"
"Johann Wolfgang von Goethe", "DE"
"Janis Eglitis", "LV"
```

**Books:**
```
"name", "author", "pages"
"The Catcher in the Rye", "J. D. Salinger", 300
"Nine Stories", "J. D. Salinger", 200
"Franny and Zooey", "J. D. Salinger", 150
"The Great Gatsby", "F. Scott. Fitzgerald", 400
"Tender is the Night", "F. Scott. Fitzgerald", 500
"Pride and Prejudice", "Jane Austen", 700
"The Art of War", "Sun Tzu", 128
"Faust I", "Johann Wolfgang von Goethe", 300
"Faust II", "Johann Wolfgang von Goethe", 300
```

Provide the schema and content for Postgres 9.6 or higher, including instructions on how to import it into a local database.


## Produce queries to answer the following questions

- Find author by name "Leo"

- Find books of author "Fitzgerald"

- Find authors without books

- Count books per country

- Count average book length (in pages) per author


## Analyze and explain the time complexity of the queries

Include potential suggestions on how to improve it.
Consider that there might be millions of authors with millions of books.
