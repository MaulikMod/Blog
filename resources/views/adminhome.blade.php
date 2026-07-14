@include('adminheader')

<div class="pc-container p-5">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

    <div class="container">
        <div class="row">

            <!-- Categories -->

            <div class="col-4">
                <div class="card bg-danger">
                    <div class="card-body">

                        <h3>Categories</h3>

                        <h1>
                            <i class="fa-solid fa-list" style="float:right"></i>
                        </h1>

                        <h4>{{ $category_count }}</h4>

                    </div>
                </div>
            </div>


            <!-- Posts -->

            <div class="col-4">
                <div class="card bg-success">
                    <div class="card-body">

                        <h3>Posts</h3>

                        <h1>
                            <i class="fa-solid fa-newspaper" style="float:right"></i>
                        </h1>

                        <h4>{{ $post_count }}</h4>

                    </div>
                </div>
            </div>


            <!-- Users -->

            <div class="col-4">
                <div class="card bg-warning">
                    <div class="card-body">

                        <h3>Users</h3>

                        <h1>
                            <i class="fa-solid fa-user" style="float:right"></i>
                        </h1>

                        <h4>{{ $user_count }}</h4>

                    </div>
                </div>
            </div>


            <!-- Comments -->

            {{-- <div class="col-4">
                <div class="card bg-info">
                    <div class="card-body">

                        <h3>Comments</h3>

                        <h1>
                            <i class="fa-solid fa-comments" style="float:right"></i>
                        </h1>

                        <h4>{{ $comment_count }}</h4>

                    </div>
                </div>
            </div>


            <!-- Total Views -->

            <div class="col-4">
                <div class="card bg-primary">
                    <div class="card-body">

                        <h3>Total Views</h3>

                        <h1>
                            <i class="fa-solid fa-eye" style="float:right"></i>
                        </h1>

                        <h4>{{ $view_count }}</h4>

                    </div>
                </div>
            </div> --}}


        </div>
    </div>

</div>

@include('adminfooter')
