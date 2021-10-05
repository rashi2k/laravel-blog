
## Installation
pull the master branch.

create mysql database and db user as below

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=bloogeruser
DB_PASSWORD=root

run the command npm install
run the command npm run dev

run the command php artisan db:seed --class=PermissionTableSeeder 
run the command php artisan db:seed --class=CreateAdminUserSeeder 
run the command php artisan db:seed --class=CreateRegularRoleSeeder 
run the commnd php artisan migrate 
run the commnad php artisan serve 

