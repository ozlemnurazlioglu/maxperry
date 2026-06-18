# MaxPerry Abiye - Premium E-Ticaret Web Sitesi

MaxPerry abiye ve lüks gece elbisesi mağazası için özel olarak tasarlanmış, **Soft Modern** (Açık Pembe, Rose Gold, Beyaz) esintilerine sahip, yüksek kaliteli ve güvenli bir e-ticaret web sitesidir. 

Proje, herhangi bir harici kütüphane veya ağır framework bağımlılığı olmadan, temiz ve güvenli kodlama prensipleriyle sıfırdan **Özel PHP MVC (Model-View-Controller) Mimarisi** kullanılarak geliştirilmiştir.

---

## 🌟 Öne Çıkan Özellikler

*   **Zarif ve Premium Tasarım:** Playfair Display ve Montserrat yazı tipleri, yumuşak pembe-altın geçişleri, estetik gölgelendirmeler ve lüks marka çizgisi.
*   **Özel PHP MVC Mimarisi:** Router (Yönlendirici), Base Controller ve Model sınıflarıyla organize edilmiş, genişletilebilir ve temiz klasör yapısı.
*   **Dinamik Katalog & Filtreleme:** Ürünlerin kategorilere göre süzülmesi, stok uyarı rozetleri, detaylı ürün açıklamaları ve beden/beden seçenekleri.
*   **Çift Yönlü Sepet Yönetimi:** Ürünlerin beden seçeneğiyle (34, 36, 38, 40, 42) sepete eklenmesi, sepet sayfasında adet güncellenmesi ve otomatik stok kontrolü.
*   **İşlem (Transaction) Destekli Sipariş:** Sipariş oluşturulurken veritabanında "Transaction" kullanılarak aynı anda stokların güvenle düşürülmesi ve sepetin boşaltılması.
*   **Güvenli Kullanıcı Oturumu (Auth):** SQL Injection koruması (PDO), XSS saldırılarına karşı `htmlspecialchars` koruması ve BCRYPT ile şifrelenmiş parola güvenliği.
*   **Müşteri Profili & Sipariş Geçmişi:** Kullanıcıların geçmiş siparişlerini, detaylarını (beden, adet, birim fiyat) ve sipariş durumlarını (Hazırlanıyor, Kargoda, Teslim Edildi) canlı takip edebileceği profil ekranı.
*   **Gelişmiş Yönetici (Admin) Paneli:**
    *   **Genel Bakış (Dashboard):** Toplam ciro, toplam sipariş ve toplam ürün istatistik kartları ve son siparişler listesi.
    *   **Ürün Yönetimi:** Kataloğa yeni lüks abiye ekleme (Türkçe karakter duyarlı otomatik URL dostu *slug* üretici ile) ve ürün silme.
    *   **Sipariş Yönetimi:** Tüm müşteri siparişlerinin içerikleriyle birlikte görüntülenmesi ve tek tıkla sipariş durumunun güncellenmesi.

---

## 📁 Proje Klasör Yapısı

