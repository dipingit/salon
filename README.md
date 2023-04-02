## Installation

<p>Use the package manager composer for installing required packages.

<p>Do the following commands for project setup</p>

<!-- Github Markdown -->
```bash
git clone https://github.com/dipingit/salon
cd salon
composer install
cp .env.example .env
php artisan key:generate
```

1. Create a database named 'salon'
2. Setting database name, username(root), and password(keep this blank for mysql default settings) on your .env file
3. Do the following instructions if you're done setting database in .env

```bash
php artisan db:seed
```

<p>if SQLSTATE[42S02] error occours while running the seed command try to run the below command<p>
	
```bash
	php artisan migrate:refresh --seed
```

## To Run the application

```
php artisan serve
```

## Admin login

email: tom@gmail.com Password: 123456