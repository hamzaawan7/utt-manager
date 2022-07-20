# Utt Manager

## Setup

All environments expects the following dependencies to be installed:
-   [Composer](https://getcomposer.org/), a PHP package manager

Once all the above dependencies are installed, you can proceed with the rest of the setup:

```bash
git clone https://github.com/hamzaawan7/utt-manager

composer install
```

You'll then need to setup your environment variables

```bash
cp .env.example .env
```


Run This Commands for Database Tables 

```bash
# insert all table into datbase 
php artisan migrate
```
Run This Command To Enter Jobs in queue 

```bash
# create jobs
php artisan queue:table
```

Note For Create Booking

```bash
# You Need to Add Credential in Environment File For Sending Email After Create Booking 
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=2b5b536ef6e29e
MAIL_PASSWORD=e141285ceedf62
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=3amigos@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

Edit Environment File For Jobs

```bash
# Edit Environment
QUEUE_CONNECTION=database
```

Run Commands for seeder 

```bash
# insert data into database 
php artisan db:seed
```

