# Image Upload

This project was generated with [Symfony] v5.4

## Development server

Run `php bin/console server:run` for a dev server. Navigate to `http://localhost:8000/`. The app will automatically reload if you change any of the source files.

## Clear Cache

php bin/console cache:clear --env=dev

## After installing the project RUN the below command

### ADD FULLTEXT to the columns of table

ALTER TABLE image_file ADD FULLTEXT (`tags`, `image_name`);