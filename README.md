# Containers

Purpose of this repository is to provide container support to 
any Laravel model. 

**Container** is an entity representing a logical container
for a collection of other entities which require ACL to be 
enforced on.

## Installation

Require the package with 
``composer require asseco-voice/laravel-containers``.
Service provider for Laravel will be installed automatically.

## Usage

In order to use this repository the following must be done:

1. Each model which requires container
support should use ``Containable`` trait. 
2. Run ``php artisan asseco-voice:containers`` which
will generate migrations for models having `Containable` trait. 
3. Run ``php artisan migrate`` to migrate generated
migrations

**Additional notes**: migrations will generate foreign keys as 
expected by Laravel standards. For anything custom, after running
``php artisan asseco-voice:containers`` edit generated migrations,
but **do not** change table names, those are named as Laravel 
standard for pivot tables. 

``Containable`` trait exposes `containers` relationship so it doesn't
have to be explicitly set on a model.
