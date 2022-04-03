# Manage PM2 Processes

[![Latest Version on Packagist](https://img.shields.io/packagist/v/SERFF/Pm2Manager.svg?style=flat-square)](https://packagist.org/packages/SERFF/Pm2Manager)
[![Tests](https://github.com/SERFF/Pm2Manager/actions/workflows/tests.yml/badge.svg)](https://github.com/SERFF/Pm2Manager/actions/workflows/tests.yml)

This package contains a manager for PM2 processes

```php
use SERFF\Pm2Manager\Pm2Manager;

$process = Pm2Manager::add('ping google.con'); // returns a process to handle

$process->restart(); // restarts the process
```

You can use various methods for managing PM2 or a process

```php
Pm2Manager::restartAll(); // restart all processes

Pm2Manager::list(); // returns a list of all processes
```

## Installation

You can install the package via composer:

```bash
composer require serff/pm2-manager
```

### Testing

``` bash
composer test
```
