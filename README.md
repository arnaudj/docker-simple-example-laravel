# docker-simple-example-laravel

Deploy easily a simple Laravel app to the cloud in a docker container.

## How it works

The Laravel project is stored in `project/`.

A Dockerfile builds your laravel project along with php and apache2.

The produced image is then ready to run.

## Configuration
Configure your Laravel application as usual, via project/config/app.php, or project/config/.env

## DockerFile
* To deploy a custom php.ini, save it into docker/php and uncomment the corresponding COPY line in the Dockerfile.
* To troubleshoot applicative errors in your Laravel app: set APP_DEBUG=true (cf section Configuration of this page)

## How it was built

### Creating a simple Laravel project

A test Laravel project is created and stored in project/.

Steps followed to create this test project:

- Install composer globally and add it to \$PATH - https://getcomposer.org/doc/03-cli.md#global
- Install Laravel: `composer global require laravel/installer`
- Create a new project: `laravel new project`. It creates a new local laravel app in `project/`, along with laravel as a dependency in `project/vendor/` (gitignored)

## Testing locally

- docker image build -t myapp:1.0 .
- docker run -d -p 8000:80 myapp:1.0
- Go to http://localhost:8000
