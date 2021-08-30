## E-Filling Database

This database is acting as a centralised database for e-filling storage for the CTA. This project is build using laravel + livewire. 

## How to install in your system

- **Run ```cp .env.example .env``` command to copy example into real .env file, then edit it with DB credentials and other settings you** want
- **Run ```composer install``` command**
- **Run ```php artisan key:generate``` command**
- **Run ```php artisan storage:link``` command**
- **Run ```php artisan migrate --seed``` command. Seed is important, because it will create the first admin user for you.**
- **If you want dummy data, run ```php artisan db:seed --class=DummyDataSeeder``` command. Seed is important, because it will create the first admin user for you.**

And that's it, Go to the domain and login with these credentials: admin@admin.com - password


## About the project

- When installed all the required permissions and roles will be created. The default user created will have all the three role i.e "Admin","Coordinator","Staff". 
- By default, every user can access their own profile and edit it. 
- The project has incomings, outgoings, sender-destinations, category components which can be accessed by users having the role "Staff" & "Coordinator"
- The project has staff component which can be accessed by users having the role "Coordinator"
- The project has users, roles, permissions and department component which can be accessed by users having the role "Admin"

## Staff

- Incoming/outgoing can be accessed, viewed, edited, created & deleted by users having the role "Staff" & "Coordinator" only by default.
- Every incoming/outgoing record created has fields to store the author's id and their department id.
- Incoming/outgoing can have multiple files uploaded.  
- Every sender-destinations, category has a field to store the author's department id. 

## Coordinator

- Only coordinator has access to the staff by default.
- Coordinator can create, view, edit and delete staff belonging to its own department only
- The staff created will have the same department id as the coordinator

## Admin (us)

- By default, Admin have every roles so it has access to every components
- Admin has access to departments which is used to give access the projects to departments
- Only Admin should have the right to Users, Roles, Permissions & Departments. 

