@include('adminheader')
<div class="pc-container p-5">
    {{-- [Font Awosome] --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <div class="card m-5" style="width: 50%">
        <img class="card-img-top" src="{{ $post->post_image }}" alt="Title" />
        <div class="card-body">
            <h4 class="card-title">Title: {{ $post->title }}</h4>
            <p class="card-text">Category: {{ $post->category }}</p>
            <p class="card-text">Content: {{ $post->content }}</p>
            {{-- <p class="card-text">Status: {{ $post->status }}</p> --}}
            <p class="card-text">
                Status:
                <span class="badge {{ $post->status == 1 ? 'bg-success' : 'bg-danger' }}">
                    {{ $post->status == 1 ? 'Active' : 'Inactive' }}
                </span>
            </p>


        </div>

    </div>
    <a href="/post" class="btn btn-primary m-5 mt-2"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
</div>
@include('adminfooter')
