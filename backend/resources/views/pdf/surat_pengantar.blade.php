<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Surat Pengantar PKL - {{ $pengajuan->user->name }}</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; line-height: 1.5; margin: 40px; }
        .header { text-align: center; border-bottom: 3px solid black; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2, .header h3, .header p { margin: 0; }
        .content { margin-top: 20px; }
        .signature { margin-top: 50px; text-align: right; float: right; width: 300px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>SMK REKAYASA PERANGKAT LUNAK</h2>
        <p>Jl. Teknologi No. 1, Cyber City, Indonesia Raya</p>
        <p>Email: info@smkrpl.sch.id | Telp: (021) 1234567</p>
    </div>

    <div class="content">
        <p>Nomor: PKL/{{ date('Y') }}/{{ str_pad($pengajuan->id, 4, '0', STR_PAD_LEFT) }}</p>
        <p>Lampiran: -</p>
        <p>Hal: <strong>Permohonan Praktik Kerja Lapangan (PKL)</strong></p>

        <br>
        <p>Kepada Yth.,<br>
        <strong>Pimpinan {{ $pengajuan->dudi->nama_perusahaan }}</strong><br>
        di Tempat</p>

        <br>
        <p>Dengan hormat,</p>
        <p>Dalam rangka pelaksanaan program Praktik Kerja Lapangan (PKL) Tahun Ajaran {{ date('Y') }}, kami bermaksud memohon kesediaan Bapak/Ibu untuk menerima siswa kami melaksanakan PKL di perusahaan yang Bapak/Ibu pimpin.</p>

        <p>Adapun data siswa tersebut adalah sebagai berikut:</p>
        <table style="width: 100%; margin-left: 20px;">
            <tr><td style="width: 30%;">Nama</td><td>: <strong>{{ $pengajuan->user->name }}</strong></td></tr>
            <tr><td>NISN</td><td>: {{ $pengajuan->user->siswa->nisn ?? '-' }}</td></tr>
            <tr><td>Program Keahlian</td><td>: Rekayasa Perangkat Lunak</td></tr>
        </table>

        <p>Demikian surat permohonan ini kami sampaikan. Atas perhatian dan kerja sama Bapak/Ibu, kami ucapkan terima kasih.</p>
    </div>

    <div class="signature">
        <p>Cyber City, {{ date('d F Y') }}</p>
        <p>Kepala Sekolah,</p>
        <br><br><br>
        <p><strong>Dr. Tech. Administrator, M.Kom</strong></p>
        <p>NIP. 19800101 200501 1 001</p>
    </div>
</body>
</html>
