@include('adminheader')

<style>
    .content-box {
        max-height: 200px;
        overflow-y: auto;
    }
</style>

<div class="pc-container">
    <h1 class="text-center">Add Comment</h1>
    <hr>

    <div class="row justify-content-center">
        <div class="col-8">

            <form action="{{ route('comment.store') }}" method="POST">
                @csrf

                {{-- Select Post --}}
                <div class="mb-3">
                    <label class="form-label">Select Post</label>
                    <select class="form-control" name="post_id">
                        <option value="">-- Select Post --</option>

                        @foreach($posts as $post)
                            <option value="{{ $post->id }}">
                                {{ $post->title }}
                            </option>
                        @endforeach
                    </select>

                    <span class="text-danger">
                        @error('post_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Comment --}}
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea class="form-control" name="comment" rows="4"></textarea>

                    <span class="text-danger">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Submit --}}
                <button class="btn btn-warning" type="submit">Add</button>

                <a href="/comment" class="btn btn-info">Back</a>

            </form>

        </div>
    </div>
</div>

@include('adminfooter')