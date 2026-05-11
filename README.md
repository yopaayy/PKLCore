# 🚀 PKLCore: Enterprise-Level Internship Management API

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-Ready-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Flutter Ready](https://img.shields.io/badge/Flutter_API-Ready-02569B?style=for-the-badge&logo=flutter&logoColor=white)
![Realtime](https://img.shields.io/badge/Realtime-WebSocket-000000?style=for-the-badge&logo=socket.io&logoColor=white)

**PKLCore** adalah *Backend API Service* dan *Admin Dashboard System* ultra-modern yang dirancang khusus untuk mendigitalisasi seluruh ekosistem Praktik Kerja Lapangan (PKL) jurusan Rekayasa Perangkat Lunak (RPL). 

Dibangun dengan arsitektur *scalable* untuk menghubungkan Siswa, Guru Pembimbing, dan Industri (DU/DI) secara *realtime* melalui integrasi aplikasi mobile Flutter.

## ✨ Core Features & Milestones

### 🛡️ Smart Authentication & State Management
*   **Role-Based Access Control (RBAC):** Multi-level login untuk Superadmin, Admin, Guru, Siswa, dan DU/DI.
*   **Strict Profile Validation:** Sistem otomatis yang memvalidasi kelengkapan profil pengguna (Foto, Alamat, Email, dan sinkronisasi otomatis Nomor WhatsApp). 
*   **Transaction Gatekeeper:** Mekanisme *warning system* cerdas yang mencegah pengguna melakukan pembayaran atau pengajuan PKL jika data master mereka belum lengkap.

### 🗺️ Realtime Monitoring & Geolocation
*   **Live Map Tracking:** Pemantauan lokasi siswa PKL secara *realtime* dengan *smart alert* radius area perusahaan.
*   **Digital Presence:** Absensi dan pengisian jurnal harian berbasis koordinat GPS dan foto aktivitas.

### 📄 Automated Digital Workflow
*   **Smart Document Builder:** *Generate* otomatis PDF untuk Surat Permohonan, Pengantar, dan Ijin lengkap dengan *QR Verification*.
*   **Approval Queue System:** Alur persetujuan terpusat dari status *Draft* hingga *Completed*.
*   **Checklist Administrasi:** Validasi keberangkatan dan kepulangan siswa secara digital.

### 🧠 Future-Ready (AI & Analytics)
*   Integrasi analitik performa siswa (*radar chart*).
*   AI Insight Panel untuk memprediksi anomali kehadiran dan rekomendasi tempat industri.

## 💻 Tech Stack
*   **Framework:** Laravel 12 API (RESTful)
*   **Database:** MySQL / PostgreSQL
*   **Auth:** Laravel Sanctum / JWT
*   **Realtime:** Laravel Reverb / Redis WebSocket
*   **Admin Panel:** Filament Admin / Custom Tailwind UI (Dark Mode Premium)

---
*Developed with passion by [@yopaayy](https://github.com/yopaayy) - Building the future of vocational education.*