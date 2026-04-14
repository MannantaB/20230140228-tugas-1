# Laporan Praktikum Pertemuan 5: Authorization (Role, Gate, Policy)

Pada praktikum ini, dilakukan implementasi sistem **Authorization** pada aplikasi Laravel untuk mengatur hak akses pengguna menggunakan konsep **Role, Gate, dan Policy**.

---

## 1. Penambahan Role pada User

Untuk membedakan hak akses, ditambahkan kolom `role` pada tabel `users`.

**Migration:**

```php
Schema::table('users', function (Blueprint $table) {
    $table->string('role')->default('user')->after('password');
});
```

Kolom ini digunakan untuk menentukan apakah pengguna berperan sebagai **admin** atau **user biasa**.

Selanjutnya, atribut `role` ditambahkan ke `$fillable` pada model `User`.

---

## 2. Implementasi Gate

Gate digunakan untuk mengatur akses secara global.

Gate dengan nama `manage-product` dibuat untuk membatasi akses fitur product hanya untuk admin.

```php
Gate::define('manage-product', function ($user) {
    return $user->role === 'admin';
});
```

Dengan ini, hanya user dengan role admin yang dapat mengakses menu dan halaman product.

---

## 3. Implementasi Policy

Policy digunakan untuk mengatur akses yang lebih spesifik terhadap data.

Policy dibuat untuk model `Product` menggunakan perintah:

```bash
php artisan make:policy ProductPolicy --model=Product
```

**Logika yang digunakan:**

* Admin → dapat mengedit dan menghapus semua data
* User biasa → hanya bisa mengedit/menghapus data miliknya sendiri

```php
public function update(User $user, Product $product)
{
    return $user->role === 'admin' || $user->id === $product->user_id;
}
```

---

## 4. Penerapan pada Sistem

Authorization diterapkan pada beberapa bagian:

* **Navbar**: Menu Product hanya muncul jika user adalah admin (`@can`)
* **Controller**: Menggunakan `$this->authorize()` untuk membatasi akses
* **View Product**: Tombol Edit dan Delete hanya tampil jika user memiliki izin

---

## Kesimpulan

Dengan menerapkan Role, Gate, dan Policy:

* Sistem menjadi lebih aman
* Hak akses pengguna dapat dikontrol dengan jelas
* Admin dan user memiliki batasan akses yang berbeda

---

<img width="2879" height="1467" alt="Screenshot 2026-04-10 224243" src="https://github.com/user-attachments/assets/8680f4c7-e3e3-4401-a095-d58cdf8745b8" />
<img width="2879" height="1450" alt="Screenshot 2026-04-10 224132" src="https://github.com/user-attachments/assets/3c386a44-f452-4c6f-822c-ec46c04856e5" />
<img width="2879" height="1452" alt="Screenshot 2026-04-10 224200" src="https://github.com/user-attachments/assets/d5960ef0-6fa8-43e0-ab40-e5a4ee744b60" />
<img width="2879" height="1464" alt="Screenshot 2026-04-10 224211" src="https://github.com/user-attachments/assets/a0c667cd-2ee1-4d90-8c3e-9c6642c467e8" />
<img width="2879" height="1470" alt="Screenshot 2026-04-10 224224" src="https://github.com/user-attachments/assets/9bce5fc4-8fc7-4819-a0c2-75ef1315b5b2" />
<img width="2879" height="1457" alt="Screenshot 2026-04-10 224308" src="https://github.com/user-attachments/assets/3f5c5f89-d18a-44f6-a014-b7e73420e547" />

