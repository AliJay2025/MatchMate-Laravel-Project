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

## 🎯 Project Overview

MatchMate is a Laravel-based football league management system designed to simplify the organization and tracking of local football competitions.
It allows administrators and managers to manage teams, players, fixtures, and match results, while fans can view league tables and results.

---

## 🚀 Installation Guide

Follow these steps to set up and run the project locally.

### 1. Clone the Repository

```bash id="zptqnx"
git clone https://github.com/AliJay2025/matchmate-laravel.git
cd matchmate-laravel
```

### 2. Install PHP Dependencies

```bash id="suvd4u"
composer install
```

### 3. Set Up Environment File

```bash id="zrqksy"
cp .env.example .env
php artisan key:generate
```

### 4. Configure Database

Edit `.env`:

```env id="8x6onq"
DB_DATABASE=matchmate
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 5. Create Database

```bash id="3vhpu3"
mysql -u root -p -e "CREATE DATABASE matchmate;"
```

### 6. Run Migrations

```bash id="73fujc"
php artisan migrate
```

### 7. Install Frontend Dependencies

```bash id="53d4ej"
npm install
npm run build
```

### 8. Start the Server

```bash id="fxnnq4"
php artisan serve
```

### 9. Open the Application

Visit: http://localhost:8000

---

## 👥 Project Team

| Name             | Role      |
| ---------------- | --------- |
| Ali Jabriil      | Developer |
| Abdihafid Gahayr | Developer |
| Abdirahman Farah | Developer |