```text
maxperry/
│
├── app/
│   ├── config/
│   │   └── config.php          # Veritabanı bağlantısı ve Base URL ayarları
│   │
│   ├── core/
│   │   ├── Database.php        # PDO tabanlı güvenli Singleton DB bağlantısı
│   │   ├── Router.php          # Temiz URL yapısını sağlayan özel yönlendirici
│   │   ├── Controller.php      # Şablon giydirme ve yönlendirme yapan ana Controller
│   │   └── Model.php           # PDO bağlantısını otomatik miras bırakan ana Model
│   │
│   ├── controllers/
│   │   ├── HomeController.php  # Ana sayfa mantığını yöneten kontrolcü
│   │   ├── ProductController.php # Ürün listeleme ve detay işlemlerini yöneten kontrolcü
│   │   ├── CartController.php   # Sepet güncelleme ve sipariş tamamlama kontrolcüsü
│   │   ├── AuthController.php   # Üye girişi, kayıt ve profil kontrolcüsü
│   │   └── AdminController.php  # Yönetici paneli ve katalog yönetimi kontrolcüsü
│   │
│   ├── models/
│   │   ├── Category.php        # Kategori SQL sorguları
│   │   ├── Product.php         # Ürün ve stok güncelleme SQL sorguları
│   │   ├── User.php            # Kayıt ve giriş SQL sorguları
│   │   └── Order.php           # Sipariş ve sipariş öğeleri (Transaction destekli) SQL sorguları
│   │
│   └── views/
│       ├── layout/
│       │   ├── header.php      # Dinamik sepet badgeli ve kategorili üst alan
│       │   └── footer.php      # Sözleşmeler ve iletişim bilgili zarif alt alan
│       ├── products/
│       │   ├── index.php       # Katalog ve kategori filtreleme ekranı
│       │   └── show.php        # Beden seçmeli ve detaylı ürün ekranı
│       ├── cart/
│       │   ├── index.php       # Sepet tablosu ve sipariş özeti ekranı
│       │   └── checkout.php    # Adres ve ödeme detayları formu
│       ├── auth/
│       │   ├── login.php       # Giriş yapma formu
│       │   ├── register.php    # Kayıt olma formu
│       │   └── profile.php     # Kullanıcı profili ve geçmiş siparişler listesi
│       ├── admin/
│       │   ├── dashboard.php   # İstatistikler ve genel bakış
│       │   ├── products.php    # Ürün listesi ve silme alanı
│       │   ├── add-product.php # Yeni ürün ekleme formu
│       │   └── orders.php      # Sipariş takibi ve durum güncelleme alanı
│       └── 404.php             # Hata / Bulunamadı ekranı
│
├── public/
│   └── assets/
│       └── css/
│           └── style.css       # Özgün lüks marka tasarım kurallarını içeren stil dosyası
│
├── schema.sql                  # Veritabanı şeması ve hazır örnek ürünler/admin verisi
├── index.php                   # SPL Autoloader ve route tanımlamalarını içeren giriş dosyası
└── README.md                   # Proje kullanım kılavuzu
```

---

## 🛠️ Kurulum ve Çalıştırma

### 1. Gereksinimler
*   PHP 7.4 veya üzeri sürüm.
*   MySQL / MariaDB veritabanı sunucusu (XAMPP, WampServer, Laragon vb.).

### 2. Veritabanını İçe Aktarın
*   Veritabanı yöneticinizi açın (phpMyAdmin vb.).
*   `maxperry` adında yeni bir veritabanı oluşturun (karakter seti: `utf8mb4_unicode_ci`).
*   Proje kök dizinindeki `schema.sql` dosyasını bu veritabanına içe aktarın (Import).

### 3. Yapılandırma (`config.php`)
`app/config/config.php` dosyasını açarak kendi yerel veritabanı ayarlarınıza göre güncelleyin:
```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'maxperry');
define('DB_USER', 'root');
define('DB_PASS', ''); // Varsa şifrenizi girin

define('BASE_URL', 'http://localhost:8000'); // Projenizi çalıştıracağınız adres
```

### 4. Projeyi Başlatın
Terminalinizi veya komut satırınızı (PowerShell/CMD) açıp **projenin kök dizinine** gidin ve PHP'nin yerleşik sunucusunu başlatın:
```bash
php -S localhost:8000
```
Tarayıcınızı açıp `http://localhost:8000` adresine giderek MaxPerry web sitesini anında kullanmaya başlayabilirsiniz!

---

### 🛍️ Standart Müşteri Hesabı oluşturmak için:
*   Sağ üst köşedeki profil ikonuna tıklayıp **Kayıt Olun** seçeneğiyle saniyeler içinde yeni bir müşteri hesabı oluşturabilir, sepetinize ürün ekleyip adresinizi girerek siparişinizi başarıyla tamamlayabilirsiniz!
