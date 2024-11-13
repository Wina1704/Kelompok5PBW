# 📋 Project Web Application

## 📚 Mata Kuliah
**Pemrograman Berbasis Web**

## 👥 Anggota Kelompok
1. **Putri Juliani** (NIM: 4522210015)
2. **Wina Windari Kusdarniza** (NIM: 4522210017)
3. **Daiva Baskoro Upangga** (NIM: 4522210045)

![image](https://github.com/user-attachments/assets/926abca0-72e5-44c7-9a31-ea81de7b88c2)
## ✨ Fitur Utama
Berikut adalah fitur-fitur yang terdapat dalam sistem ini.

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

![image (1)](https://github.com/user-attachments/assets/2a73ef91-1f60-4f6e-90d6-fbf51981be8d)
Penjelasan:
Entitas Utama:
• Users: Mewakili pengguna sistem. Setiap pengguna memiliki identitas 
unik (user_id), nama, alamat email, kata sandi, dan tanggal pembuatan 
akun. 
• Groups: Mewakili kelompok atau tim dalam sistem. Setiap grup 
memiliki identitas unik (group_id), nama, deskripsi, dan tanggal 
pembuatan. 
• Tasks: Mewakili tugas yang diberikan kepada pengguna. Setiap tugas 
memiliki identitas unik (task_id), nama, deskripsi, tanggal jatuh tempo, 
dan status.

Hubungan Antar Entitas:
• Users dan Groups (hubungan many-to-many): Satu pengguna dapat 
menjadi anggota dari banyak grup, dan satu grup dapat memiliki 
banyak anggota. Hubungan ini diimplementasikan melalui tabel 
perantara Group_Members. 
• Users dan Tasks (hubungan many-to-many): Satu pengguna dapat 
ditugaskan pada banyak tugas, dan satu tugas dapat ditugaskan kepada 
banyak pengguna. Hubungan ini diimplementasikan melalui tabel 
perantara Task_Assignments. 
• Groups dan Tasks (hubungan one-to-many): Satu grup dapat 
memiliki banyak tugas, tetapi satu tugas hanya dapat dimiliki oleh satu 
grup.

Interpretasi Umum:
• Bergabung dalam grup: Pengguna dapat bergabung dengan berbagai 
grup yang relevan dengan minat atau proyek mereka. 
• Menerima tugas: Pengguna dapat ditugaskan pada berbagai tugas 
yang berasal dari grup-grup yang mereka ikuti. 
• Melacak kemajuan tugas: Pengguna dapat melihat status tugas yang 
diberikan kepada mereka dan melacak perkembangannya. 
• Kolaborasi: Pengguna dapat bekerja sama dengan anggota grup 
lainnya untuk menyelesaikan tugas-tugas yang diberikan

