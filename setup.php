<?php

function checkOS() {
    $os = PHP_OS_FAMILY;
    echo "Detected OS: $os\n";
    return $os;
}

function runCommand($command, $os) {
    echo "\n> $command\n";
    if ($os === 'Windows') {
        $command = str_replace('/', '\\', $command);
    }
    passthru($command, $status);
    if ($status !== 0) {
        echo "\n❌ Command failed: $command\n";
        exit(1);
    }
}

function checkDependencies($os) {
    echo "\n🔍 Checking dependencies...\n";

    // Check PHP
    $phpVersion = phpversion();
    echo "PHP version: $phpVersion\n";
    if (version_compare($phpVersion, '8.1.0', '<')) {
        echo "❌ PHP 8.1 or higher is required.\n";
        exit(1);
    }

    // Check Composer
    exec('composer --version 2>&1', $composerOutput, $composerStatus);
    if ($composerStatus !== 0) {
        echo "❌ Composer is not installed.\n";
        exit(1);
    }
    echo "Composer version: " . implode('', $composerOutput) . "\n";

    // Check Node.js
    exec('node --version 2>&1', $nodeOutput, $nodeStatus);
    if ($nodeStatus !== 0) {
        echo "❌ Node.js is not installed.\n";
        exit(1);
    }
    echo "Node.js version: " . implode('', $nodeOutput) . "\n";

    // Check Laravel Installer
    exec('laravel --version 2>&1', $laravelOutput, $laravelStatus);
    if ($laravelStatus !== 0) {
        echo "⚠️ Laravel installer not found. Installing...\n";
        runCommand('composer global require laravel/installer', $os);
    } else {
        echo "Laravel installer version: " . implode('', $laravelOutput) . "\n";
    }
}

// Step 0: Ask for Laravel project name
echo "Enter Laravel project name: ";
$projectName = trim(fgets(STDIN));
if (empty($projectName)) {
    echo "❌ Project name cannot be empty.\n";
    exit(1);
}

// Detect OS
$os = checkOS();

// Check dependencies
checkDependencies($os);

// Laravel install path (one directory up from current repo)
$installPath = "../{$projectName}";

echo "\n🚀 Installing Laravel into: $installPath\n";
runCommand("laravel new " . escapeshellarg($installPath), $os);

// Step 1: Install Laravel Breeze
chdir($installPath);
echo "\n📦 Installing Laravel Breeze...\n";
runCommand("composer require laravel/breeze --dev", $os);
runCommand("php artisan breeze:install", $os);
// runCommand("npm install", $os);
// runCommand("npm run build", $os);

// 1.1 Replace web.blade.php
echo "\n📝 Moving web.php...\n";
if (file_exists(__DIR__ . "/web.php")) {
    if (!is_dir("routes")) {
        mkdir("routes", 0777, true);
    }
    rename(__DIR__ . "/web.php", "routes/web.php");
    echo "✅ web.php moved to routes/\n";
} else {
    echo "⚠️ web.php not found.\n";
}

// Step 2: Move Menu.php to app/Models
echo "\n📝 Moving Menu.php...\n";
if (file_exists(__DIR__ . "/Menu.php")) {
    if (!is_dir("app/Models")) {
        mkdir("app/Models", 0777, true);
    }
    rename(__DIR__ . "/Menu.php", "app/Models/Menu.php");
    echo "✅ Menu.php moved to app/Models/\n";
} else {
    echo "⚠️ Menu.php not found.\n";
}

// Step 3: Move 2025_08_09_182304_create_menus_table.php to database/migrations
echo "\n📝 Moving 2025_08_13_103312_create_menus_table.php...\n";
if (file_exists(__DIR__ . "/2025_08_13_103312_create_menus_table.php")) {
    if (!is_dir("database/migrations")) {
        mkdir("database/migrations", 0777, true);
    }
    rename(__DIR__ . "/2025_08_13_103312_create_menus_table.php", "database/migrations/2025_08_13_103312_create_menus_table.php");
    echo "✅ 2025_08_13_103312_create_menus_table.php moved to database/migrations/\n";
} else {
    echo "⚠️ 2025_08_13_103312_create_menus_table.php not found.\n";
}

