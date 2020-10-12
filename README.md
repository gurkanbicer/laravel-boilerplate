# About Laravel Boilerplate
It's providing a fast starting to projects that preparing via Laravel. It contains;

- Laravel 8.x
- Laravel Role Based Authentication (admin, superuser, user, enduser - more is optional)
- Laravel Socialite Integration (github included - more is optional)
- Awesome dashboard interface (with [Stisla](https://github.com/stisla/stisla) admin template) 

### Installation

```
git clone https://github.com/gurkanbicer/laravel-boilerplate.git
cd laravel-boilerplate
composer install
cd resources/assets/stisla
yarn install
cd ../../../
yarn install && yarn run dev
cp .env.example .env
php artisan key:generate
php artisan storage:link
```

You can edit now environment file for change database credentials, oauth and email account credentials etc.

#### App informations

```
APP_NAME="Laravel Boilerplate"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000
```

#### Database Credentials

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravelboilerplate
DB_USERNAME=root
DB_PASSWORD=
```

#### Email Credentials

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"
```

#### Oauth Credentials (Github)

```
GITHUB_CLIENT_ID=foo
GITHUB_CLIENT_SECRET=bar
GITHUB_CLIENT_REDIRECT_URI=http://127.0.0.1:8000/login/github/callback
```

After then, you can migrate database and run the project.

```
php artisan migrate
php artisan serve
```

Open the browser and type to address bar; http://127.0.0.1:8000

### About Roles

There is 4 role. 

- admin (top level tasks and + sub-level role access)
- superuser (middle level tasks + sub-level role access)
- user (basic level tasks + sub-level role access)
- enduser (you can think it as a client)

The first registration process creates the administrator account. End user accounts are created in all subsequent registration processes. If you want you can use roles for different purposes with different management dashboards or you can use roles just as admin and enduser. Or, you can add more. It's up to you.

### Demo

#### Admin

Login URL: https://laravel-boilerplate-test.grkn.co
```
E-Mail Address: admin@laravel-boilerplate.test
Password: 6WcDbivpsugu4Z
```

You can say hello for any queries; http://www.grkn.co/contact
