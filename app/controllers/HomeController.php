<?php

class HomeController extends Controller {
    
    public function index() {
        $categoryModel = new Category();
        $productModel = new Product();

        // Fetch categories and latest products
        $categories = $categoryModel->getAll();
        $latestProducts = $productModel->getLatest(4);

        $this->render('home', [
            'pageTitle' => 'Ana Sayfa',
            'categories' => $categories,
            'latestProducts' => $latestProducts
        ]);
    }

    // Handle newsletter subscription (AJAX Endpoint)
    public function subscribeNewsletter() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Geçersiz istek yöntemi.']);
            exit;
        }

        $email = strtolower(trim($_POST['email'] ?? ''));

        if (empty($email)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Lütfen e-posta adresinizi girin.']);
            exit;
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'error', 'message' => 'Lütfen geçerli bir e-posta adresi yazın.']);
            exit;
        }

        $subscriberModel = new NewsletterSubscriber();
        
        // If already subscribed, let them know gracefully
        if ($subscriberModel->isSubscribed($email)) {
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'message' => 'E-posta adresiniz bültenimize zaten kayıtlı!']);
            exit;
        }

        $success = $subscriberModel->subscribe($email);

        header('Content-Type: application/json');
        if ($success) {
            echo json_encode(['status' => 'success', 'message' => 'Tebrikler! Bültenimize başarıyla kaydoldunuz.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Kayıt sırasında bir hata oluştu. Lütfen tekrar deneyin.']);
        }
        exit;
    }

    // View Contact page
    public function contact() {
        $this->render('contact', [
            'pageTitle' => 'İletişim & Randevu'
        ]);
    }

    // View About Us page
    public function about() {
        $this->render('about', [
            'pageTitle' => 'Hakkımızda'
        ]);
    }

    // Handle Contact message submission
    public function submitContact() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/contact');
        }
        $this->checkCsrf();

        $name = htmlspecialchars(trim($_POST['name'] ?? ''));
        $email = strtolower(trim($_POST['email'] ?? ''));
        $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
        $message = htmlspecialchars(trim($_POST['message'] ?? ''));

        if (empty($name) || empty($email) || empty($message)) {
            $_SESSION['error_message'] = "Lütfen zorunlu alanları (Ad Soyad, E-Posta, Mesaj) doldurun.";
            $this->redirect('/contact');
        }

        $messageModel = new ContactMessage();
        $success = $messageModel->create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message' => $message
        ]);

        if ($success) {
            $_SESSION['success_message'] = "Mesajınız başarıyla iletildi! En kısa sürede sizinle iletişime geçeceğiz.";
        } else {
            $_SESSION['error_message'] = "Mesajınız iletilirken bir sorun oluştu. Lütfen tekrar deneyin.";
        }
        $this->redirect('/contact');
    }
}
