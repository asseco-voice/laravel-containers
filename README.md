# Containers

Purpose of this repository is to provide container support to 
any Laravel model. 

**Container** is an entity for organizing multiple resources
under a single logical unit. 

## Installation

Require the package with ``composer require asseco-voice/laravel-containers``.
Service provider for Laravel will be installed automatically.

## Usage

In order to use this repository the following must be done:

1. Each model which requires container support should use ``Containable`` trait. 
2. Run ``php artisan asseco-voice:containers`` which will generate migrations 
for models having `Containable` trait. 
3. Run ``php artisan migrate`` to migrate generated migrations

**Additional notes**: 
- first time migrating, independently of containable trait, a
``containers`` table will be created, and a single default container will be seeded. 
- command ``asseco-voice:containers`` will create a migration to add an additional 
``container_id`` field to a model. **Do not** simply transfer that ID to original model  
migration and delete this one, or upon next ``asseco-voice:containers`` command run, a 
new migration will be created.

``Containable`` trait exposes `containers` relationship, so it doesn't
have to be explicitly set on a model.

This package also exposes ``/api/containers`` endpoints for standard
Laravel CRUD actions.
Also, a ``/api/containers/search`` endpoint is exposed, 
which can be used like [this](https://github.com/asseco-voice/laravel-json-query-builder).

## Configuration

The stock configuration looks like this, and most probably should never
be changed, but if you ever need to override it:

```
'containers' => [
    /**
     * Path to Laravel models. This does not recurse in folders
     */
    'models_path'     => app_path(),
    /**
     * Namespace for Laravel models.
     */
    'model_namespace' => 'App\\',
    /**
     * Namespace to Containable trait
     */
    'trait_path'      => 'Voice\Containers\Traits\Containable',
],
```
