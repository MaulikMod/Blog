@include('adminheader')
<div class="pc-container">
    <div class="container">
        <h2>Update Category</h2>
        <form class="d-flex" method="POST" action="{{route('category.update',$category->_id)}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="col">
                <div class="mb-3">
                    <label for="" class="form-label">Category Name</label>
                    <input type="text" name="category_name" value="{{$category->category_name}}"id="" class="form-control" placeholder=""
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
@include('adminfooter')