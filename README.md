# Image Upload

This project was generated with [Symfony] v5.4

## Development server

Run `php bin/console server:run` for a dev server. Navigate to `http://localhost:8000/`. The app will automatically reload if you change any of the source files.

## Clear Cache

php bin/console cache:clear --env=dev

## How to install Project
`.env` file indicate the database.
`DATABASE_URL="mysql://user:password@127.0.0.1:3306/db_company?serverVersion=5.7&charset=utf8mb4"`

Create the database
`php bin/console doctrine:database:create`

Update schema
`php bin/console doctrine:schema:update --force`

Run to add FULLTEXT feature to the `image_file` table
`php bin/console doctrine:query:sql 'ALTER TABLE image_file ADD FULLTEXT ('tags', 'image_name')'`

Install composer
`composer install`

Run Project
`php bin/console server:run`

ADD Heroku addd