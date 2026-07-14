{{-- resources/views/blog.blade.php --}}
@include('header')

<style>
  /* ─── Page Variables ─────────────────────────────── */
  :root {
    --accent: #ffc107;
    --accent2: #ff8a00;
    --dark: #0f1114;
    --card-bg: #1a1d23;
    --card-bd: rgba(255, 255, 255, 0.07);
    --text: #e4e6eb;
    --soft: #9199a6;
    --radius: 14px;
  }

  body {
    background: var(--dark);
    color: var(--text);
    overflow-x: hidden;
  }

  /* ─── Hero Banner ────────────────────────────────── */
  .blog-hero {
    position: relative;
    height: 340px;
    background: url('https://images.unsplash.com/photo-1519682337058-a94d519337bc?q=80&w=2070&auto=format&fit=crop') center/cover no-repeat;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }

  .blog-hero::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(15, 17, 20, .55) 0%, rgba(15, 17, 20, .90) 100%);
  }

  .blog-hero .hero-content {
    position: relative;
    z-index: 1;
  }

  .blog-hero h1 {
    font-size: clamp(2rem, 5vw, 3.2rem);
    font-weight: 800;
    letter-spacing: -0.02em;
    color: #fff;
  }

  .blog-hero h1 span {
    color: var(--accent);
  }

  .blog-hero p {
    color: rgba(255, 255, 255, .70);
    font-size: 1.05rem;
    margin-top: .5rem;
  }

  /* ─── Search + Filter Bar ────────────────────────── */
  .filter-bar {
    background: rgba(26, 29, 35, .92);
    backdrop-filter: blur(12px);
    border-bottom: 1px solid var(--card-bd);
    padding: 18px 0;
    position: sticky;
    top: 56px;
    z-index: 100;
  }

  .filter-bar .search-wrap {
    position: relative;
    max-width: 380px;
  }

  .filter-bar .search-wrap input {
    background: rgba(255, 255, 255, .06);
    border: 1px solid var(--card-bd);
    border-radius: 999px;
    color: var(--text);
    padding: 9px 18px 9px 42px;
    width: 100%;
    transition: border-color .2s;
  }

  .filter-bar .search-wrap input:focus {
    outline: none;
    border-color: var(--accent);
    background: rgba(255, 255, 255, .09);
  }

  .filter-bar .search-wrap .search-icon {
    position: absolute;
    left: 14px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--soft);
  }

  .filter-bar .search-wrap input::placeholder {
    color: var(--soft);
  }

  /* Filter Pills */
  .filter-pills {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
  }

  .pill {
    padding: 6px 16px;
    border-radius: 999px;
    border: 1px solid var(--card-bd);
    background: transparent;
    color: var(--soft);
    font-size: .82rem;
    font-weight: 500;
    cursor: pointer;
    transition: all .2s ease;
    white-space: nowrap;
  }

  .pill:hover {
    border-color: var(--accent);
    color: var(--accent);
  }

  .pill.active {
    background: var(--accent);
    border-color: var(--accent);
    color: #000;
    font-weight: 700;
  }

  /* ─── Posts Grid ─────────────────────────────────── */
  .blog-section {
    padding: 50px 0 80px;
  }

  .section-count {
    color: var(--soft);
    font-size: .88rem;
    margin-bottom: 28px;
  }

  .section-count strong {
    color: var(--accent);
  }

  /* Post Card */
  .post-card {
    background: var(--card-bg);
    border: 1px solid var(--card-bd);
    border-radius: var(--radius);
    overflow: hidden;
    transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
    cursor: pointer;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .post-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 48px rgba(0, 0, 0, .45);
    border-color: rgba(255, 193, 7, .25);
  }

  .post-card .card-thumb {
    position: relative;
    overflow: hidden;
    height: 210px;
  }

  .post-card .card-thumb img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .42s ease;
  }

  .post-card:hover .card-thumb img {
    transform: scale(1.06);
  }

  /* Category Badge on card */
  .post-card .cat-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: var(--accent);
    color: #000;
    font-size: .72rem;
    font-weight: 700;
    padding: 3px 10px;
    border-radius: 999px;
    text-transform: uppercase;
    letter-spacing: .04em;
  }

  .post-card .card-body-inner {
    padding: 22px 20px 20px;
    flex: 1;
    display: flex;
    flex-direction: column;
  }

  .post-card .post-title {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 10px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .post-card .post-excerpt {
    font-size: .85rem;
    color: var(--soft);
    line-height: 1.65;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .post-card .read-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 18px;
    padding: 8px 20px;
    border-radius: 999px;
    border: 1.5px solid var(--accent);
    color: var(--accent);
    background: transparent;
    font-size: .82rem;
    font-weight: 600;
    transition: all .22s ease;
    text-decoration: none;
    align-self: flex-start;
  }

  .post-card .read-btn:hover {
    background: var(--accent);
    color: #000;
  }

  /* Empty state */
  .empty-state {
    text-align: center;
    padding: 80px 20px;
    color: var(--soft);
  }

  .empty-state .icon {
    font-size: 3.5rem;
    margin-bottom: 16px;
    opacity: .4;
  }

  .empty-state h4 {
    color: var(--text);
    font-weight: 600;
  }

  /* ─── Post Detail Modal ───────────────────────────── */
  .modal-content {
    background: #1e2128;
    border: 1px solid var(--card-bd);
    border-radius: 16px;
    color: var(--text);
  }

  .modal-header {
    border-bottom: 1px solid var(--card-bd);
    padding: 20px 24px;
  }

  .modal-header .modal-title {
    font-weight: 700;
    font-size: 1.15rem;
    color: var(--text);
  }

  .modal-header .btn-close {
    filter: invert(1) brightness(0.7);
  }

  .modal-body {
    padding: 24px;
  }

  .modal-hero-img {
    width: 100%;
    max-height: 320px;
    object-fit: cover;
    border-radius: 10px;
    margin-bottom: 20px;
  }

  .modal-meta {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
  }

  .modal-cat-tag {
    background: rgba(255, 193, 7, .15);
    color: var(--accent);
    border: 1px solid rgba(255, 193, 7, .3);
    padding: 3px 12px;
    border-radius: 999px;
    font-size: .78rem;
    font-weight: 600;
  }

  .modal-body-text {
    color: #c9cdd4;
    line-height: 1.78;
    font-size: .95rem;
    white-space: pre-wrap;
  }

  /* ─── Write Blog Button ──────────────────────────── */
  .btn-write {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 18px;
    padding: 11px 28px;
    background: var(--accent);
    color: #000;
    font-weight: 700;
    font-size: .9rem;
    border: none;
    border-radius: 999px;
    text-decoration: none;
    transition: transform .22s ease, box-shadow .22s ease, background .2s;
    box-shadow: 0 8px 24px rgba(255, 193, 7, .3);
  }

  .btn-write:hover {
    transform: translateY(-3px);
    box-shadow: 0 14px 32px rgba(255, 193, 7, .42);
    background: #ffca2c;
    color: #000;
  }

  .btn-write:active {
    transform: translateY(0);
  }

  /* ─── Success Toast ──────────────────────────────── */
  .success-toast {
    background: rgba(34, 197, 94, .12);
    border: 1px solid rgba(34, 197, 94, .28);
    color: #86efac;
    padding: 14px 20px;
    border-radius: 10px;
    font-size: .88rem;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 10px;
    animation: fadeSlideIn .35s ease;
  }

  @keyframes fadeSlideIn {
    from {
      opacity: 0;
      transform: translateY(-8px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  /* ─── Category Cards Section ─────────────────────── */
  .cats-section {
    padding: 48px 0 36px;
    border-bottom: 1px solid var(--card-bd);
  }

  .cats-section .section-heading {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 22px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .cats-section .section-heading::after {
    content: '';
    flex: 1;
    height: 1px;
    background: var(--card-bd);
  }

  /* Individual category card */
  .cat-card {
    position: relative;
    border-radius: 12px;
    overflow: hidden;
    cursor: pointer;
    aspect-ratio: 4/3;
    border: 1px solid var(--card-bd);
    transition: transform .28s ease, box-shadow .28s ease, border-color .28s ease;
  }

  .cat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 18px 40px rgba(0, 0, 0, .5);
    border-color: rgba(255, 193, 7, .30);
  }

  .cat-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s ease;
  }

  .cat-card:hover img {
    transform: scale(1.07);
  }

  .cat-card .cat-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, transparent 35%, rgba(10, 11, 13, .88) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-end;
    padding: 16px 12px;
    text-align: center;
  }

  .cat-card .cat-name {
    font-size: .92rem;
    font-weight: 700;
    color: #fff;
    text-shadow: 0 1px 4px rgba(0, 0, 0, .6);
    margin-bottom: 4px;
  }

  .cat-card .cat-count {
    font-size: .72rem;
    color: var(--accent);
    font-weight: 600;
  }

  .cat-card.active-cat {
    border-color: var(--accent);
    box-shadow: 0 0 0 2px rgba(255, 193, 7, .35);
  }

  /* ─── Responsive tweaks ──────────────────────────── */
  @media (max-width: 575px) {
    .blog-hero {
      height: 240px;
    }

    .filter-bar .search-wrap {
      max-width: 100%;
    }
  }

</style>

{{-- ─── Hero ───────────────────────────────────────── --}}
<section class="blog-hero" id="blog-top">
  <div class="hero-content">
    <h1>Our <span>Blog</span></h1>
    <p>Explore stories, ideas &amp; tutorials from our community</p>
    <a href="{{ route('blog.create') }}" class="btn-write" id="write-blog-btn">
      <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
      </svg>
      Write a Blog
    </a>
  </div>
</section>

{{-- ─── Filter Bar ─────────────────────────────────── --}}
<div class="filter-bar">
  <div class="container">
    <div class="d-flex flex-column flex-sm-row align-items-start align-items-sm-center gap-3">

      {{-- Search --}}
      <div class="search-wrap">
        <span class="search-icon">
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" fill="currentColor" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zm-5.44 1.156a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11z" />
          </svg>
        </span>
        <input type="text" id="blogSearch" placeholder="Search posts…" autocomplete="off">
      </div>

      {{-- Category Filter Pills --}}
      <div class="filter-pills" id="filterPills">
        <button class="pill active" data-cat="all">All</button>
        @foreach($cats as $cat)
        <button class="pill" data-cat="{{ $cat->category_name }}">
          {{ $cat->category_name }}
        </button>
        @endforeach
      </div>

    </div>
  </div>
</div>

{{-- ─── Categories Section (Dynamic from MongoDB) ───── --}}
<section class="cats-section" id="browse-categories">
  <div class="container">
    <h2 class="section-heading">
      <span>Browse by Category</span>
    </h2>

    @if($cats->isEmpty())
    <p style="color:var(--soft); font-size:.9rem;">No categories found. Admin can add them from the admin panel.</p>
    @else
    <div class="row g-3">
      {{-- "All" card --}}
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="cat-card active-cat" id="catCard-all" onclick="filterByCategory('all', this)">
          <img src="https://images.unsplash.com/photo-1456324504439-367cee3b3c32?w=400&auto=format&fit=crop" alt="All Categories" loading="lazy">
          <div class="cat-overlay">
            <span class="cat-name">All</span>
            <span class="cat-count">{{ $totalPosts }} posts</span>
          </div>
        </div>
      </div>

      {{-- Dynamic categories from DB --}}
      @foreach($cats as $cat)
      @php
      $catPostCount = $posts->where('category', $cat->category_name)->count();
      @endphp
      <div class="col-6 col-sm-4 col-md-3 col-lg-2">
        <div class="cat-card" id="catCard-{{ Str::slug($cat->category_name) }}" onclick="filterByCategory('{{ $cat->category_name }}', this)">

          {{-- Category image from DB or fallback --}}
          @if(!empty($cat->category_pic) && file_exists(public_path($cat->category_pic)))
          <img src="{{ asset($cat->category_pic) }}" alt="{{ $cat->category_name }}" loading="lazy">
          @else
          <img src="https://images.unsplash.com/photo-1512314889357-e157c22f938d?w=400&auto=format&fit=crop" alt="{{ $cat->category_name }}" loading="lazy">
          @endif

          <div class="cat-overlay">
            <span class="cat-name">{{ $cat->category_name }}</span>
            <span class="cat-count">{{ $catPostCount }} {{ $catPostCount === 1 ? 'post' : 'posts' }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @endif
  </div>
</section>

{{-- ─── Blog Grid ──────────────────────────────────── --}}
<section class="blog-section">
  <div class="container">

    {{-- Success Flash --}}
    @if(session('success'))
    <div class="success-toast mb-4 flash-msg">
      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
      </svg>
      {{ session('success') }}
    </div>
    @endif

    {{-- Error Flash --}}
    @if(session('error'))
    <div class="alert-flash d-flex align-items-center gap-2 mb-4 flash-msg"
         style="background:rgba(239,68,68,.12);border:1px solid rgba(239,68,68,.3);color:#fca5a5;padding:12px 16px;border-radius:10px;font-size:.88rem;">
        ⚠️ {{ session('error') }}
    </div>
    @endif

    {{-- Post Count Bar --}}
    <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
      <p class="section-count mb-0" id="postCount">
        Showing <strong id="visibleCount">{{ $totalPosts }}</strong>
        of <strong>{{ $totalPosts }}</strong> posts
      </p>
      {{-- Category count badge --}}
      <span style="font-size:.82rem; color:var(--soft);">
        {{ $cats->count() }} {{ $cats->count() === 1 ? 'category' : 'categories' }} available
      </span>
    </div>

    {{-- Posts Grid --}}
    <div class="row g-4" id="postsGrid">
      @forelse($posts as $post)
      <div class="col-12 col-sm-6 col-lg-4 post-item" data-cat="{{ $post->category }}" data-title="{{ strtolower($post->title) }}" data-content="{{ strtolower($post->content) }}">

        <div class="post-card" onclick="openPostModal({
                        id:       {{ json_encode($post->_id) }},
                        post_user_id: {{ json_encode($post->user_id) }},
                        title:    {{ json_encode($post->title) }},
                        category: {{ json_encode($post->category) }},
                        content:  {{ json_encode($post->content) }},
                        image:    {{ json_encode($post->post_image ? url($post->post_image) : '') }},
                        likes:    {{ count((array)($post->likes ?? [])) }},
                        liked:    {{ session()->has('user') && in_array(session('user')->_id, (array)($post->likes ?? [])) ? 'true' : 'false' }},
                        comments: {{ json_encode($post->comments ?? []) }}
                    })">
          {{-- Thumbnail --}}
          <div class="card-thumb">
            @if($post->post_image && file_exists(public_path($post->post_image)))
            <img src="{{ url($post->post_image) }}" alt="{{ $post->title }}" loading="lazy">
            @else
            <img src="https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&auto=format&fit=crop" alt="{{ $post->title }}" loading="lazy">
            @endif

            {{-- Category Badge --}}
            @if($post->category)
            <span class="cat-badge">{{ $post->category }}</span>
            @endif
          </div>

          {{-- Body --}}
          <div class="card-body-inner">
            <h3 class="post-title">{{ $post->title }}</h3>

            {{-- Author info --}}
            <div style="font-size: .8rem; color: var(--soft); margin-bottom: 10px;">
              By
              @if($post->user_name)
              <a href="{{ url('/profile') }}" onclick="event.stopPropagation()" style="color: var(--accent); text-decoration: none; font-weight: 600;">{{ $post->user_name }}</a>
              @else
              Admin
              @endif
            </div>

            <p class="post-excerpt">
              {{ \Illuminate\Support\Str::limit($post->content, 120) }}
            </p>

            <div class="d-flex justify-content-between align-items-center mt-auto">
              <span class="read-btn" style="margin-top: 0;">
                Read More
                <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                </svg>
              </span>

              {{-- Edit & Delete Actions --}}
              @if(session()->has('user') && session('user')->_id == $post->user_id)
              <div class="d-flex gap-2" onclick="event.stopPropagation()">
                <a href="{{ route('blog.edit', $post->_id) }}" class="btn btn-sm" style="color: var(--accent); border: 1px solid var(--accent); border-radius: 20px; font-size: .75rem; padding: 4px 12px;">Edit</a>
                <button onclick="event.stopPropagation(); openDeleteModal('{{ route('blog.destroy', $post->_id) }}');" class="btn btn-sm" style="color: #f87171; border: 1px solid #f87171; border-radius: 20px; font-size: .75rem; padding: 4px 12px; background: transparent;">Delete</button>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      @empty
      {{-- No active posts at all --}}

      @endforelse
    </div>

    {{-- No results after search/filter (JS toggle) --}}
    <div id="noResults" class="d-none">
      <div class="empty-state">
        <div class="icon">🔍</div>
        <h4>No posts found</h4>
        <p>Try a different search term or select <strong>All</strong> categories.</p>
      </div>
    </div>

  </div>
</section>

{{-- ─── Post Detail Modal ──────────────────────────── --}}
<div class="modal fade" id="blogPostModal" tabindex="-1" aria-labelledby="blogPostModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="blogPostModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <img id="bpModalImage" src="" alt="" class="modal-hero-img" onerror="this.style.display='none'">
        <div class="modal-meta">
          <span id="bpModalCat" class="modal-cat-tag"></span>
        </div>
        <p id="bpModalContent" class="modal-body-text"></p>
        
        <hr style="border-color: var(--card-bd); margin: 24px 0;">
        <div class="modal-actions d-flex align-items-center gap-3 mb-4">
            <button id="likeBtn" class="btn btn-outline-warning" style="border-radius: 20px; font-weight: 600;" onclick="toggleModalLike()">
                <i class="fa fa-thumbs-up"></i> <span id="likeCountText">0</span> Likes
            </button>
        </div>

        <div class="comments-section">
            <h5 class="mb-3">Comments (<span id="commentCountText">0</span>)</h5>
            <div id="commentsList" class="mb-4" style="max-height: 200px; overflow-y: auto; text-align: left;">
                <!-- Comments rendered here -->
            </div>
            
            @if(session()->has('user'))
            <form id="commentForm" method="POST" action="">
                @csrf
                <div class="input-group">
                    <input type="text" name="comment" class="form-control" placeholder="Write a comment..." style="background: rgba(255,255,255,.05); border: 1px solid var(--card-bd); color: #fff;" required>
                    <button type="submit" class="btn btn-warning" style="border-radius: 0 8px 8px 0; font-weight: 600; color: #000;">Post</button>
                </div>
            </form>
            @else
            <div class="alert alert-secondary text-center py-2" style="background: rgba(255,255,255,.05); border: none; color: var(--soft);">
                Please <a href="{{ url('/login') }}" style="color: var(--accent);">login</a> to leave a comment.
            </div>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ─── Delete Confirmation Modal ──────────────────────── --}}
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="max-width: 400px; margin: 0 auto; text-align: center; border-radius: 16px;">
      <div class="modal-body" style="padding: 30px 24px;">
        <div style="font-size: 3.5rem; color: #f87171; margin-bottom: 12px;">⚠️</div>
        <h5 style="font-weight: 700; margin-bottom: 10px; color: var(--text);">Delete Post?</h5>
        <p style="color: var(--soft); font-size: .95rem; margin-bottom: 28px; line-height: 1.5;">
          Are you sure you want to permanently delete this post? This action cannot be undone.
        </p>
        <div class="d-flex justify-content-center gap-3">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 999px; padding: 10px 24px; font-weight: 600; font-size: .9rem; background: rgba(255,255,255,.1); border: none;">Cancel</button>
          <form id="deletePostForm" method="POST" style="margin: 0;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" style="border-radius: 999px; padding: 10px 24px; font-weight: 600; font-size: .9rem; background: #f87171; color: #000; border: none;">Yes, Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  /* ── Open modal ─────────────────────────────── */
  var currentPostId = null;

  function openPostModal(post) {
    currentPostId = post.id;
    document.getElementById('blogPostModalLabel').textContent = post.title || '';
    document.getElementById('bpModalContent').textContent = post.content || '';
    document.getElementById('bpModalCat').textContent = post.category || '';

    var img = document.getElementById('bpModalImage');
    img.src = post.image || '';
    img.alt = post.title || '';
    img.style.display = post.image ? 'block' : 'none';

    // Likes
    document.getElementById('likeCountText').textContent = post.likes;
    var likeBtn = document.getElementById('likeBtn');
    if(post.liked) {
      likeBtn.classList.remove('btn-outline-warning');
      likeBtn.classList.add('btn-warning');
      likeBtn.style.color = '#000';
    } else {
      likeBtn.classList.add('btn-outline-warning');
      likeBtn.classList.remove('btn-warning');
      likeBtn.style.color = '';
    }

    // Comments
    var currentUserId = "{{ session()->has('user') ? session('user')->_id : '' }}";
    document.getElementById('commentCountText').textContent = post.comments ? post.comments.length : 0;
    var commentsHtml = '';
    if (post.comments && post.comments.length > 0) {
        post.comments.forEach(function(c) {
            var canDelete = (currentUserId && (c.user_id === currentUserId || post.post_user_id === currentUserId));
            var deleteBtnHtml = '';
            if (canDelete) {
                deleteBtnHtml = `<form method="POST" action="/comment/${c._id}" onsubmit="return confirm('Delete this comment?');" style="display:inline; position:absolute; right:15px; top:12px; margin:0;">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" style="background:none; border:none; color: #f87171; font-size: .75rem; padding: 0;">Delete</button>
                </form>`;
            }

            commentsHtml += `<div style="background: rgba(255,255,255,.05); padding: 10px 15px; border-radius: 8px; margin-bottom: 10px; position: relative;">
                ${deleteBtnHtml}
                <strong style="color: var(--accent); font-size: .85rem;">${c.name}</strong>
                <p style="margin: 5px 0 0; font-size: .9rem;">${c.comment}</p>
            </div>`;
        });
    } else {
        commentsHtml = `<p style="color: var(--soft); font-size: .9rem;">No comments yet. Be the first!</p>`;
    }
    document.getElementById('commentsList').innerHTML = commentsHtml;

    // Set comment form action
    var commentForm = document.getElementById('commentForm');
    if (commentForm) {
        commentForm.action = `/blog/${post.id}/comment`;
    }

    var modal = new bootstrap.Modal(document.getElementById('blogPostModal'));
    modal.show();
  }

  function toggleModalLike() {
    if (!currentPostId) {
        alert("Something went wrong!");
        return;
    }
    
    // Quick frontend check if user is logged in
    @if(!session()->has('user'))
        alert("Please login to like this post.");
        return;
    @endif

    fetch(`/blog/${currentPostId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json'
        }
    })
    .then(res => res.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
            return;
        }
        document.getElementById('likeCountText').textContent = data.likes_count;
        var likeBtn = document.getElementById('likeBtn');
        if (data.liked) {
            likeBtn.classList.remove('btn-outline-warning');
            likeBtn.classList.add('btn-warning');
            likeBtn.style.color = '#000';
        } else {
            likeBtn.classList.add('btn-outline-warning');
            likeBtn.classList.remove('btn-warning');
            likeBtn.style.color = '';
        }
        // Force reload the page if user closes modal to ensure state sync
        // Or update it properly
    });
  }

  /* ── Delete Modal ─────────────────────────────── */
  function openDeleteModal(actionUrl) {
    document.getElementById('deletePostForm').action = actionUrl;
    var modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
    modal.show();
  }

  /* ── Search + Filter ────────────────────────── */
  var activeCat = 'all';

  document.getElementById('blogSearch').addEventListener('input', applyFilters);

  document.getElementById('filterPills').addEventListener('click', function(e) {
    var pill = e.target.closest('.pill');
    if (!pill) return;
    document.querySelectorAll('.pill').forEach(p => p.classList.remove('active'));
    pill.classList.add('active');
    activeCat = pill.dataset.cat;
    applyFilters();

    // Sync category cards
    document.querySelectorAll('.cat-card').forEach(c => c.classList.remove('active-cat'));
    var catCardId = 'catCard-' + (activeCat === 'all' ? 'all' : activeCat.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, ''));
    var catCard = document.getElementById(catCardId);
    if (catCard) {
      catCard.classList.add('active-cat');
    }
  });

  function filterByCategory(cat, element) {
    // Update active category card
    document.querySelectorAll('.cat-card').forEach(c => c.classList.remove('active-cat'));
    if (element) {
      element.classList.add('active-cat');
    }

    // Sync filter pills
    document.querySelectorAll('.pill').forEach(p => {
      if (p.dataset.cat === cat) {
        p.classList.add('active');
      } else {
        p.classList.remove('active');
      }
    });

    activeCat = cat;
    applyFilters();

    // Scroll to posts smoothly
    const postsSection = document.querySelector('.blog-section');
    if (postsSection) {
      postsSection.scrollIntoView({
        behavior: 'smooth'
      });
    }
  }

  function applyFilters() {
    var query = document.getElementById('blogSearch').value.toLowerCase().trim();
    var items = document.querySelectorAll('.post-item');
    var visible = 0;

    items.forEach(function(item) {
      var catMatch = activeCat === 'all' || item.dataset.cat === activeCat;
      var searchMatch = !query ||
        item.dataset.title.includes(query) ||
        item.dataset.content.includes(query);

      if (catMatch && searchMatch) {
        item.style.display = '';
        visible++;
      } else {
        item.style.display = 'none';
      }
    });

    document.getElementById('visibleCount').textContent = visible;
    document.getElementById('noResults').classList.toggle('d-none', visible > 0);
  }

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
