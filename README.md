# 📋 Manajemen Tugas Kelompok

## 📚 Kelompok 5
**Pemrograman Berbasis Web**

## 👥 Anggota Kelompok
1. **Putri Juliani** (NIM: 4522210015)
2. **Wina Windari Kusdarniza** (NIM: 4522210017)
3. **Daiva Baskoro Upangga** (NIM: 4522210045)

## ✨ Use case
![image](https://github.com/user-attachments/assets/926abca0-72e5-44c7-9a31-ea81de7b88c2)

### ➢ Membuat Akun dan Grup
**Aktor**: `Users`

**Use Case**:
- **Register**: Users melakukan pendaftaran akun baru.
- **Login**: Users yang sudah terdaftar masuk ke dalam sistem.
- **Logout**: Users keluar dari sistem.
- **Membuat Grup**: Users dapat membuat grup baru.
- **Mengundang Anggota**: Users dapat mengundang anggota lain ke dalam grup yang telah dibuat.
- **Melihat Daftar Anggota**: Users dapat melihat daftar anggota yang ada di dalam grup.

### ➢ Membuat Tugas Pada Sistem
**Aktor**: `Users`

**Use Case**:
- **Membuat Tugas**: Users dapat membuat tugas baru.
- **Mengedit Tugas**: Users dapat mengubah detail tugas yang sudah ada.
- **Menghapus Tugas**: Users dapat menghapus tugas yang tidak diperlukan lagi.
- **Menandai Tugas Selesai**: Users dapat menandai tugas sebagai selesai.
- **Menandai Tugas Belum Selesai**: Users dapat menandai tugas yang belum selesai.

---

## ✨ ERD
![image (1)](https://github.com/user-attachments/assets/2a73ef91-1f60-4f6e-90d6-fbf51981be8d)


## 🗃️ Entitas Utama
### 1. **Users**
Mewakili pengguna sistem. Setiap pengguna memiliki atribut berikut:
- **user_id**: Identitas unik pengguna.
- **nama**: Nama lengkap pengguna.
- **alamat email**: Email pengguna untuk autentikasi.
- **kata sandi**: Kata sandi untuk login.
- **tanggal pembuatan akun**: Tanggal akun dibuat.

### 2. **Groups**
Mewakili kelompok atau tim dalam sistem. Setiap grup memiliki atribut berikut:
- **group_id**: Identitas unik grup.
- **nama**: Nama grup.
- **deskripsi**: Deskripsi singkat mengenai grup.
- **tanggal pembuatan**: Tanggal grup dibuat.

### 3. **Tasks**
Mewakili tugas yang diberikan kepada pengguna. Setiap tugas memiliki atribut berikut:
- **task_id**: Identitas unik tugas.
- **nama**: Nama tugas.
- **deskripsi**: Deskripsi tugas.
- **tanggal jatuh tempo**: Deadline tugas.
- **status**: Status tugas (selesai/belum selesai).

---

## 🔗 Hubungan Antar Entitas
1. **Users dan Groups** (hubungan many-to-many)
   - Satu pengguna dapat menjadi anggota dari banyak grup, dan satu grup dapat memiliki banyak anggota.
   - Hubungan ini diimplementasikan melalui tabel perantara `Group_Members`.

2. **Users dan Tasks** (hubungan many-to-many)
   - Satu pengguna dapat ditugaskan pada banyak tugas, dan satu tugas dapat ditugaskan kepada banyak pengguna.
   - Hubungan ini diimplementasikan melalui tabel perantara `Task_Assignments`.

3. **Groups dan Tasks** (hubungan one-to-many)
   - Satu grup dapat memiliki banyak tugas, tetapi satu tugas hanya dapat dimiliki oleh satu grup.

---

## 🌐 Interpretasi Umum
- **Bergabung dalam grup**: Pengguna dapat bergabung dengan berbagai grup yang relevan dengan minat atau proyek mereka.
- **Menerima tugas**: Pengguna dapat ditugaskan pada berbagai tugas yang berasal dari grup-grup yang mereka ikuti.
- **Melacak kemajuan tugas**: Pengguna dapat melihat status tugas yang diberikan kepada mereka dan melacak perkembangannya.
- **Kolaborasi**: Pengguna dapat bekerja sama dengan anggota grup lainnya untuk menyelesaikan tugas-tugas yang diberikan.

---

##  Instalasi
`https://github.com/Wina1704/Kelompok5PBW.git`