// Step 4: Replace login.blade.php in resources/views/auth
echo "\n📝 Replacing login.blade.php...\n";
if (file_exists(__DIR__ . "/login.blade.php")) {
    if (!is_dir("resources/views/auth")) {
        mkdir("resources/views/auth", 0777, true);
    }
    rename(__DIR__ . "/login.blade.php", "resources/views/auth/login.blade.php");
    echo "✅ login.blade.php replaced in resources/views/auth/\n";
} else {
    echo "⚠️ login.blade.php not found.\n";
}

// Step 5: Replace register.blade.php in resources/views/auth
echo "\n📝 Replacing register.blade.php...\n";
if (file_exists(__DIR__ . "/register.blade.php")) {
    if (!is_dir("resources/views/auth")) {
        mkdir("resources/views/auth", 0777, true);
    }
    rename(__DIR__ . "/register.blade.php", "resources/views/auth/register.blade.php");
    echo "✅ register.blade.php replaced in resources/views/auth/\n";
} else {
    echo "⚠️ register.blade.php not found.\n";
}

// Step 6: Create and replace ViewServiceProvider
runCommand("php artisan make:provider SidebarServiceProvider", $os);
echo "\n📝 Replacing SidebarServiceProvider.php...\n";
if (file_exists(__DIR__ . "/SidebarServiceProvider.php")) {
    if (!is_dir("app/Providers")) {
        mkdir("app/Providers", 0777, true);
    }
    rename(__DIR__ . "/SidebarServiceProvider.php", "app/Providers/SidebarServiceProvider.php");
    echo "✅ SidebarServiceProvider.php replaced in app/Providers/\n";
} else {
    echo "⚠️ SidebarServiceProvider.php not found.\n";
}

// Step 7: Move header.blade.php into Laravel views/layouts
echo "\n📝 Moving header.blade.php...\n";
if (file_exists(__DIR__ . "/header.blade.php")) {
    if (!is_dir("resources/views/layouts")) {
        mkdir("resources/views/layouts", 0777, true);
    }
    rename(__DIR__ . "/header.blade.php", "resources/views/layouts/header.blade.php");
    echo "✅ header.blade.php moved to resources/views/layouts/\n";
} else {
    echo "⚠️ header.blade.php not found.\n";
}

// Step 8: Move footer.blade.php into Laravel views/layouts
echo "\n📝 Moving footer.blade.php...\n";
if (file_exists(__DIR__ . "/footer.blade.php")) {
    if (!is_dir("resources/views/layouts")) {
        mkdir("resources/views/layouts", 0777, true);
    }
    rename(__DIR__ . "/footer.blade.php", "resources/views/layouts/footer.blade.php");
    echo "✅ footer.blade.php moved to resources/views/layouts/\n";
} else {
    echo "⚠️ footer.blade.php not found.\n";
}

// Step 9: Move sidebar.blade.php into Laravel views/layouts
echo "\n📝 Moving sidebar.blade.php...\n";
if (file_exists(__DIR__ . "/sidebar.blade.php")) {
    if (!is_dir("resources/views/layouts")) {
        mkdir("resources/views/layouts", 0777, true);
    }
    rename(__DIR__ . "/sidebar.blade.php", "resources/views/layouts/sidebar.blade.php");
    echo "✅ sidebar.blade.php moved to resources/views/layouts/\n";
} else {
    echo "⚠️ sidebar.blade.php not found.\n";
}

echo "\n📝 Moving app.blade.php...\n";
if (file_exists(__DIR__ . "/app.blade.php")) {
    if (!is_dir("resources/views/layouts")) {
        mkdir("resources/views/layouts", 0777, true);
    }
    rename(__DIR__ . "/app.blade.php", "resources/views/layouts/app.blade.php");
    echo "✅ app.blade.php moved to resources/views/layouts/\n";
} else {
    echo "⚠️ app.blade.php not found.\n";
}

// Step 10: Move sidebar.php into Laravel config folder
echo "\n⚙️ Moving sidebar.php...\n";
if (file_exists(__DIR__ . "/sidebar.php")) {
    if (!is_dir("config")) {
        mkdir("config", 0777, true);
    }
    rename(__DIR__ . "/sidebar.php", "config/sidebar.php");
    echo "✅ sidebar.php moved to config/\n";
} else {
    echo "⚠️ sidebar.php not found.\n";
}

echo "\n🎉 Setup completed successfully!\n";
