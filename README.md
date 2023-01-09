# Stellar
### Installation Guide

## Installation
The guide explains , how you could set this project on your local dev environment or in any
deployment server and how the stellar work.

#### Requirements:
1. PHP version must be equal or greater then 8.0.
2. Latest compser version
3. MySQL DB server
4. Appache
5. Latest versions of Node & NPM

#### Setup Laravel Codebase:

First clone the repo from: https://github.com/Beyondimagine/stellar.git

After cloning the project follow the steps below.
1. Run command:
```composer install```
2. Copy **.env.example** file and paste in the project folder with the name **".env"** , also set
   values in **.env**. If you require some values ask from lead. Specifically set **AWS3** and **MESSAGE BIRD**
   credentials
3. Run command: ```php artisan config:cache```  (To load latest .env config)
4. Run command: ```php artisan migrate``` (before running this make sure the DB credentials
   set in DB)
5. Run command ```php artisan db:seed```
6. install **'php_redis'** extension if not install on php version or comment out this  the in .env **#CACHE_DRIVER=redis**

* Note: if you want work on VueJs module set up the VueJs first

####   VueJS Setup:
1. Install node modules using command: ```npm install```
2. Build the bundle files using command: ```npm run dev```
3. after done the work on VueJs module run command for production build: ```npm run build -- --prod```

Now all setup has been done you can access the site with following credentials:

**Note :** For the local dev environment make user credentials in seeder for login.

#### Workflow of codebase

*  Important Note: every time when make new migration need to run command ```php artisan code:models```

**About this command** ```php artisan code:models```

This is Reliese Laravel package. Reliese Laravel Model Generator aims to speed up the development process of Laravel applications by providing some convenient code-generation capabilities.
The tool inspects your database structure, including column names and foreign keys, in order to automatically generate Models that have correctly typed properties, along with any relationships to other Models.
for more https://github.com/reliese/laravel

### How to  work

**Conversations**
Interact with member through sms api.

**Members**
Admin add  new member  and also  edit the  member

**Assets**
Admin create new asset and share with members  


