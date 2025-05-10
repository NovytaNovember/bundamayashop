<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="focus-2/images/favicon.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-image: url('/img/spanduk.png'); /* Gambar latar belakang */
        background-size: cover;
        background-position: center;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        font-family: Arial, sans-serif;
    }

    .auth-form {
        padding: 30px;
        background: rgba(255, 255, 255, 0.8); /* Transparansi untuk card */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Sedikit bayangan */
        border-radius: 10px;
        max-width: 400px;
        width: 100%;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .form-label {
        font-weight: bold;
        text-align: left; /* Teks rata kiri */
        display: block; /* Pastikan teks berada di baris sendiri */
    }

    h4 {
        font-size: 1.5rem;
        color: #333;
        text-align: center;
    }

    .auth-logo img {
        max-width: 100px;
        margin-bottom: 20px;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    /* Styling untuk pesan error */
    .error-message {
        color: red;
        text-align: center;
        font-size: 14px;
        margin-top: 15px;
    }
    </style>
</head>

<body>
    <div class="auth-form">
        <!-- Logo -->
        <div class="auth-logo">
            <img src="/focus-2/images/logo-arutmin.png" alt="Logo">
        </div>
        <h4 class="text-center mb-4">Halaman Login</h4>
        
        <!-- Menampilkan pesan error jika ada -->
        <?php if (session()->getFlashdata('pesan')): ?>
            <div class="error-message"><?= session()->getFlashdata('pesan'); ?></div>
        <?php endif; ?>
        
        <!-- Form Login -->
        <form action="/login" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
