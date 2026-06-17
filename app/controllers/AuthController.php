<?php

class AuthController extends Controller {
    
    // View login page
    public function loginPage() {
        if (isset($_SESSION['user'])) {
            $this->redirect('/admin');
        }
        $this->render('auth/login', ['pageTitle' => 'Giriş Yap']);
    }

    // Handle Login submission
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error_message'] = "Lütfen e-posta ve şifrenizi girin.";
            $this->redirect('/login');
        }

        $userModel = new User();
        $user = $userModel->getByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            $_SESSION['success_message'] = "Hoş geldiniz, " . htmlspecialchars($user['name']) . "!";
            
            if ($user['role'] === 'admin') {
                $this->redirect('/admin');
            } else {
                $this->redirect('/profile');
            }
        } else {
            $_SESSION['error_message'] = "Hatalı e-posta adresi veya şifre.";
            $this->redirect('/login');
        }
    }

    // View registration page
    public function registerPage() {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->render('auth/register', ['pageTitle' => 'Kayıt Ol']);
    }

    // Handle new user registration
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/register');
        }

        $name = trim($_POST['name'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if (empty($name) || empty($email) || empty($password)) {
            $_SESSION['error_message'] = "Lütfen tüm alanları doldurun.";
            $this->redirect('/register');
        }

        $userModel = new User();
        
        // Check if email already exists
        if ($userModel->getByEmail($email)) {
            $_SESSION['error_message'] = "Bu e-posta adresi ile zaten kayıtlı bir hesap var.";
            $this->redirect('/register');
        }

        // Create new customer
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userId = $userModel->create([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'customer'
        ]);

        if ($userId) {
            $_SESSION['success_message'] = "Kaydınız başarıyla oluşturuldu! Şimdi giriş yapabilirsiniz.";
            $this->redirect('/login');
        } else {
            $_SESSION['error_message'] = "Kayıt işlemi sırasında bir hata oluştu. Lütfen tekrar deneyin.";
            $this->redirect('/register');
        }
    }

    // View customer profile
    public function profile() {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error_message'] = "Profilinizi görüntülemek için lütfen giriş yapın.";
            $this->redirect('/login');
        }

        // Admins should go to the admin dashboard
        if ($_SESSION['user']['role'] === 'admin') {
            $this->redirect('/admin');
        }

        $userId = $_SESSION['user']['id'];
        $userModel = new User();
        $user = $userModel->getById($userId);

        $this->render('auth/profile', [
            'pageTitle' => 'Profilim',
            'user' => $user
        ]);
    }

    // View forgot password request page
    public function forgotPasswordPage() {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }
        $this->render('auth/forgot-password', ['pageTitle' => 'Şifremi Unuttum']);
    }

    // Handle forgot password request submission
    public function forgotPasswordSubmit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/forgot-password');
        }

        $email = strtolower(trim($_POST['email'] ?? ''));

        if (empty($email)) {
            $_SESSION['error_message'] = "Lütfen e-posta adresinizi girin.";
            $this->redirect('/forgot-password');
        }

        $userModel = new User();
        $user = $userModel->getByEmail($email);

        if (!$user) {
            // Keep message generic/safe, or let them know
            $_SESSION['success_message'] = "Şifre sıfırlama bağlantısı e-posta adresinize gönderildi (Kullanıcı kayıtlıysa).";
            $this->redirect('/forgot-password');
            return;
        }

        // Generate strong secure token
        $token = bin2hex(random_bytes(32));
        $resetModel = new PasswordReset();
        $resetModel->createToken($email, $token);

        // Build elegant lüks email body
        $resetLink = BASE_URL . "/reset-password/" . $token;
        
        $emailBody = "
        <div style='font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #f0e3de;'>
            <div style='text-align: center; margin-bottom: 30px;'>
                <h1 style='color: #2c2c2c; font-family: Georgia, serif; font-size: 28px; margin: 0;'>MaxPerry</h1>
                <span style='font-size: 9px; letter-spacing: 2px; color: #a49b99;'>ZARAFETİN VE LÜKSÜN ADRESİ</span>
            </div>
            
            <p style='font-size: 14px; color: #555; line-height: 1.6;'>
                Sayın Müşterimiz,<br><br>
                MaxPerry hesabınız için şifre sıfırlama talebinde bulundunuz. Yeni bir şifre belirlemek için lütfen aşağıdaki lüks butona tıklayın:
            </p>
            
            <div style='text-align: center; margin: 30px 0;'>
                <a href='{$resetLink}' style='background-color: #2c2c2c; color: #ffffff; padding: 12px 30px; text-decoration: none; font-size: 12px; font-weight: bold; letter-spacing: 1px; border-radius: 2px;'>ŞİFREMİ SIFIRLA</a>
            </div>
            
            <p style='font-size: 11px; color: #a49b99; line-height: 1.6;'>
                Eğer bu talebi siz yapmadıysanız, lütfen bu e-postayı dikkate almayın. Bu bağlantı güvenlik amacıyla sınırlı süreyle geçerlidir.<br><br>
                Zarif günler dileriz,<br>
                <strong>MaxPerry Ekibi</strong>
            </p>
        </div>";

        // Send beautiful HTML e-mail
        $isSent = Mailer::send($email, "MaxPerry Şifre Sıfırlama Talebi", $emailBody);

        if ($isSent) {
            $_SESSION['success_message'] = "Şifre sıfırlama bağlantısı başarıyla e-posta adresinize gönderildi.";
        } else {
            $_SESSION['error_message'] = "E-posta gönderimi sırasında bir sorun oluştu. Lütfen daha sonra deneyin.";
        }
        $this->redirect('/forgot-password');
    }

    // View reset password token page
    public function resetPasswordPage($token) {
        if (isset($_SESSION['user'])) {
            $this->redirect('/');
        }

        $resetModel = new PasswordReset();
        $record = $resetModel->getByToken($token);

        if (!$record) {
            $_SESSION['error_message'] = "Geçersiz veya süresi dolmuş şifre sıfırlama bağlantısı.";
            $this->redirect('/forgot-password');
        }

        $this->render('auth/reset-password', [
            'pageTitle' => 'Şifre Sıfırlama',
            'token' => $token
        ]);
    }

    // Handle actual password reset submission
    public function resetPasswordSubmit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('/login');
        }

        $token = $_POST['token'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($token) || empty($password)) {
            $_SESSION['error_message'] = "Lütfen yeni şifrenizi girin.";
            $this->redirect('/forgot-password');
        }

        $resetModel = new PasswordReset();
        $record = $resetModel->getByToken($token);

        if (!$record) {
            $_SESSION['error_message'] = "Geçersiz veya süresi dolmuş şifre sıfırlama bağlantısı.";
            $this->redirect('/forgot-password');
        }

        $userModel = new User();
        $success = $userModel->updatePasswordByEmail($record['email'], $password);

        if ($success) {
            // Delete token record after success
            $resetModel->deleteByEmail($record['email']);
            $_SESSION['success_message'] = "Şifreniz başarıyla güncellendi! Yeni şifrenizle giriş yapabilirsiniz.";
            $this->redirect('/login');
        } else {
            $_SESSION['error_message'] = "Şifre güncellenirken hata oluştu.";
            $this->redirect('/forgot-password');
        }
    }

    // Logout session
    public function logout() {
        unset($_SESSION['user']);
        $_SESSION['success_message'] = "Başarıyla çıkış yaptınız.";
        $this->redirect('/');
    }
}
