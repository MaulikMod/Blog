@include('adminheader')

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.min.css" rel="stylesheet">

{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    table {
        table-layout: fixed;
        width: 100%;
    }

    th,
    td {
        word-wrap: break-word;
        vertical-align: middle;
    }

    .comment-box {
        max-width: 200px;
        max-height: 80px;
        overflow: auto;
    }

    .pagination {
        justify-content: center;
    }

    .pc-container {
        min-height: 500px;
    }
</style>

<div class="pc-container p-5">

    {{-- Success Message --}}
    @if (Session::get('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    {{-- Add Button --}}
    <a href="{{ route('comment.create') }}" class="btn btn-primary mb-3">
        <i class="fa fa-plus"></i> Add Comment
    </a>

    <div class="table-responsive">
        <table class="table table-primary table-bordered">
            <thead>
                <tr>
                    <th width="5%">Sr No.</th>
                    <th width="25%">Post Title</th>
                    <th width="45%">Comment</th>
                    <th width="25%">Operation</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        {{-- Post Title --}}
                        <td>{{ $item->post->title ?? 'No Post' }}</td>

                        {{-- Comment --}}
                        <td>
                            <div class="comment-box">
                                {{ $item->comment }}
                            </div>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <a href="{{ route('comment.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>

                            <form onsubmit="confirmDelete(event)" class="d-inline"
                                action="{{ route('comment.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $data->links() }}
        </div>
    </div>

</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

<script>
    function confirmDelete(event) {
        event.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
        });
    }
</script>

@include('adminfooter')
