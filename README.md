# docker-simple-example-laravel

Deploy easily a simple Laravel app to the cloud in a docker container.

## How it works

The Laravel project is stored in `project/`.

A Dockerfile builds your laravel project along with php and apache2.

The produced image is then ready to run.

## Configuration

Configure your Laravel application as usual, via project/config/app.php, or project/config/.env

Database notes:

- for a local db, use 127.0.0.1. Using 'localhost' will use unix sockets (https://stackoverflow.com/questions/20723803)

## DockerFile

* To deploy a custom php.ini, save it into docker/php and uncomment the corresponding COPY line in the Dockerfile.
* To troubleshoot applicative errors in your Laravel app: set APP_DEBUG=true (cf section Configuration of this page)

## How it was built

### Creating a new Laravel project

A test Laravel project is created and stored in project/.

Steps followed to create this test project:

- Install composer globally and add it to \$PATH - https://getcomposer.org/doc/03-cli.md#global
- Install Laravel: `composer global require laravel/installer`
- Create a new project: `laravel new project`. It creates a new local laravel app in `project/`, along with laravel as a dependency in `project/vendor/` (gitignored)

### Adding your API 

We follow steps of https://laravel.com/docs/5.2/quickstart

- Configure your DB credentials via environment var or .env: example: `DATABASE_URL=mysql://root:@127.0.0.1/myappdb`
- Create your migration file: `php artisan make:migration create_tasks_table --create=tasks`
- Edit the new file created in project/database/migrations, and add `$table->string('name');` in `up()`
- Run the actual DB update: `php artisan migrate`
- Create the task model: `php artisan make:model Task`: a new file is created in app/Task.php

We will implement a REST API controller, we follow the steps of https://laravel.com/docs/6.x/controllers for API routes

- Add a route for your tasks API: routes/api.php, add: `Route::apiResource('tasks', 'TasksController');`
- Create a Controller for tasks: `php artisan make:controller TasksController --api`
- Add Resource (Eloquent to JSON mapper): `php artisan make:resource Task`
- Implement the controller with CRUD operations

## Testing locally

- docker image build -t myapp:1.0 .
- docker run -d -p 8000:80 myapp:1.0
- Go to http://localhost:8000
