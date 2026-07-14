{{-- @include('adminheader')
<div class="pc-container">
    <div class="container">
        <h2>Add Category</h2>
        <form class="d-flex" method="POST" action="{{route('category.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="text" name="category_name" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" />
                    <br><span class="text-danger">
                        @error('category_name')
                            {{$message}}
                        @enderror</span>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Category Pic</label>
                    <input type="file" name="category_pic" id="" class="form-control" placeholder=""
                        aria-describedby="helpId" />
                    <br><span class="text-danger">
                        @error('category_pic')
                            {{$message}}
                        @enderror</span>
                </div>

                <button class="btn btn-warning" type="submit">Add</button>

                <a href="/category" class="btn btn-info">Back</a>
            </div>
        </form>

    </div>
</div>
@include('adminfooter') --}}

@include('adminheader')
<style>
    .content-box {
        max-height: 200px;
        overflow-y: auto;
    }
</style>
<div class="pc-container">
    <h1 class="text-center">Add Category</h1>
    <hr>

    <div class="row justify-content-center">
        <div class="col-8">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Title --}}
                <div class="mb-3">
                    <label class="form-label">Category Name</label>
                    <input type="text" class="form-control" name="category_name" value="{{ old('title') }}">

                    <span class="text-danger">
                        @error('category_name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>

                {{-- Image --}}
                <div class="mb-3">
                    <label class="form-label">Category Pic</label>
                    <input type="file" class="form-control" name="category_pic">

                    <span class="text-danger">
                        @error('category_pic')
                            {{ $message }}
                        @enderror
                    </span>
                </div>


                {{-- Submit --}}
                <button class="btn btn-warning" type="submit">Add</button>

                <a href="/category" class="btn btn-info">Back</a>
        </div>
        </form>
    </div>
</div>
</div>

@include('adminfooter')
