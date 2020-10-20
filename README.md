<p align="center"><a href="https://see.asseco.com" target="_blank"><img src="https://github.com/asseco-voice/art/blob/main/evil_logo.png" width="500"></a></p>

# Containers

Purpose of this repository is to provide container support to any Laravel model. 

**Container** is an entity for organizing multiple resources under a single logical unit. 

## Example

Having a ``contacts`` table:

```
ID  First name
1   Foo 
2   Bar
3   Baz
4   Boo
5   Far
6   Faz
```

You can logically organize it in 2 containers:

```
ID  Name
1   F named
2   B named
```

Resulting in an organized ``contacts`` table

```
ID  First name  Container ID
1   Foo         1   
2   Bar         2
3   Baz         2
4   Boo         2
5   Far         1
6   Faz         1
```

## Installation

Require the package with ``composer require asseco-voice/laravel-containers``.
Service provider for Laravel will be installed automatically.

## Usage

In order to use this repository the following must be done:

1. Each model which requires container support should use ``Containable`` trait. 
2. Run ``php artisan voice:containers`` which will generate migrations 
for models having `Containable` trait. 
3. Run ``php artisan migrate`` to migrate generated migrations

**Additional notes**: 
- first time migrating, independently of containable trait, a
``containers`` table will be created, and a single default container will be seeded if 
app is in production. Otherwise, it will seed additional containers as well.
- command ``voice:containers`` will create a migration to add an additional 
``container_id`` field to a model. **Do not** simply transfer that ID to original model  
migration and delete this one, or upon next ``voice:containers`` command run, a 
new migration will be created.

``Containable`` trait exposes `containers` relationship, so it doesn't
have to be explicitly set on a model.

This package also exposes ``/api/containers`` endpoints for standard
Laravel CRUD actions.
Also, an ``/api/containers/search`` endpoint is exposed, 
which can be used like [this](https://github.com/asseco-voice/laravel-json-query-builder).
