## E-Filling Database

This database is acting as a centralised database for e-filling storage for the CTA. This project is build using laravel + livewire. 

## How to install in your system

- **Run ```cp .env.example .env``` command to copy example into real .env file, then edit it with DB credentials and other settings you** want
- **Run ```composer install``` command**
- **Run ```php artisan migrate --seed``` command. Seed is important, because it will create the first admin user for you.**
- **Run ```php artisan key:generate``` command**
- **Run ```php artisan storage:link``` command**

And that's it, Go to the domain and login with these credentials: admin@admin.com - password


## Work left

- **Show and Edit for incoming & outgoing**
- **Individual display for incoming & outgoing** 
- ~~File category display~~ 
- ~~Edit, Delete for File Category~~

