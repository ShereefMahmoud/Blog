<!-- Headers -->
@include('layouts/header')

<!-- nav bar -->
@include('layouts/navbar')


<!-- side bar -->
@include('layouts/sidebar')

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>

            @else
            <li class="breadcrumb-item active">{{ $title }}</li>
            @endif
        </ol>



        <form action="{{ url('/article') }}" method="post" enctype="multipart/form-data">



            @csrf

            <div class="form-group">
                <label for="exampleInputtitle">Title</label>
                <input type="text" class="form-control" id="exampleInputtitle" aria-describedby="" name="title"
                    placeholder="Enter Title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <textarea class="form-control" name="content" id="" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>

            <div class="form-group" class="form-control">
                <label for="exampleInputName">Article Category</label>
                <select class="form-control" name="article_category_id">
                   @foreach ($data_category as $data_category )
                  <option value="{{ $data_category->id }}">{{ $data_category->category }}</option>
                   @endforeach

                </select>
            </div>


            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>




            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>

</main>


    @include('layouts/footer');
