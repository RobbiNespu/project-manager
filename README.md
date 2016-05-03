# Project Manager
Open Source Project Management System. I'll use this project to keep my freelancer informations up-to-date.


## Instructions to install

1. Clone the github repository
2. Run composer install (if you don't have composer, please go to composer website and install it first).
3. Create a database for this project.
4. Change the file conf/database.php with your database information
5. Run schema.sql on your database.
6. Run schema_update.sh to update the database (Linux. If you are using windows, please run the following: php vendor/bin/doctrine orm:schema-tool:update --force --dump-sql)
7. Go to localhost/projectfolder/login
8. Username and password: admin

