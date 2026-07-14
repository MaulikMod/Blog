@include('header')

<div class="container mt-5">
    <div class="card shadow">
        <img src="{{ url($post->post_image) }}" class="card-img-top">

        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->content }}</p>
        </div>
    </div>
</div>

@include('footer')
