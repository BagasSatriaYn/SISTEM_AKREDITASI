<!-- Full Width Header -->
<div class="full-header header">
    <div class="header-content">
        <nav aria-label="breadcrumb" class="header-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title', 'Dashboard')</li>
            </ol>
            <h5 class="mb-0" style="font-size: 1.1rem; color: white;">@yield('title', 'Dashboard')</h5>
        </nav>

        <div class="user-profile">
            <div class="notification-bell">
                <i class="fas fa-bell"></i>
                <span class="notification-badge">3</span>
            </div>
            <a href="#" class="text-white dropdown-toggle" data-bs-toggle="dropdown">
                <img src="{{ asset('images/profile.jpg') }}" alt="User Profile">
            </a>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">Profile</a>
                <a class="dropdown-item" href="#">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Logout</a>
            </div>
        </div>
    </div>
</div>