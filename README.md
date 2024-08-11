## Requirements
Before setting up the project, ensure that your development environment meets the following requirements:

1. Xampp: Make sure you have Xampp installed on your machine.
2. HeidiSQL: For database management, use HeidiSQL or PHPMyAdmin.
3. PHP 8.3: Laravel requires PHP, and the project is developed and tested on PHP version 8.3. Make sure you have PHP installed, and the version matches.
```bash
    php --version
```
4. Node.js and npm: Ensure you have Node.js and npm installed for managing front-end 

## Set up
1. Rename .env.example to .env
2. Check .env configurations and set the correct database credentials.
3. Install and Set Up Packages:

```bash
   composer install
   npm install
```
5. Generate Application Key:

```bash
   php artisan key:generate
```
6. Run the database migrations:

```bash
   php artisan migrate
```
7. Link the storage:
```bash
   php artisan storage:link
```
8. Start the Development Server:

```bash
   php artisan serve
   npm run dev
```

## Folder structure

1. Frontend files are located inside 
```bash
   resources/views/
```
2. CSS, JS, Assets are located inside
```bash
   public/assets/
```
