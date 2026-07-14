{{-- resources/views/home.blade.php --}}
@include('header')

<style>
    /* Hero Section */
    .hero {
        background: url('https://images.unsplash.com/photo-1499750310107-5fef28a66643') no-repeat center/cover;
        background-size: cover;
        height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 20px;
    }

    .hero-box {
        background: rgba(0, 0, 0, 0.6);
        padding: 30px;
        border-radius: 10px;
        max-width: 90%;
    }

    /* Category & Post Cards */
    .card img {
        height: 200px;
        object-fit: cover;
        width: 100%;
    }

    .card:hover {
        transform: scale(1.05);
        transition: 0.3s;
    }

    /* UI/UX View Posts Button */
    .btn-view-posts {
        position: relative;
        display: inline-block;
        padding: 8px 24px;
        font-size: 0.85rem;
        font-weight: 600;
        color: #fff;
        background: #212529;
        border: none;
        border-radius: 50px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.4s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        z-index: 1;
        overflow: hidden;
    }

    .btn-view-posts::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 100%;
        background: linear-gradient(90deg, #ff8a00, #e52e71);
        z-index: -1;
        transition: width 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        border-radius: 50px;
    }

    .btn-view-posts:hover {
        color: #fff;
        box-shadow: 0 8px 20px rgba(229, 46, 113, 0.4);
        transform: translateY(-3px);
    }

    .btn-view-posts:hover::before {
        width: 100%;
    }

    .btn-view-posts:active {
        transform: translateY(1px);
    }

    body {
        overflow-x: hidden;
        /* prevent horizontal scroll */
    }
</style>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-box">
        <h1>Welcome to Daily Thoughts</h1>
        <p>Explore the latest articles, ideas, and tutorials</p>
        <a href="#categories" class="btn btn-warning">Explore Now</a>
    </div>
</section>

<!-- Categories Section -->
<div class="container mt-5" id="categories">
    <h2 class="text-center mb-4">Categories</h2>
    <div class="row g-4">
        @forelse ($cats as $cat)
            <div class="col-md-3">
                <div class="card">
                    {{-- <img src="{{ asset('img/' . $cat->category_pic) }}"> --}}
                    <img src="{{ asset($cat->category_pic) }}">
                    <div class="card-body text-center">
                        <h5>{{ $cat->category_name }}</h5>
                        <button type="button" class="btn-view-posts mt-2" data-bs-toggle="modal"
                            data-bs-target="#categoryModal" data-category="{{ $cat->category_name }}">
                            View Posts
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p>No categories found</p>
        @endforelse
    </div>
</div>

<!-- Latest Posts Section -->
<div class="container mt-5 mb-5" id="latest-posts">
    <h2 class="text-center mb-4">Latest Posts</h2>
    <div class="row g-4">
        @foreach ($posts ?? [] as $post)
            <div class="col-12 col-sm-6 col-md-4">
                <div class="card h-100 shadow">
                    <img src="{{ url($post->post_image) }}" class="card-img-top" class="card-img-top"
                        alt="{{ $post->title }}">
                    <div class="card-body">
                        <h5>{{ $post->title }}</h5>
                        <p>{{ \Illuminate\Support\Str::limit($post->content, 100) }}</p>
                        <button type="button" class="btn btn-warning btn-sm mt-2" data-bs-toggle="modal"
                            data-bs-target="#postModal" data-title="{{ $post->title }}"
                            data-content="{{ $post->content }}" data-image="{{ url($post->post_image) }}">
                            Read More
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Category Posts Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" aria-labelledby="categoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="categoryModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="categoryPostsContainer" class="row g-3"></div>
                <div id="categoryEmptyMessage" class="text-center text-muted d-none">
                    No posts found for this category.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post Detail Modal -->
<div class="modal fade" id="postModal" tabindex="-1" aria-labelledby="postModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="postModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">
                <img id="postModalImage" src="" class="img-fluid mb-3" alt="">
                <p id="postModalContent"></p>
            </div>
        </div>
    </div>
</div>

<script>
    const postsByCategory = @json($postsByCategory);

    document.addEventListener('DOMContentLoaded', function() {
        var postModal = document.getElementById('postModal');
        if (postModal) {
            postModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var title = button.getAttribute('data-title');
                var content = button.getAttribute('data-content');
                var image = button.getAttribute('data-image');

                var modalTitle = postModal.querySelector('.modal-title');
                var modalContent = postModal.querySelector('#postModalContent');
                var modalImage = postModal.querySelector('#postModalImage');

                if (modalTitle) modalTitle.textContent = title || '';
                if (modalContent) modalContent.textContent = content || '';
                if (modalImage) {
                    modalImage.src = image || '';
                    modalImage.alt = title || '';
                }
            });
        }

        var categoryModal = document.getElementById('categoryModal');
        if (categoryModal) {
            categoryModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var categoryName = button.getAttribute('data-category') || '';

                var modalTitle = categoryModal.querySelector('.modal-title');
                var container = categoryModal.querySelector('#categoryPostsContainer');
                var emptyMessage = categoryModal.querySelector('#categoryEmptyMessage');

                if (modalTitle) modalTitle.textContent = categoryName ? categoryName + ' Posts' :
                    'Posts';
                if (container) container.innerHTML = '';

                var posts = postsByCategory[categoryName] || [];
                if (!posts.length) {
                    if (emptyMessage) emptyMessage.classList.remove('d-none');
                    return;
                }

                if (emptyMessage) emptyMessage.classList.add('d-none');

                posts.forEach(function(post) {
                    var col = document.createElement('div');
                    col.className = 'col-12 col-md-6 col-lg-4';
                    col.innerHTML = `
                        <div class="card h-100">
                            <img src="${post.post_image || ''}" class="card-img-top" alt="${post.title || ''}">
                            <div class="card-body">
                                <h6 class="card-title">${post.title || ''}</h6>
                                <p class="card-text">${(post.content || '').substring(0, 120)}...</p>
                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#postModal" data-title="${post.title || ''}" data-content="${post.content || ''}" data-image="${post.post_image || ''}">
                                    Read More
                                </button>
                            </div>
                        </div>
                    `;
                    container.appendChild(col);
                });
            });
        }
    });
</script>

@include('footer')
