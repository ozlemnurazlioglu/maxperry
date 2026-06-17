<?php
// Ensure session and config are loaded
require_once __DIR__ . '/../../config/config.php';

// Fetch categories dynamically if not already provided
if (!isset($categories)) {
    require_once __DIR__ . '/../../models/Category.php';
    $categoryModel = new Category();
    $categories = $categoryModel->getAll();
}

// Get logged-in user
$currentUser = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? htmlspecialchars($pageTitle) . ' | MaxPerry' : 'MaxPerry Abiye - Premium Gece Elbisesi Mağazası'; ?></title>
    
    <!-- Core Style sheet -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/assets/css/style.css">
    
    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Main Elegant Navigation Header -->
    <header>
        <div class="container" style="max-width: 1300px; width: 95%;">
            <nav class="navbar">
                <!-- Logo -->
                <div class="logo" style="display: flex; align-items: center;">
                    <a href="<?php echo BASE_URL; ?>/" style="display: flex; align-items: center;">
                        <img src="<?php echo BASE_URL; ?>/public/assets/images/maxperry-logo.jpg" alt="MaxPerry Logo" class="main-logo" style="height: 48px; width: auto; object-fit: contain; transition: var(--transition);">
                    </a>
                </div>

                <!-- Hamburger Menu Button for Responsive design -->
                <button id="menu-toggle" class="menu-toggle-btn" title="Menü">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <!-- Navigation Links -->
                <ul class="nav-links" id="nav-links">
                    <li><a href="<?php echo BASE_URL; ?>/">Ana Sayfa</a></li>
                    
                    <!-- Premium Categories Hover Dropdown -->
                    <li class="dropdown">
                        <a href="<?php echo BASE_URL; ?>/products" class="dropdown-toggle">
                            Koleksiyonlar <i class="fa-solid fa-chevron-down" style="font-size: 8px; margin-left: 4px; color: var(--primary);"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo BASE_URL; ?>/products">Tüm Koleksiyonlar</a></li>
                            <?php if (isset($categories) && !empty($categories)): ?>
                                <?php foreach ($categories as $cat): ?>
                                    <li>
                                        <a href="<?php echo BASE_URL; ?>/category/<?php echo htmlspecialchars($cat['slug']); ?>">
                                            <?php echo htmlspecialchars($cat['name']); ?>
                                        </a>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <li><a href="<?php echo BASE_URL; ?>/contact">İletişim</a></li>
                </ul>

                <!-- Navigation Icons (Admin Panel Shortcut / Customer Profile) -->
                <div class="nav-icons">
                    <?php if ($currentUser): ?>
                        <?php if ($currentUser['role'] === 'admin'): ?>
                            <span style="font-size: 11px; font-weight: 500; color: var(--text-dark); margin-right: 10px;">Yönetici</span>
                            <a href="<?php echo BASE_URL; ?>/admin" title="Yönetim Paneli" style="color: var(--primary); margin-right: 10px;">
                                <i class="fa-solid fa-gauge-high"></i>
                            </a>
                        <?php else: ?>
                            <a href="<?php echo BASE_URL; ?>/profile" title="Profilim" style="color: var(--text-dark); opacity: 0.85; margin-right: 10px; display: flex; align-items: center;">
                                <i class="fa-regular fa-user"></i>
                                <span style="font-size: 11px; font-weight: 500; margin-left: 5px;"><?php echo htmlspecialchars(explode(' ', $currentUser['name'])[0]); ?></span>
                            </a>
                        <?php endif; ?>
                        
                        <a href="<?php echo BASE_URL; ?>/logout" title="Çıkış Yap">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo BASE_URL; ?>/login" title="Giriş Yap / Kayıt Ol" style="color: var(--text-dark); opacity: 0.85;">
                            <i class="fa-regular fa-user"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        </div>
    </header>

    <div class="container" style="margin-top: 20px;">
        <!-- Global Alerts Placeholder (for session flash messages) -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="alert alert-success">
                <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i>
                <?php 
                    echo $_SESSION['success_message']; 
                    unset($_SESSION['success_message']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error_message'])): ?>
            <div class="alert alert-error">
                <i class="fa-solid fa-circle-exclamation" style="margin-right: 8px;"></i>
                <?php 
                    echo $_SESSION['error_message']; 
                    unset($_SESSION['error_message']);
                ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Responsive Navigation Drawer Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.getElementById('menu-toggle');
        const navLinks = document.getElementById('nav-links');

        if (menuToggle && navLinks) {
            menuToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                navLinks.classList.toggle('active');
                
                // Toggle icon from bars to xmark (çarpı)
                const icon = menuToggle.querySelector('i');
                if (navLinks.classList.contains('active')) {
                    icon.className = 'fa-solid fa-xmark';
                } else {
                    icon.className = 'fa-solid fa-bars';
                }
            });

            // Close menu if clicking anywhere outside of navigation area
            document.addEventListener('click', function(e) {
                if (navLinks.classList.contains('active') && !navLinks.contains(e.target) && !menuToggle.contains(e.target)) {
                    navLinks.classList.remove('active');
                    menuToggle.querySelector('i').className = 'fa-solid fa-bars';
                }
            });
        }
    });
    </script>
