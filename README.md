ToDo List
====

A Symfony 3.4 project

### Run

- composer install
- php bin/console server:run
- php bin/console doctrine:database:create
- php bin/console doctrine:migrations:migrate
- php bin/console doctrine:fixtures:load

Lastly, browse to /todo

### Unit tests

There are no services in this project yet, so the unit tests are very limited.
To run them:

- ./vendor/bin/phpunit

### Possible Future Features

- Login/Logout and user roles
- ToDo lists