## Website post subscription app

### Running the application
- Clone the project and run `composer install` to install project dependencies.
- cd to project rooot directory, run `php artisan serve`.
- Run this command - `php artisan queue:work` to start the queue worker
- Run this command to resend post notification to subscribers that have not been sent to - `php artisan posts:notify-subscribers`