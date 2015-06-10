# World Records

This application aims to centralize all world records in one place.

It allows everyone to see all records, sorted by their addition date, once they
are validated. There is also a submission list allowing moderators to validate
them (so they can appear in the world record list).

## Installation

For development:

```
composer install
php app/console assets:install --env=dev --symlink
php app/console assetic:dump --env=dev web
php app/console doctrine:database:create
php app/console doctrine:migrations:migrate
```
