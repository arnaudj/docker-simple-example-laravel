# docker-simple-example-laravel

## Implementation steps:

Install composer globally and add it to \$PATH - https://getcomposer.org/doc/03-cli.md#global

- Install Laravel: `composer global require laravel/installer`
- Create a new project: `laravel new project`. It creates a new local laravel app in `project/`, along with laravel as a dependency in `project/vendor/` (gitignored)

## TODOs

- Configure Apache for Laravel (serve from public/, mod rewrite, etc) - https://laravel.com/docs/6.x#configuration
