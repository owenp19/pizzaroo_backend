# 🍕 Pizzarro Backend

![Laravel Logo](https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg)

[![Build Status](https://github.com/laravel/framework/workflows/tests/badge.svg)](https://github.com/laravel/framework/actions)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/framework)

---

## 📖 Descripción

Este repositorio contiene el **backend del sistema Pizzarro**, una API RESTful construida con Laravel que gestiona:

- Pedidos de pizzas
- Reservas de mesas
- Administración de usuarios y roles

La API está diseñada para ser consumida por un frontend moderno, alojado en un repositorio separado. Este backend usa autenticación con **Laravel Sanctum**, estructura modular y está preparado para escalar.

---

## 🚀 Tecnologías utilizadas

- PHP 8.1+
- Laravel 10.x
- Composer
- MySQL o MariaDB
- Laravel Sanctum (tokens)
- Swagger (documentación API, opcional)
- PHPUnit (pruebas)

---

## ⚙️ Instalación

```bash
# 1. Clonar el repositorio
git clone https://github.com/tu-usuario/pizzarro-backend.git
cd pizzarro-backend

# 2. Instalar dependencias
composer install

# 3. Configurar archivo de entorno
cp .env.example .env

# 4. Generar clave de la app
php artisan key:generate

# 5. Configurar conexión a la base de datos en .env

# 6. Ejecutar migraciones
php artisan migrate

# 7. (Opcional) Ejecutar seeders
php artisan db:seed

# 8. Iniciar servidor local
php artisan serve


## 🙋 Autor

**Owen Pusey Mendoza**  
Desarrollador backend y fundador de OMwebdesigns
GitHub: [@owenp19]()  
Email: owenpusey@gmail.com  

