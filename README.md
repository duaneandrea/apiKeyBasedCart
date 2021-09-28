<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.
    
    • clone repository
    NB: please not the configurations of this project where set for php version 8.0
    • Run composer install 
    • Create a database and create .env file 
    • run php artisan migrate 
    • 1st step register an account via
		Register Return URL: http://127.0.0.1:8000/api/register
		Method Post
    Body 
    name(required)
    email(required)
    password(required)
    Confirm_password(required)
            
    

    •  Log into account  
		Register Return URL: http://127.0.0.1:8000/api/login
		Method Post
    Body 
    email(required)
    password(required)
            



    •  create products
      	Register Return URL: http://127.0.0.1:8000/api/products
      	Method Post
	Body
	N.B all fields are required 
	{
	“name” : ”product name”,
	“quantity_in_stock” : 100,
	“description”: “some description here”,
	“price” : 12,
	“properties” : “some property string”
    }



    •  get products
      	Register Return URL: http://127.0.0.1:8000/api/products
      	Method get
              


    •  add to cart
 	Authorization header(required)
      	Register Return URL: http://127.0.0.1:8000/api/add_to_cart
      	Method post
              Body 
            ▪ product_id (required)
            ▪ quantity (required)
              


    Get user to cart
      	Register Return URL: http://127.0.0.1:8000/api/user_cart
      	Method get
           Authorization header(required)
              


    •  Decrement cart item quantity
	 Authorization header(required)
      	Register Return URL: http://127.0.0.1:8000/api/decrement_cart
      	Method post
              Body 
            ▪ product_id (required)
              


    •  Increment cart item quantity
	 Authorization header(required)
      	Register Return URL: http://127.0.0.1:8000/api/increment_cart
      	Method post
              Body 
            ▪ product_id (required)
              
        FOR BETTER PRESANTATION OF ENDPOINTS PLEASE FIND 3rdPartyApiTest.postman_collection.json File AND IMPORT IT INTO POSTMAN


