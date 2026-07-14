@include('adminheader')

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

<div class="pc-container">
    <div class="container m-2">

        <h1 class="text-center">Update Post</h1>
        <hr>

        <div class="row justify-content-center">
            <div class="col-8">

                <form action="{{ route('post.update', $post->_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Title --}}
                    <div class="mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" value="{{ $post->title }}">

                        <span class="text-danger">
                            @error('title')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    {{-- Category --}}
                    <div class="mb-3">
                        <label for="" class="form-label">Category</label>
                        <select name="category" id="" class="form-control">
                            @foreach ($categories as $item)
                                <option value="{{ $item->category_name }}">{{ $item->category_name }}</option>
                            @endforeach
                        </select>

                        <span class="text-danger">
                            @error('category')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Current Image
                    @if ($post->post_image)
                        <div class="mb-3">
                            <label class="form-label">Current Image</label><br>
                            <img src="{{ asset('uploads/'.$post->post_image) }}" width="120">
                        </div>
                    @endif --}}

                    {{-- Change Image --}}
                    <div class="mb-3">
                        <label class="form-label">Post Image</label>
                        <input type="file" class="form-control" name="post_image">

                        <span class="text-danger">
                            @error('post_image')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>



                    {{-- Content --}}
                    <div class="mb-3">
                        <label class="form-label">Content</label>
                        <textarea name="content" class="form-control" rows="5">{{ $post->content }}</textarea>

                        <span class="text-danger">
                            @error('content')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>

                        <span class="text-danger">
                            @error('status')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    {{-- Submit --}}
                    <div class="mb-3">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa-solid fa-pen-to-square"></i> Update Post
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>

@include('adminfooter')
