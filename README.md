# Unrankedsmurfs Boosting

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

The final step is to create "local domain names" for your dev websites:

```bash
cd website
valet link unrankedsmurfs
valel link lol-smurfs
```

This will allow you to access the two websites using the following URLs:

-   `http://www.unrankedsmurfs.test`
-   `http://www.lol-smurfs.test`

## Usage

There are a few scripts that handle compilation, here are the most useful ones:

```bash
# Compile everything (minified, for production)
yarn production

# Compile everything (not minified)
yarn development

# Watch sources for changes, and rebuild Unrankedsmurfs
yarn watch:us

# Watch sources for changes, and rebuild Lol-smurfs
yarn watch:ls
```

## Testing

There are two types of tests:

-   Unit tests that work locally and DO NOT USE any third party service
-   Integration tests that use third party services

```bash
# Run all tests (unit and integrations tests)
composer test-all

# Run unit tests
composer test

# Run all tests in watch mode (unit and integrations tests)
composer test-all:watch

# Run unit tests in watch mode
composer test:watch
```
