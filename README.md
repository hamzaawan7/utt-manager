# Utt Manager

## Setup

All environments expects the following dependencies to be installed:
-   [Composer](https://getcomposer.org/), a PHP package manager
-   [Yarn](https://yarnpkg.com/lang/en/), a JavaScript package manager
-   [Imagemagick](https://doc.ubuntu-fr.org/imagemagick), a powerful image optimizer

In addition, the development environment expects:
-   [Laravel Valet](https://laravel.com/docs/5.7/valet), to handle your PHP/MySQL/Redis services

Once all the above dependencies are installed, you can proceed with the rest of the setup:

```bash
git clone git@github.com:UnrankedSmurfs/website.git
cd website

composer install
yarn
```

You'll then need to setup your environment variables

```bash
cp .env.example .env
vim .env
```


Run This Commands for Database Tables 

```bash
# insert all table into datbase 
php artisan migrate

```
Run Commands for seeder 

```bash
# insert data into database 
php artisan db:seed

```