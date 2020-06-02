# Containers

Purpose of this repository is to provide container support to 
any Laravel model. 

## Usage

In order to use this repository the following must be done:

1. Each model which requires container
support should use ``Containable`` trait. 
2. Run ``php artisan asseco-voice:containers`` which
will generate migrations for models having `Containable` trait. 
3. Run ``php artisan migrate`` to migrate generated
migrations
