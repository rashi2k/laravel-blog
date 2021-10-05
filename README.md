
## Installation
pull the master branch.

-create mysql database and  update details in .env file.

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=database username here
DB_PASSWORD=database password here

- run the command npm install
- run the command npm run dev

- run the command php artisan db:seed --class=PermissionTableSeeder 
- run the command php artisan db:seed --class=CreateAdminUserSeeder 
- run the command php artisan db:seed --class=CreateRegularRoleSeeder 
- run the commnd php artisan migrate 
- run the commnad php artisan serve 

### Admin login credentials
-  username - admin@gmail.com
-  password - 123456


### How to use
- Log as admin
- Update Regular User role permission with create/update/view/delete permissions for post and comment.
- then Add new posts