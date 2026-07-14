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
    text-align: center;
  }

  .img-box img {
    height: 80px;
    width: 80px;
    object-fit: cover;
    border-radius: 5px;
  }

  .content-box {
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

  <div class="table-responsive">
    <table class="table table-primary table-bordered">
      <thead>
        <tr>
          <th width="5%">No.</th>
          <th width="15%">Title</th>
          <th width="15%">Category</th>
          <th width="15%">Image</th>
          <th width="25%">Content</th>
          <th width="10%">Status</th>
          <th width="15%">Action</th>
        </tr>
      </thead>

      <tbody>
        @foreach ($data as $item)
        <tr>
          <td>{{ $loop->iteration }}</td>

          <td>{{ $item->title }}</td>

          <td>{{ $item->category }}</td>

          {{-- Image --}}
          <td>
            <div class="img-box">
              @if ($item->post_image && file_exists(public_path($item->post_image)))
              <img src="{{ $item->post_image }}">
              @else
              <img src="/img/no_img.jpg">
              @endif
            </div>
          </td>

          {{-- Content --}}
          <td>
            <div class="content-box">
              {{ $item->content }}
            </div>
          </td>

          {{-- Status --}}
          <td>
            @if ($item->status == 1)
            <span class="badge bg-success">Active</span>
            @else
            <span class="badge bg-danger">Inactive</span>
            @endif
          </td>

          {{-- Actions --}}
          <td>
            <a href="{{ route('post.show', $item->_id) }}" class="btn btn-primary btn-sm">
              <i class="fa-solid fa-eye"></i>
            </a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
      {{ $data->links('pagination::bootstrap-5') }}
    </div>
  </div>

</div>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.4/dist/sweetalert2.all.min.js"></script>

{{-- Success Popup --}}
@if (Session::get('success'))
<script>
  Swal.fire({
    icon: "success"
    , title: "{{ Session::get('success') }}"
    , showConfirmButton: false
    , timer: 2000
  });

</script>
@endif

<script>
  function confirmDelete(event) {
    event.preventDefault();

    Swal.fire({
      title: "Are you sure?"
      , text: "You won't be able to revert this!"
      , icon: "warning"
      , showCancelButton: true
      , confirmButtonColor: "#3085d6"
      , cancelButtonColor: "#d33"
      , confirmButtonText: "Yes, delete it!"
    }).then((result) => {
      if (result.isConfirmed) {
        event.target.submit();
      }
    });
  }

</script>

@include('adminfooter')
