
## Installation
pull the master branch.

-create mysql database and  update details in .env file.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=database username here
DB_PASSWORD=database password here

- Run the command npm install
- Run the command npm run dev
- Run the command composer install
- Run the command php artisan migrate 
- Run the command php artisan db:seed --class=PermissionTableSeeder 
- Run the command php artisan db:seed --class=CreateAdminUserSeeder 
- Run the command php artisan db:seed --class=CreateRegularRoleSeeder 

- Run the command php artisan serve 

### Admin login credentials
-  username - admin@gmail.com
-  password - 123456


### How to use
- Log as admin
- Go to Manage Roles and Add permissions for comments and post for Regualr User role.
- Register new users(These users will have Regular User Role by default)
- Add new posts
- add new comment
- newff