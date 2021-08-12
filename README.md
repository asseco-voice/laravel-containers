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

1. Run ``php artisan migrate`` to migrate generated migrations
1. Add a ``Containable`` trait to models you wish having containers. 

# Extending the package

Publishing the configuration will enable you to change package models as
well as controlling how migrations behave. If extending the model, make sure
you're extending the original model in your implementation.
