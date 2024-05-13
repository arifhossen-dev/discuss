# About
Discuss is a user interactivity discusstion and Blogin application build with Laravel, Inertia and Vue in TDD aproch.

## Installation
In terms of local development, you can use the following requirements:

- PHP 8.3 - with SQLite, GD, and other common extensions.
- Node.js 16 or more recent.
- Vue 3

If you have these requirements, you can start by cloning the repository and installing the dependencies:

```bash
git clone https://github.com/arifhossen-dev/discuss.git

cd discuss
```
Next, install the dependencies using [Composer](https://getcomposer.org):

```bash
composer install
```

After that, set up your `.env` file:

```bash
cp .env.example .env

php artisan key:generate
```
