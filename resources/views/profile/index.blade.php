<!DOCTYPE html>
<html lang="id">

<head>
    @include('template.head')
    <style>
        .profile-card {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .profile-card .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        .profile-card .card-body {
            font-size: 16px;
        }

        .profile-card .card-text {
            color: #555;
        }

        .profile-card .btn {
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- ======= Header ======= -->
    @include('template.header')
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    @include('template.sidebar')
    <!-- End Sidebar -->

    <main id="main" class="main" style="padding-top: 80px;">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>

        <div class="container mt-5">
            <!-- Card Profile -->
            <div class="card profile-card">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->namalengkap }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $user->Email }}</p>
                    <p class="card-text"><strong>Alamat:</strong> {{ $user->Alamat }}</p>
                    <p class="card-text"><strong>Role:</strong> {{ ucfirst($user->role) }}</p>

                    <a href="{{ route('profile.edit') }}" class="btn btn-primary mt-3">Edit Profile</a>
                </div>
            </div>
            <!-- End Card Profile -->
        </div>


        <!-- script -->
        @include('template.script')
        <!-- script selesai -->

    </main>

</body>

</html>
