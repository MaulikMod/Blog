@include('adminheader')
<style>
    .content-box {
        max-height: 200px;
        overflow-y: auto;
    }
</style>
<div class="pc-container">
    <h1 class="text-center">Add Post</h1>
    <hr>

    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}">

                    <span class="text-danger">
                        @error('title')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Category --}}
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select name="category" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $item)
                            <option value="{{ $item->category_name }}">
                                {{ $item->category_name }}
                            </option>
                        @endforeach
                    </select>

                    <span class="text-danger">
                        @error('category')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Image --}}
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
                    <textarea name="content" class="form-control content-box" rows="5">{{ old('content') }}</textarea>

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
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>

                    <span class="text-danger">
                        @error('status')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Submit --}}
                <div class="mb-3">
                    <button type="submit" class="btn btn-danger">Add Post</button>
                </div>

            </form>
        </div>
    </div>
</div>

@include('adminfooter')
