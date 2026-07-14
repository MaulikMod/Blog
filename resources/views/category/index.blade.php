@include('adminheader')

<div class="pc-container p-5">
    @if (session('success'))
        <div id="success-alert" class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>

        <script>
            setTimeout(function() {
                let alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 500);
                }
            }, 3000); // 3 seconds
        </script>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="mb-0">Categories</h4>
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <i class="fa-solid fa-plus"></i> Add Category
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Sr No.</th>
                            <th scope="col">Category Name</th>
                            <th scope="col">Category Pic</th>
                            <th scope="col">Operation</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                {{-- Category Name --}}
                                <td>{{ $item->category_name }}</td>

                                <td>
                                    <div class="img-box">
                                        @if (file_exists(public_path($item->category_pic)))
                                            <img src="{{ $item->category_pic }}" width="150" height="100"
                                                alt="">
                                        @else
                                            <img src="/img/no_img.jpg" width="100" height="100" alt="">
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('category.edit', $item->_id) }}" class="btn btn-warning">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form onsubmit="confirmDelete(event)" class="d-inline"
                                        action="{{ route('category.destroy', $item->_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-3">
                {{ $data->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

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
                event.target.submit(); // Submit the form after confirmation
            }
        });
    }
</script>

@include('adminfooter')
