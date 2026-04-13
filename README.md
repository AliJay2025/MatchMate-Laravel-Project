<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# MatchMate Laravel Project

A football league management system built with Laravel.

---

## 🎬 Demo

<div align="center">
  <img src="matchmate-demo.gif" alt="MatchMate Demo" width="800">
  <br>
  <em>MatchMate - Football League Management in Action</em>
</div>

---

## 🎯 Project Overview

MatchMate is a Laravel-based football league management system designed to simplify the organization and tracking of local football competitions.

It allows administrators and managers to:
- Manage teams and players  
- Record match results  
- View league tables  

Fans can also view fixtures and standings.

---

## ✨ Features

- User authentication (login/register)
- Manage teams and players
- View league tables
- Track match results
- Profile management

---

## 🚀 Installation Guide

Follow these steps to set up and run the project locally.

### 1. Clone the Repository

```bash
git clone https://github.com/AliJay2025/matchmate-laravel.git
cd matchmate-laravel
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Set Up Environment File
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=matchmate
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Create Database
```bash
mysql -u root -p -e "CREATE DATABASE matchmate;"
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Install Frontend Dependencies
```bash
npm install
npm run build
```

### 8. Start the Server
```bash
php artisan serve
```

### 9. Open the Application
```bash
http://localhost:8000
```

---

## 📁 Project Structure
```
matchmate-laravel/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── PlayerController.php
│       ├── TeamController.php
│       ├── ProfileController.php
│       ├── LeagueTableController.php
│       └── Auth/
│           └── (authentication controllers)
│
│   └── Models/
│       ├── Player.php
│       ├── Team.php
│       └── User.php
│
├── resources/
│   └── views/
│       ├── players/
│       │   ├── index.blade.php
│       │   ├── create.blade.php
│       │   ├── edit.blade.php
│       │   └── show.blade.php
│       ├── teams/
│       ├── league/
│       ├── profile/
│       └── layouts/
│
├── routes/
│   └── web.php
│
├── database/
│   └── migrations/
│
├── public/
│   ├── css/
│   │   └── homepage.css
│   └── js/
│       └── validation.js
│
├── config/
├── storage/
├── tests/
├── vendor/
```

---

## 👥 Project Team

| Name             | Role      |
|------------------|----------|
| Ali Jabriil      | Developer |
| Abdihafid Gahayr | Developer |
| Abdirahman Farah | Developer |