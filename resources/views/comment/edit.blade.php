@include('adminheader')

<div class="pc-container">
    <div class="container">
        <h2>Update Comment</h2>

        <form class="d-flex" method="POST" action="{{ route('comment.update', $comment->id) }}">
            @csrf
            @method('PUT')

            <div class="col">

                {{-- Select Post --}}
                <div class="mb-3">
                    <label class="form-label">Select Post</label>
                    <select name="post_id" class="form-control">

                        @foreach($posts as $post)
                            <option value="{{ $post->id }}"
                                {{ $post->id == $comment->post_id ? 'selected' : '' }}>
                                {{ $post->title }}
                            </option>
                        @endforeach

                    </select>

                    <br>
                    <span class="text-danger">
                        @error('post_id')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Comment --}}
                <div class="mb-3">
                    <label class="form-label">Comment</label>
                    <textarea name="comment" class="form-control" rows="4">{{ $comment->comment }}</textarea>

                    <br>
                    <span class="text-danger">
                        @error('comment')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Submit --}}
                <button class="btn btn-warning" type="submit">Update</button>

                <a href="/comment" class="btn btn-info">Back</a>

            </div>
        </form>
    </div>
</div>

@include('adminfooter')