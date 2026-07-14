@include('adminheader')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<style>
    table {
        table-layout: fixed;
        width: 100%;
    }

    th,
    td {
        text-align: center;
        vertical-align: middle;
        word-wrap: break-word;
    }

    .pc-container {
        min-height: 500px;
    }

    .pagination {
        justify-content: center;
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
                    <th width="10%">Sr No.</th>
                    <th width="25%">Username</th>
                    <th width="30%">Email</th>
                    <th width="35%">Full Name</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->name }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>



    </div>
</div>

@include('adminfooter')
