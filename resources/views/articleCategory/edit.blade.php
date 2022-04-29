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



        <form action="{{ url('/articleCategory/'.$data->id) }}" method="post" enctype="multipart/form-data">


            @method('PUT')

            @csrf

            <div class="form-group">
                <label for="exampleInputtype">Article Category</label>
                <input type="text" class="form-control" id="exampleInputtype" aria-describedby="" name="category"
                    placeholder="Enter Type" value="{{ $data->category }}">
            </div>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</main>


    @include('layouts/footer');
