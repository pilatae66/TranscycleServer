@ECHO OFF
TITLE APPLICATION INITIALIZATOR
ECHO ------------------------------------
ECHO Application Start Process Initiated
ECHO ------------------------------------
ECHO ---------------------------------
ECHO Installing composer dependencies
ECHO ---------------------------------
CALL composer install
ECHO ---------------------------------
ECHO Installing npm dependencies
ECHO ---------------------------------
CALL npm install
ECHO ---------------------------------
ECHO Copying .env file
ECHO ---------------------------------
CALL copy .env.example .env
ECHO ---------------------------------
ECHO generating application key...
ECHO ---------------------------------
CALL php artisan key:generate
ECHO -------------------------------------------------------------
echo Creating Database, migrating tables and seeding default data
ECHO -------------------------------------------------------------
cd ./database
CALL type nul > database.sqlite
cd ..
call php artisan migrate:fresh --seed
call php artisan storage:link
ECHO ---------------------
ECHO Initialization done!
ECHO ---------------------
REM cd vendor/laravel/framework/src/Illuminate/Foundation/Auth/
REM start notepad AuthenticatesUsers.php
REM cd ../../../../../../..
REM start Transcycle Server.bat
@PAUSE
