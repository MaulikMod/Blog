@include('header')

<style>
  :root {
    --accent: #ffc107;
    --dark: #0f1114;
    --card: #1a1d23;
    --border: rgba(255, 255, 255, 0.08);
    --text: #e4e6eb;
    --soft: #9aa0aa;
  }

  body {
    background: var(--dark);
    color: var(--text);
  }

  .profile-wrapper {
    padding: 60px 0;
  }

  .profile-card {
    background: var(--card);
    border: 1px solid var(--border);
    border-radius: 16px;
    padding: 30px;
  }

  .profile-avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid var(--accent);
  }

  .profile-name {
    font-weight: 700;
    font-size: 1.3rem;
  }

  .profile-email {
    color: var(--soft);
    font-size: 0.9rem;
  }

  .form-control {
    background: #111418;
    border: 1px solid var(--border);
    color: var(--text);
  }

  .form-control:focus {
    border-color: var(--accent);
    box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.2);
  }

  .btn-accent {
    background: var(--accent);
    color: #000;
    font-weight: 600;
    border-radius: 999px;
  }

  .btn-accent:hover {
    background: #ffca2c;
  }

  .stats-box {
    background: #111418;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    border: 1px solid var(--border);
  }

  .stats-box h5 {
    color: var(--accent);
    font-weight: 700;
  }

  @media(max-width:768px) {
    .profile-avatar {
      width: 80px;
      height: 80px;
    }
  }

</style>

<div class="container profile-wrapper">

  <div class="row g-4">

    <!-- LEFT SIDE -->
    <div class="col-lg-4">
      <div class="profile-card text-center">

        <!-- Avatar Center Wrapper -->
        <div class="d-flex justify-content-center">

          @if(!empty(session('user.profile_pic')))
          <img src="{{ session('user.profile_pic') }}" class="profile-avatar mb-3" style="display:block;">
          @else
          <div class="profile-avatar mb-3 d-flex align-items-center justify-content-center" style="background:#ffc107; color:#000; font-weight:700; font-size:3rem;">
            {{ strtoupper(substr(session('user.name') ?? 'U', 0, 1)) }}
          </div>
          @endif

        </div>

        <div class="profile-name">
          {{ session('user.name') ?? 'User Name' }}
        </div>

        <div class="profile-email">
          {{ session('user.email') ?? 'user@email.com' }}
        </div>

        <hr style="border-color:var(--border)">

        <div class="row g-2">
          <div class="col-6">
            <div class="stats-box">
              <h5>{{ $postCount ?? 0 }}</h5>
              <small>Posts</small>
            </div>
          </div>
          <div class="col-6">
            <div class="stats-box">
              <h5>{{ $commentCount ?? 0 }}</h5>
              <small>Comments</small>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- RIGHT SIDE -->
    <div class="col-lg-8">
      <div class="profile-card">

        <h5 class="mb-3">Edit Profile</h5>

        @if(session('success'))
            <div class="alert-flash d-flex align-items-center gap-2 mb-4 flash-msg"
                 style="background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.3);color:#86efac;padding:12px 16px;border-radius:10px;font-size:.88rem;">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert-flash d-flex align-items-center gap-2 mb-4 flash-msg"
                 style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#fca5a5;padding:12px 16px;border-radius:10px;font-size:.88rem;">
                ⚠️ {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/profile/update') }}" enctype="multipart/form-data">
          @csrf

          <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ session('user.name') }}">
          </div>

          <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ session('user.email') }}">
          </div>

          <div class="mb-3">
            <label>Profile Image</label>
            <input type="file" name="profile_pic" class="form-control">
          </div>

          <button class="btn btn-accent px-4">Update Profile</button>
        </form>

      </div>
    </div>

  </div>

</div>

<script>
    // Auto hide flash messages after 5 seconds
    setTimeout(function() {
        var flashes = document.querySelectorAll('.flash-msg');
        flashes.forEach(function(flash) {
            flash.style.transition = 'opacity 0.5s ease';
            flash.style.opacity = '0';
            setTimeout(() => flash.style.display = 'none', 500);
        });
    }, 5000);
</script>

@include('footer')
