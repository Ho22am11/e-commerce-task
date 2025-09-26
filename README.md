
# E-Commerce Task

## Overview
This project is a professional e-commerce backend built with Laravel 12 and php 8.3.24

## Features
- **User Authentication & Authorization**
	- Secure registration and login for users and admins
	- JWT-based authentication
- **Product Management**
	- CRUD operations for products
	- Product listing, details, and search
- **Cart System**
	- Add, update, and remove items from the cart
	- Cart persistence per user
- **Order Management**
	- Place orders from cart
	- View order history and order details
- **Payment Integration**
	- Payment processing with Paymob
	- Payment attempt tracking and transaction logging
- **Admin Panel**
	- Manage products, orders, and users
	- View sales and order statistics
- **Notifications**
	- Order and payment notifications for users by pusher
- **API Structure**
	- RESTful API endpoints
	- Request validation and resourceful responses
- **Testing**
	- Unit and feature tests using Pest and PHPUnit


## Getting Started
1. **Clone the repository**
2. **Install dependencies**
	 ```bash
	 composer install
	 ```
3. **Configure environment**
	 - Copy `.env.example` to `.env` and update settings
4. **Run migrations and seeders**
	 ```bash
	 php artisan migrate --seed
	 ```
5. **Start the development server**
	 ```bash
	 php artisan serve
	 ```

## admin 
 ```bash
     email : admin@gmailcom
     password : 123456
 ```

