{{-- resources/views/blog/create.blade.php --}}
@include('header')

<style>
    /* ─── Variables (match blog.blade.php palette) ── */
    :root {
        --accent:  #ffc107;
        --dark:    #0f1114;
        --card-bg: #1a1d23;
        --card-bd: rgba(255,255,255,0.07);
        --text:    #e4e6eb;
        --soft:    #9199a6;
        --radius:  14px;
    }

    body { background: var(--dark); color: var(--text); overflow-x: hidden; }

    /* ─── Page Hero ─────────────────────────────────── */
    .create-hero {
        position: relative;
        height: 220px;
        background: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?q=80&w=2073&auto=format&fit=crop')
                    center/cover no-repeat;
        display: flex; align-items: center; justify-content: center;
        text-align: center;
    }
    .create-hero::after {
        content: '';
        position: absolute; inset: 0;
        background: linear-gradient(180deg, rgba(15,17,20,.55) 0%, rgba(15,17,20,.92) 100%);
    }
    .create-hero .hero-content { position: relative; z-index: 1; }
    .create-hero h1 {
        font-size: clamp(1.6rem, 4vw, 2.6rem);
        font-weight: 800; letter-spacing: -0.02em; color: #fff;
    }
    .create-hero h1 span { color: var(--accent); }
    .create-hero p { color: rgba(255,255,255,.65); font-size: .95rem; margin-top: .4rem; }

    /* ─── Form Card ─────────────────────────────────── */
    .form-section { padding: 50px 0 80px; }

    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--card-bd);
        border-radius: 18px;
        padding: 42px 44px;
        max-width: 760px;
        margin: 0 auto;
        box-shadow: 0 24px 60px rgba(0,0,0,.4);
    }

    .form-card .card-title {
        font-size: 1.25rem; font-weight: 700;
        color: var(--text); margin-bottom: 28px;
        padding-bottom: 16px;
        border-bottom: 1px solid var(--card-bd);
        display: flex; align-items: center; gap: 10px;
    }
    .form-card .card-title .title-dot {
        width: 8px; height: 8px; border-radius: 50%;
        background: var(--accent); flex-shrink: 0;
    }

    /* ─── Custom Form Inputs ─────────────────────────── */
    .field-group { margin-bottom: 26px; }

    .field-group label {
        display: block;
        font-size: .82rem; font-weight: 600;
        color: var(--soft);
        text-transform: uppercase; letter-spacing: .06em;
        margin-bottom: 8px;
    }

    .field-group .form-control,
    .field-group .form-select {
        background: rgba(255,255,255,.05) !important;
        border: 1px solid var(--card-bd) !important;
        border-radius: 10px !important;
        color: var(--text) !important;
        padding: 11px 16px !important;
        font-size: .93rem;
        transition: border-color .2s, background .2s;
        width: 100%;
    }
    .field-group .form-control:focus,
    .field-group .form-select:focus {
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(255,193,7,.18) !important;
        border-color: var(--accent) !important;
        background: rgba(255,255,255,.08) !important;
    }
    .field-group .form-control::placeholder { color: var(--soft); }
    .field-group .form-select option { background: #1e2128; color: var(--text); }

    /* Textarea */
    .field-group textarea.form-control {
        resize: vertical;
        min-height: 160px;
        line-height: 1.7;
    }

    /* File Input */
    .field-group input[type="file"].form-control {
        padding: 9px 14px;
        cursor: pointer;
    }
    .field-group input[type="file"]::file-selector-button {
        background: rgba(255,193,7,.12);
        border: 1px solid rgba(255,193,7,.3);
        border-radius: 6px;
        color: var(--accent);
        padding: 5px 14px;
        font-size: .82rem; font-weight: 600;
        cursor: pointer;
        transition: background .2s;
        margin-right: 12px;
    }
    .field-group input[type="file"]::file-selector-button:hover {
        background: rgba(255,193,7,.22);
    }

    /* Image Preview */
    #imagePreviewWrap {
        margin-top: 12px; display: none;
    }
    #imagePreview {
        max-height: 200px;
        border-radius: 10px;
        border: 1px solid var(--card-bd);
        object-fit: cover;
    }

    /* Validation error */
    .err-msg { color: #f87171; font-size: .8rem; margin-top: 5px; }

    /* ─── Buttons ────────────────────────────────────── */
    .btn-publish {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 32px;
        background: var(--accent);
        color: #000; font-weight: 700; font-size: .93rem;
        border: none; border-radius: 999px;
        cursor: pointer;
        transition: transform .2s ease, box-shadow .2s ease, background .2s;
        box-shadow: 0 8px 24px rgba(255,193,7,.25);
    }
    .btn-publish:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(255,193,7,.35);
        background: #ffca2c;
    }
    .btn-publish:active { transform: translateY(0); }

    .btn-cancel {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 12px 24px;
        background: transparent;
        color: var(--soft); font-weight: 600; font-size: .88rem;
        border: 1px solid var(--card-bd);
        border-radius: 999px; text-decoration: none;
        transition: all .2s ease;
    }
    .btn-cancel:hover {
        border-color: rgba(255,255,255,.2);
        color: var(--text);
    }

    /* ─── Responsive ─────────────────────────────────── */
    @media (max-width: 575px) {
        .create-hero { height: 170px; }
        .form-card { padding: 26px 20px; }
    }
