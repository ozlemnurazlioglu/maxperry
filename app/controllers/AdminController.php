<?php

class AdminController extends Controller {
    
    // Core check to ensure only Admins can access
    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['error_message'] = "Bu alana erişim yetkiniz bulunmuyor. Lütfen yönetici bilgileriyle giriş yapın.";
            $this->redirect('/login');
        }
    }

    // Admin Dashboard index
    public function index() {
        $productModel = new Product();
        $products = $productModel->getAll();

        // Calculate some basic dashboard stats
        $totalProducts = count($products);

        $this->render('admin/dashboard', [
            'pageTitle' => 'Yönetim Paneli',
            'totalProducts' => $totalProducts
        ]);
    }

    // View products list in Admin
    public function products() {
        $productModel = new Product();
        $products = $productModel->getAll();

        $this->render('admin/products', [
            'pageTitle' => 'Ürün Yönetimi',
            'products' => $products
        ]);
    }

    // View add product page
    public function addProductPage() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $this->render('admin/add-product', [
            'pageTitle' => 'Yeni Ürün Ekle',
            'categories' => $categories
        ]);
    }

    // Handle add product submission
    public function addProduct() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/products');
        }
        $this->checkCsrf();

        $categoryId = (int)($_POST['category_id'] ?? 0);
        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $sku = 'MP-' . rand(110, 999);
        $description = '';
        $price = 0.00;
        $discount_price = null;
        $stock = 1;
        
        // Handle Drag and Drop / standard file upload
        $uploadedImage = $this->handleImageUpload();
        $image_url = $uploadedImage ?? htmlspecialchars(trim($_POST['image_url'] ?? 'default-dress.jpg'));
        
        // Handle direct local video file upload
        $uploadedVideo = $this->handleVideoUpload();
        $video_url = $uploadedVideo ?? (isset($_POST['video_url']) && trim($_POST['video_url']) !== '' ? htmlspecialchars(trim($_POST['video_url'])) : null);

        if (empty($name) || $categoryId <= 0) {
            $_SESSION['error_message'] = "Lütfen ürün adı ve kategori alanlarını doldurun.";
            $this->redirect('/admin/product/add');
        }

        // Generate clean URL slug from name
        $slug = $this->generateSlug($name);

        $productModel = new Product();
        
        // Ensure slug is unique
        $existing = $productModel->getBySlug($slug);
        if ($existing) {
            $slug .= '-' . rand(100, 999);
        }

        $success = $productModel->create([
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'price' => $price,
            'discount_price' => $discount_price,
            'stock' => $stock,
            'image_url' => $image_url,
            'video_url' => $video_url
        ]);

        if ($success) {
            $_SESSION['success_message'] = "'{$name}' başarıyla kataloğa eklendi.";
            $this->redirect('/admin/products');
        } else {
            $_SESSION['error_message'] = "Ürün eklenirken bir hata oluştu. Lütfen tekrar deneyin.";
            $this->redirect('/admin/product/add');
        }
    }

    // View edit product page
    public function editProductPage($id) {
        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            $_SESSION['error_message'] = "Düzenlenmek istenen ürün bulunamadı.";
            $this->redirect('/admin/products');
        }

        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $this->render('admin/edit-product', [
            'pageTitle' => 'Ürün Düzenle: ' . $product['name'],
            'product' => $product,
            'categories' => $categories
        ]);
    }

    // Handle edit product submission
    public function editProduct($id) {
        $id = (int)$id;
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/products');
        }
        $this->checkCsrf();

        $productModel = new Product();
        $product = $productModel->getById($id);

        if (!$product) {
            $_SESSION['error_message'] = "Ürün bulunamadı.";
            $this->redirect('/admin/products');
        }

        $categoryId = (int)($_POST['category_id'] ?? 0);
        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $sku = $product['sku'] ?? ('MP-' . $id);
        $description = '';
        $price = 0.00;
        $discount_price = null;
        $stock = 1;

        // Process existing remaining images and new uploaded images
        $existingImages = htmlspecialchars(trim($_POST['existing_images'] ?? ''));
        $uploadedImage = $this->handleImageUpload();

        if (!empty($uploadedImage)) {
            if (!empty($existingImages)) {
                $image_url = $existingImages . ',' . $uploadedImage;
            } else {
                $image_url = $uploadedImage;
            }
        } else {
            if (!empty($existingImages)) {
                $image_url = $existingImages;
            } else {
                // If everything was deleted, fallback to the manual text input or default-dress.jpg
                $image_url = htmlspecialchars(trim($_POST['image_url'] ?? 'default-dress.jpg'));
            }
        }

        // Handle direct local video file upload
        $uploadedVideo = $this->handleVideoUpload();
        $video_url = $uploadedVideo ?? (isset($_POST['video_url']) && trim($_POST['video_url']) !== '' ? htmlspecialchars(trim($_POST['video_url'])) : $product['video_url']);

        if (empty($name) || $categoryId <= 0) {
            $_SESSION['error_message'] = "Lütfen tüm zorunlu alanları doldurun.";
            $this->redirect('/admin/product/edit/' . $id);
        }

        // Re-generate slug if name has changed
        $slug = $product['slug'];
        if ($product['name'] !== $name) {
            $slug = $this->generateSlug($name);
            $existing = $productModel->getBySlug($slug);
            if ($existing && $existing['id'] != $id) {
                $slug .= '-' . rand(100, 999);
            }
        }

        $success = $productModel->update($id, [
            'category_id' => $categoryId,
            'name' => $name,
            'slug' => $slug,
            'description' => $description,
            'price' => $price,
            'discount_price' => $discount_price,
            'stock' => $stock,
            'image_url' => $image_url,
            'video_url' => $video_url
        ]);

        if ($success) {
            $_SESSION['success_message'] = "'{$name}' başarıyla güncellendi.";
            $this->redirect('/admin/products');
        } else {
            $_SESSION['error_message'] = "Güncelleme sırasında bir hata oluştu.";
            $this->redirect('/admin/product/edit/' . $id);
        }
    }

    // Handle product deletion
    public function deleteProduct($id) {
        $id = (int)$id;
        $productModel = new Product();
        $product = $productModel->getById($id);

        if ($product) {
            $productModel->delete($id);
            $_SESSION['success_message'] = "'{$product['name']}' başarıyla silindi.";
        } else {
            $_SESSION['error_message'] = "Ürün bulunamadı veya zaten silinmiş.";
        }
        $this->redirect('/admin/products');
    }

    // --- Category Management Actions ---

    // View all categories
    public function categories() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $this->render('admin/categories', [
            'pageTitle' => 'Kategori Yönetimi',
            'categories' => $categories
        ]);
    }

    // View add category page
    public function addCategoryPage() {
        $this->render('admin/add-category', [
            'pageTitle' => 'Yeni Kategori Ekle'
        ]);
    }

    // Handle add category submission
    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/categories');
        }
        $this->checkCsrf();

        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $description = htmlspecialchars(trim($_POST['description'] ?? ''));

        if (empty($name)) {
            $_SESSION['error_message'] = "Kategori adı alanı zorunludur.";
            $this->redirect('/admin/category/add');
        }

        $slug = $this->generateSlug($name);
        $categoryModel = new Category();

        // Ensure slug is unique
        $existing = $categoryModel->getBySlug($slug);
        if ($existing) {
            $slug .= '-' . rand(100, 999);
        }

        $success = $categoryModel->create([
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);

        if ($success) {
            $_SESSION['success_message'] = "'{$name}' kategorisi başarıyla oluşturuldu.";
            $this->redirect('/admin/categories');
        } else {
            $_SESSION['error_message'] = "Kategori eklenirken hata oluştu.";
            $this->redirect('/admin/category/add');
        }
    }

    // View edit category page
    public function editCategoryPage($id) {
        $id = (int)$id;
        $categoryModel = new Category();
        $category = $categoryModel->getById($id);

        if (!$category) {
            $_SESSION['error_message'] = "Kategori bulunamadı.";
            $this->redirect('/admin/categories');
        }

        $this->render('admin/edit-category', [
            'pageTitle' => 'Kategori Düzenle: ' . $category['name'],
            'category' => $category
        ]);
    }

    // Handle edit category submission
    public function editCategory($id) {
        $id = (int)$id;
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/admin/categories');
        }
        $this->checkCsrf();

        $categoryModel = new Category();
        $category = $categoryModel->getById($id);

        if (!$category) {
            $_SESSION['error_message'] = "Kategori bulunamadı.";
            $this->redirect('/admin/categories');
        }

        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $description = htmlspecialchars(trim($_POST['description'] ?? ''));

        if (empty($name)) {
            $_SESSION['error_message'] = "Kategori adı boş olamaz.";
            $this->redirect('/admin/category/edit/' . $id);
        }

        $slug = $category['slug'];
        if ($category['name'] !== $name) {
            $slug = $this->generateSlug($name);
            $existing = $categoryModel->getBySlug($slug);
            if ($existing && $existing['id'] != $id) {
                $slug .= '-' . rand(100, 999);
            }
        }

        $success = $categoryModel->update($id, [
            'name' => $name,
            'slug' => $slug,
            'description' => $description
        ]);

        if ($success) {
            $_SESSION['success_message'] = "'{$name}' kategorisi başarıyla güncellendi.";
            $this->redirect('/admin/categories');
        } else {
            $_SESSION['error_message'] = "Güncelleme sırasında hata oluştu.";
            $this->redirect('/admin/category/edit/' . $id);
        }
    }

    // Delete a category
    public function deleteCategory($id) {
        $id = (int)$id;
        $categoryModel = new Category();
        $category = $categoryModel->getById($id);

        if ($category) {
            $categoryModel->delete($id);
            $_SESSION['success_message'] = "'{$category['name']}' kategorisi başarıyla silindi.";
        } else {
            $_SESSION['error_message'] = "Kategori bulunamadı.";
        }
        $this->redirect('/admin/categories');
    }

    // View all registered users (User Management)
    public function users() {
        $userModel = new User();
        $users = $userModel->getAll();

        $this->render('admin/users', [
            'pageTitle' => 'Kullanıcı Yönetimi',
            'users' => $users
        ]);
    }

    // Helper utility to generate clean URL-friendly slugs from Turkish text
    private function generateSlug($text) {
        $find =    ['Ç', 'Ş', 'Ğ', 'Ü', 'İ', 'Ö', 'ç', 'ş', 'ğ', 'ü', 'ı', 'ö'];
        $replace = ['c', 's', 'g', 'u', 'i', 'o', 'c', 's', 'g', 'u', 'i', 'o'];
        $text = str_replace($find, $replace, $text);
        
        $text = preg_replace('/[^a-zA-Z0-9\s-]/', '', $text);
        $text = strtolower(trim($text));
        $text = preg_replace('/[\s-]+/', '-', $text);
        return $text;
    }

    // Secure image upload logic (supports single or multiple file uploads)
    private function handleImageUpload() {
        if (!isset($_FILES['image'])) {
            return null;
        }

        // If it is a multiple upload (arrays of files)
        if (is_array($_FILES['image']['name'])) {
            $uploadedNames = [];
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            $uploadFileDir = __DIR__ . '/../../public/assets/images/';
            
            if (!file_exists($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            foreach ($_FILES['image']['name'] as $key => $name) {
                if ($_FILES['image']['error'][$key] === UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['image']['tmp_name'][$key];
                    $fileSize = $_FILES['image']['size'][$key];
                    
                    $fileNameCmps = explode(".", $name);
                    $fileExtension = strtolower(end($fileNameCmps));
                    
                    if (in_array($fileExtension, $allowedExtensions)) {
                        // Max file size: 5MB
                        if ($fileSize < 5 * 1024 * 1024) {
                            $newFileName = time() . '_' . rand(100, 999) . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $fileNameCmps[0]) . '.' . $fileExtension;
                            $dest_path = $uploadFileDir . $newFileName;
                            
                            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                                $uploadedNames[] = $newFileName;
                            }
                        }
                    }
                }
            }
            
            return !empty($uploadedNames) ? implode(',', $uploadedNames) : null;
        }

        // Standard single file upload fallback
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $fileTmpPath = $_FILES['image']['tmp_name'];
        $fileName = $_FILES['image']['name'];
        $fileSize = $_FILES['image']['size'];
        
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Max file size: 5MB
            if ($fileSize < 5 * 1024 * 1024) {
                $uploadFileDir = __DIR__ . '/../../public/assets/images/';
                if (!file_exists($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                
                $newFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $fileNameCmps[0]) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    return $newFileName;
                }
            }
        }
        return null;
    }

    // Secure video upload logic (max 50MB)
    private function handleVideoUpload() {
        if (!isset($_FILES['video']) || $_FILES['video']['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $fileTmpPath = $_FILES['video']['tmp_name'];
        $fileName = $_FILES['video']['name'];
        $fileSize = $_FILES['video']['size'];
        
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        $allowedExtensions = ['mp4', 'webm', 'ogg'];
        if (in_array($fileExtension, $allowedExtensions)) {
            // Max file size: 50MB
            if ($fileSize < 50 * 1024 * 1024) {
                $uploadFileDir = __DIR__ . '/../../public/assets/videos/';
                if (!file_exists($uploadFileDir)) {
                    mkdir($uploadFileDir, 0755, true);
                }
                
                $newFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9_-]/', '', $fileNameCmps[0]) . '.' . $fileExtension;
                $dest_path = $uploadFileDir . $newFileName;

                if (move_uploaded_file($fileTmpPath, $dest_path)) {
                    return $newFileName;
                }
            }
        }
        return null;
    }

    // View contact messages list (Admin)
    public function messages() {
        $messageModel = new ContactMessage();
        $messages = $messageModel->getAll();

        $this->render('admin/messages', [
            'pageTitle' => 'Gelen Mesajlar',
            'messages' => $messages
        ]);
    }

    // Delete a contact message (Admin)
    public function deleteMessage($id) {
        $messageModel = new ContactMessage();
        $success = $messageModel->delete($id);

        if ($success) {
            $_SESSION['success_message'] = "Mesaj başarıyla silindi.";
        } else {
            $_SESSION['error_message'] = "Mesaj silinirken bir hata oluştu.";
        }
        $this->redirect('/admin/messages');
    }
}
