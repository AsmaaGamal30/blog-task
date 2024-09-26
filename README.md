# Blog Application

This is a simple blog application built using Laravel 11.
## Requirements

- PHP >= 8.1
- Composer
- Node.js and NPM
- MySQL
- A Pusher account

## Installation Instructions

Follow the steps below to set up the project on your local machine:

### 1. Clone the Repository

Open your command prompt or terminal and run the following command to clone the repository:

```bash
git clone https://github.com/AsmaaGamal30/blog-task.git
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Set Up Environment Variables
```bash
copy .env.example .env
```
Edit the .env file to set your database, Pusher, and broadcasting credentials.

### 5. Install Pusher and Laravel Echo
Install Pusher PHP SDK
Run the following command to install the Pusher PHP SDK:
```bash
composer require pusher/pusher-php-server
```
Install Laravel Echo
Run the following command to install Laravel Echo:
```bash
npm install --save laravel-echo pusher-js
```

### 6. Generate Application Key
```bash
php artisan key:generate
```

### 7. Run Migrations
```bash
php artisan migrate
```

### 8. Install Node.js Packages
Make sure you have Node.js and NPM installed. Then run the following command to install the required JavaScript packages:
```bash
npm install
```

### 9. Compile Assets
Run the following command to compile your assets:
```bash
npm run dev
```

### 10. Create Storage Link
To create a symbolic link from the public/storage directory to the storage/app/public directory, run the following command:
```bash
php artisan storage:link
```

### 11. Start the Development Server
Now you can start the Laravel development server with the following command:
```bash
php artisan serve
```

### 12. Access the Application
Open your web browser and visit http://localhost:8000 to view your application.