</style>

{{-- ─── Hero ─────────────────────────────────────────── --}}
<section class="create-hero">
    <div class="hero-content">
        <h1>Write a <span>Blog</span></h1>
        <p>Share your thoughts, ideas &amp; stories with the world</p>
    </div>
</section>

{{-- ─── Form Section ─────────────────────────────────── --}}
<section class="form-section">
    <div class="container">
        <div class="form-card">

            <div class="card-title">
                <span class="title-dot"></span>
                New Blog Post
            </div>

            {{-- Flash: success --}}
            @if(session('success'))
                <div class="alert-flash d-flex align-items-center gap-2 mb-4 flash-msg"
                     style="background:rgba(34,197,94,.12);border:1px solid rgba(34,197,94,.3);color:#86efac;padding:12px 16px;border-radius:10px;font-size:.88rem;">
                    ✅ {{ session('success') }}
                </div>
            @endif

            {{-- Flash: error --}}
            @if(session('error'))
                <div class="alert-flash d-flex align-items-center gap-2 mb-4 flash-msg"
                     style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#fca5a5;padding:12px 16px;border-radius:10px;font-size:.88rem;">
                    ⚠️ {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" id="blogCreateForm">
                @csrf

                {{-- Title --}}
                <div class="field-group">
                    <label for="post-title">Post Title</label>
                    <input type="text" id="post-title" name="title" class="form-control"
                           placeholder="Enter an engaging title…" value="{{ old('title') }}" autocomplete="off">
                    @error('title')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Category --}}
                <div class="field-group">
                    <label for="post-category">Category</label>
                    <select id="post-category" name="category" class="form-select">
                        <option value="">— Select a Category —</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->category_name }}"
                                {{ old('category') === $cat->category_name ? 'selected' : '' }}>
                                {{ $cat->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Post Image --}}
                <div class="field-group">
                    <label for="post-image">Post Image</label>
                    <input type="file" id="post-image" name="post_image" class="form-control"
                           accept="image/*" onchange="previewImage(this)">
                    <div id="imagePreviewWrap">
                        <img id="imagePreview" src="" alt="Image Preview">
                    </div>
                    @error('post_image')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Content --}}
                <div class="field-group">
                    <label for="post-content">Content</label>
                    <textarea id="post-content" name="content" class="form-control"
                              placeholder="Write your blog content here…" rows="7">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Status --}}
                <div class="field-group">
                    <label for="post-status">Visibility</label>
                    <select id="post-status" name="status" class="form-select">
                        <option value="1" {{ old('status', '1') === '1' ? 'selected' : '' }}>🟢 Active (Visible to everyone)</option>
                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>🔴 Inactive (Draft)</option>
                    </select>
                    @error('status')
                        <p class="err-msg">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Actions --}}
                <div class="d-flex align-items-center gap-3 flex-wrap mt-4 pt-2"
                     style="border-top: 1px solid var(--card-bd);">
                    <button type="submit" class="btn-publish" id="publishBtn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.109z"/>
                        </svg>
                        Publish Post
                    </button>
                    <a href="{{ url('/blog') }}" class="btn-cancel">
                        ← Back to Blog
                    </a>
                </div>

            </form>
        </div>
    </div>
</section>

<script>
    /* Image live preview */
    function previewImage(input) {
        var wrap    = document.getElementById('imagePreviewWrap');
        var preview = document.getElementById('imagePreview');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.src   = e.target.result;
                wrap.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            wrap.style.display = 'none';
        }
    }

    /* Prevent double submit */
    document.getElementById('blogCreateForm').addEventListener('submit', function () {
        var btn = document.getElementById('publishBtn');
        btn.disabled   = true;
        btn.innerHTML  = '⏳ Publishing…';
    });

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
