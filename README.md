# The project starter

## Getting started

### Launch the starter project

Fork this repository, then clone your fork, and run this in your newly created directory:

``` bash
composer install
```

Next you need to make a copy of the `.env.example` file and rename it to `.env` inside your project root and configure your database.

Run the following command to generate your app key:

```
php artisan key:generate
```

Run the following complete the database's tables:

```
php artisan migrate
php artisan db:seed 
```

Then start your server:

```
php artisan serve
```

test the introdruser link with adding "?introducer_id=1" as the "get" parameter to your project url path for example:
http://localhost:8000/?introducer_id=1

Notice: I created and almost prepared the "SignUpRequest" as the form validation class but there was not enough time to use it in my controller

