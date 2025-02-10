<!DOCTYPE html>
<html lang="id">
<head>
    @include('template.head')  
    <style>
        body {
            background: linear-gradient(to right, #007bff, #6610f2);
            height: 100vh;
        }
        .card {
            width: 400px;
            border-radius: 12px;
            padding: 25px;
            background: #fff;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            padding-left: 2.5rem;
            height: 45px;
            border-radius: 8px;
        }
        .input-group-text {
            background: #e9ecef;
            border-right: none;
            border-radius: 8px 0px 0px 8px;
        }
        .form-control:focus {
            box-shadow: 0px 0px 5px #007bff;
            border-color: #007bff;
        }
        .btn-primary {
            border-radius: 8px;
            background: #007bff;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background: #0056b3;
        }
        .swal2-popup {
            font-size: 1rem !important;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center">
    <div class="card shadow-lg">
        <h4 class="text-center mb-3 text-primary">Sign Up</h4>

        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
            @csrf

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                    <input type="text" name="namalengkap" class="form-control" placeholder="Nama Lengkap" value="{{ old('namalengkap') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Password" required>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-geo-alt-fill"></i></span>
                    <textarea name="alamat" class="form-control" placeholder="Alamat">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person-badge"></i></span>
                    <select name="role" class="form-control" required>
                        <option value="administrator">Administrator</option> 
                        <option value="petugas">Petugas</option>
                        <option value="peminjam">Peminjam</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100">Daftar</button>
        </form>

        <p class="text-center mt-3">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none text-primary">Login</a>
        </p>
    </div>

    @include('sweetalert::alert')

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let successMessage = "{{ session('success') }}";
            let errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: successMessage,
                    timer: 2000,
                    showConfirmButton: false
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage,
                    timer: 2000,
                    showConfirmButton: false
                });
            }

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    html: `
                        <ul style='text-align:left;'>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>`,
                    showConfirmButton: true
                });
            @endif
        });
    </script>
</body>
</html>
