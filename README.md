Requirments :

PHP PHP 8.1 or higher).
Composer (PHP dependency manager).
MySQL.
Git (to clone the repository).
Node.js


Here is step by step guide for run this project on your local machine

Step 1: Clone the Repository
git clone https://github.com/NileshKapadia/Docupet.git

Step 2 : Navigate to project directory

Step 3 : Install PHP Dependencies by running following commands
  composer install
  yarn install

Step 4: change .env file to put your credentials db user and psw
    DATABASE_URL="mysql://db_user:db_password@127.0.0.1:3306/pet?serverVersion=8.0"

Step 5: Set Up the Database and schema by running following commands
  php bin/console doctrine:schema:create
  php bin/console doctrine:database:create

Step 6 : start the server and build the app by running following commands
  symfony serve: start -d
  yarn encore dev 


curl request :

curl -X POST http://127.0.0.1:8000/api/pet/create \
     -H "Content-Type: application/json" \
     -d '{"name":"Buddy","type":"Dog","breed":"Labrador","dateOfBirth":"2020-01-01","gender":"Male","isDangerous":0}'

