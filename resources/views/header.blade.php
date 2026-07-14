<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daliy Thoughts</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    :root {
      --navbar-bg: rgba(10, 11, 13, 0.80);
      --navbar-border: rgba(255, 255, 255, 0.10);
      --link-hover: #ffc107;
    }

    body {
      font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .navbar {
      background: var(--navbar-bg) !important;
      border-bottom: 1px solid var(--navbar-border);
      backdrop-filter: blur(10px);
      transition: background 0.25s ease, box-shadow 0.25s ease;
    }

    .navbar.sticky-top {
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.25);
    }

    .navbar-brand {
      font-weight: 900;
      font-size: 1.35rem;
      letter-spacing: 0.02em;
      float: left;
    }

    .navbar-brand span {
      color: #ffc107;
    }

    .nav-link {
      font-weight: 500;
      letter-spacing: 0.01em;
      transition: color 0.2s ease, transform 0.2s ease;
    }

    .nav-link:hover,
    .dropdown-item:hover {
      color: var(--link-hover) !important;
      transform: translateY(-1px);
    }

    .nav-link.active {
      color: var(--link-hover) !important;
    }

    .dropdown-toggle::after {
      margin-left: 0.35rem;
      font-size: 0.65rem;
      opacity: 0.85;
      transform: translateY(1px);
    }

    .dropdown-menu {
      border-radius: 0.65rem;
      border: 1px solid rgba(255, 255, 255, 0.12);
      backdrop-filter: blur(12px);
      background: rgba(255, 255, 255, 0.85);
    }

    .form-control {
      min-width: 200px;
      max-width: 280px;
      border-radius: 999px;
    }

    .form-control:focus {
      box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .btn-outline-light {
      border-radius: 999px;
      padding: 0.45rem 1.05rem;
      transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .btn-outline-light:hover {
      transform: translateY(-1px);
      box-shadow: 0 8px 20px rgba(255, 255, 255, 0.12);
    }

    .btn-warning {
      border-radius: 999px;
      padding: 0.45rem 1.1rem;
      font-weight: 600;
      box-shadow: 0 8px 18px rgba(255, 193, 7, 0.18);
    }

    .btn-warning:hover {
      transform: translateY(-1px);
      box-shadow: 0 12px 24px rgba(255, 193, 7, 0.28);
    }

    .navbar-toggler {
      border: 1px solid rgba(255, 255, 255, 0.25);
    }

    .navbar-toggler:focus {
      box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    @media (max-width: 575px) {
      .form-control {
        min-width: 140px;
      }
    }

  </style>
</head>

<body>

  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">

      <div class="col-2">
        <!-- Logo -->
        <a class="navbar-brand m-0" href="{{ url('/home') }}">
          Daliy <span>Thoughts</span>
        </a>
      </div>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="navbarNav">

        <!-- Left Side -->
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link {{ request()->is('home') || request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ url('/home') }}">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact Us</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('blog') ? 'active' : '' }}" href="{{ url('/blog') }}">Blog</a>
          </li>

          <!-- Dropdown – dynamic from MongoDB -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request()->is('category*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              @forelse($navCategories ?? [] as $navCat)
              <li>
                <a class="dropdown-item" href="{{ route('category.show', $navCat->_id) }}">
                  {{ $navCat->category_name }}
                </a>
              </li>
              @empty
              <li><span class="dropdown-item text-muted" style="font-size:.85rem;">No categories yet</span></li>
              @endforelse
            </ul>
          </li>

        </ul>

        <!-- Search -->
        <form class="d-flex align-items-center me-3" role="search">
          <input class="form-control form-control-sm me-2" type="search" placeholder="Search articles" aria-label="Search">
          <button class="btn btn-outline-light btn-sm" type="submit">Search</button>
        </form>

        <!-- Auth Buttons -->
        {{-- <div class="d-flex gap-2">
                    @if(!session()->has('user'))
                        <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm">Login</a>
        <a href="{{ url('/register') }}" class="btn btn-warning btn-sm">Register</a>
        @else
        <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-outline-light btn-sm">Logout</a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        @endif
      </div> --}}
      <div class="d-flex align-items-center">

        @if(!session()->has('user'))
        <!-- Guest -->
        <div class="d-flex gap-2">
          <a href="{{ url('/login') }}" class="btn btn-outline-light btn-sm">Login</a>
          <a href="{{ url('/register') }}" class="btn btn-warning btn-sm">Register</a>
        </div>
        @else
        <!-- User Profile Dropdown -->
        <div class="dropdown">
          <a href="#" class="btn btn-outline-light btn-sm dropdown-toggle d-flex align-items-center gap-2" data-bs-toggle="dropdown" aria-expanded="false">

            <!-- Avatar (optional fallback icon) -->
            <i class="fa-regular fa-user"></i>

            <!-- Dynamic Name -->
            <span>{{ session('user.name') ?? 'User' }}</span>
          </a>

          <ul class="dropdown-menu dropdown-menu-end">

            <li>
              <a class="dropdown-item" href="{{ url('/profile') }}">
                <i class="fa-solid fa-user me-2"></i> Profile
              </a>
            </li>

            <li>
              <a class="dropdown-item" href="{{ url('/settings') }}">
                <i class="fa-solid fa-gear me-2"></i> Settings
              </a>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item text-danger" href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
              </a>
            </li>

          </ul>
        </div>

        <!-- Hidden Logout Form -->
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
          @csrf
        </form>
        @endif

      </div>

    </div>
    </div>
  </nav>
  <!-- Navbar End -->

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
