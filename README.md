# Assignment Social Media Platform

This project is a frontend implementation for a web application built using **Laravel** and **Laravel Breeze** for user authentication. The application includes a **login system** with **Google reCAPTCHA** for added security.

## Features

- **User Authentication**: Using Laravel Breeze for easy and secure authentication.
- **Google reCAPTCHA**: Integrated with **NOCAPTCHA** for verifying user interactions and preventing bots.
- **User Registration and Login**: Allow users to register and login with credentials.

## Technologies Used

- **Laravel**: PHP framework used for backend development.
- **Laravel Breeze**: Simple authentication starter kit for Laravel.
- **NOCAPTCHA**: Google reCAPTCHA integration to secure the application.
- **Blade Templating**: For rendering views.
- **Tailwind CSS**: For styling the frontend.

## User Credentials

You can log in to the application using the following user credentials:

### User 1:
- **Name**: Arunoda Jayasundara
- **Email**: arunoda.test@gmail.com
- **Password**: 12345678

### User 2:
- **Name**: savi Jay
- **Email**: savi.test@gmail.com
- **Password**: 123456789

## Getting Started

### Prerequisites

Make sure you have the following installed:

- **PHP 8.2.12** (provided by XAMPP 8.2.12)
- **XAMPP 8.2.12** (or any other suitable local server environment for PHP)
- **Composer** (for installing Laravel dependencies)
- **Laravel 10.x** (the Laravel framework is used for this project)
- **MySQL** (or any database you plan to use)

### Installation

1. Clone this repository:
   ```bash
   git clone https://github.com/Savi-uop/Assignment--frontend.git

## cause issues with my laptop docker could not able to install. so that part not include.
Thse are the steps i must run
docker-compose up -d nginx mysql

docker-compose.yml
version: '3.8'

services:
  nginx:
    image: nginx:latest
    container_name: nginx
    ports:
      - "8080:80"
    volumes:
      - ./nginx:/etc/nginx/conf.d
      - ./your-laravel-app:/var/www/html
    depends_on:
      - php-fpm
    networks:
      - app-network

  php-fpm:
    build:
      context: ./php-fpm
    container_name: php-fpm
    volumes:
      - ./your-laravel-app:/var/www/html
    networks:
      - app-network

  mysql:
    image: mysql:8.0
    container_name: mysql
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: laravel
      MYSQL_USER: laravel_user
      MYSQL_PASSWORD: laravel_password
    ports:
      - "3306:3306"
    volumes:
      - mysql_data:/var/lib/mysql
    networks:
      - app-network

networks:
  app-network:
    driver: bridge

volumes:
  mysql_data:
----------------------------------------------------------------------------------------------------------------------------

docker-compose build
docker-compose exec php-fpm php artisan migrate
