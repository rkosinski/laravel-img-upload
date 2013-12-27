## Laravel 4 + jQuery Image Uploader

~~Simple~~ Application written in Laravel 4.
- Upload multiple images
- User account management
- After register possible to view users public / private images
- Pagination in image list (infinite scrolling via jQuery script)
- Information about image (user and date), inputs with links to image
- Image rating system for registered users (AJAX)
- Notification system (latest and history). Notification counter in navigation bar.
- **New!** Upgrade to Laravel 4.1

Also work on mobile devices via responsive design.

[Youtube presentation](http://www.youtube.com/watch?v=3lrkrJQlNJ0) - Some features (like rating system) are not included in the presentation

### Tools

- Laravel 4
- jQuery 1.10.2 (with AJAX)
- Twitter Bootstrap v3.0.0
- Intervention Image Class
- Infinite Scroll - jQuery Plugin

### How to use

1. Clone repo
2. Run `composer install`
3. Run `php artisan migrate` to migrate database tables
3. If you want run `php artisan db:seed` to seed database with example data (such as users)
4. Enjoy it

### TODO

- Users comment system
- Tags (with search)

### License

This application is licensed under the [MIT License](http://opensource.org/licenses/MIT).

Copyright 2013 [Radosław Kosiński](http://rkosinski.pl/)