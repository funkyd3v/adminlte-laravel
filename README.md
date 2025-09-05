## What’s This For?

You’ll clone this repo, then run a simple script that:

- Installs the latest Laravel **one folder above** where you cloned this repo.
- Sets up Laravel Breeze for you (the auth stuff).
- Use AdminLTE admin template
- Create dynamic sidebar inside config/sidebar.php

Basically, it does all the boring setup work for you!

---

## What You Need Before Starting

Make sure you have:

- PHP (8.0 or newer)  
- Composer  
- Node.js & npm  
- Laravel Installer installed globally
  
## How to use it?
```
git clone https://github.com/funkyd3v/adminlte-laravel.git
cd tailadmin-laravel
php setup.php
```

**Menu items will come from either database table (menus) or config/sidebar.php. If you want database driven then use migration file 2025_08_13_103312_create_menus_table.php.**
