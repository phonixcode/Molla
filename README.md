# Melody

<img alt="Melody Logo" src="">

## About Melody

Melody is an e-commerce website

## Melody Application Development Procedures

1. CD into the application root directory with your command prompt/terminal/git bash.

2. Run `cp .env.example .env`.

3. Inside `.env` file, setup database, mail and other configurations.

4. Run `composer install`.

5. Run `php artisan key:generate` command.

6. Create a new database

7. Run `php artisan migrate:fresh --seed` command.

8. Run `php artisan vendor:publish --tag=lfm_config` command.

9. Run `php artisan vendor:publish --tag=lfm_public` command.

10. Run `php artisan serve` command.

11. Run `php artisan storage:link` command.

12. If the error persist, run the following commands
a. `php artisan migrate:fresh --seed`
b. `php artisan config:clear`
c. `php artisan key:generate`
d. `php artisan config:clear`

## Route Nomenclature
