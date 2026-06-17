<div class="container" style="max-width: 650px; padding: 40px 15px; margin: 0 auto;">
    
    <div style="background-color: var(--bg-white); border: 1px solid var(--border-color); padding: 40px; box-shadow: var(--shadow-soft); border-radius: 4px; text-align: center;">
        
        <!-- Header -->
        <div style="margin-bottom: 35px;">
            <i class="fa-solid fa-envelope" style="font-size: 32px; color: var(--primary); margin-bottom: 15px;"></i>
            <h1 style="font-family: var(--font-heading); font-size: 28px; color: var(--text-dark); margin-bottom: 0;">Bize Yazın</h1>
        </div>

        <form action="<?php echo BASE_URL; ?>/contact/submit" method="POST" style="text-align: left;">
            
            <!-- Name Input -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="contact_name" style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-dark);">Ad Soyad <span style="color: var(--error);">*</span></label>
                <input type="text" id="contact_name" name="name" class="form-control" placeholder="Örn: Merve Naz" style="background-color: var(--bg-light);" required>
            </div>

            <!-- Email Input -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="contact_email" style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-dark);">E-Posta Adresi <span style="color: var(--error);">*</span></label>
                <input type="email" id="contact_email" name="email" class="form-control" placeholder="ornek@alan.com" style="background-color: var(--bg-light);" required>
            </div>

            <!-- Phone Input -->
            <div class="form-group" style="margin-bottom: 20px;">
                <label for="contact_phone" style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-dark);">Telefon Numarası <span style="font-weight: normal; color: var(--text-muted); text-transform: none;">(İsteğe Bağlı)</span></label>
                <input type="text" id="contact_phone" name="phone" class="form-control" placeholder="Örn: 0555 555 5555" style="background-color: var(--bg-light);">
            </div>

            <!-- Message Textarea -->
            <div class="form-group" style="margin-bottom: 30px;">
                <label for="contact_message" style="font-size: 11px; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; color: var(--text-dark);">Mesajınız <span style="color: var(--error);">*</span></label>
                <textarea id="contact_message" name="message" rows="5" class="form-control" placeholder="Tasarım veya randevu talebiniz hakkında detaylar..." style="resize: none; background-color: var(--bg-light);" required></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-rose" style="width: 100%; padding: 15px; font-weight: bold; letter-spacing: 1px; font-size: 12px; border-radius: 2px;">
                MESAJI GÖNDER <i class="fa-solid fa-paper-plane" style="margin-left: 8px;"></i>
            </button>
            
        </form>

    </div>
</div>
