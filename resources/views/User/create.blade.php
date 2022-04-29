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



        <form action="{{ url('/user') }}" method="post" enctype="multipart/form-data">



            @csrf

            <div class="form-group">
                <label for="exampleInputtype">Name</label>
                <input type="text" class="form-control" id="exampleInputtype" aria-describedby="" name="name"
                    placeholder="Enter Name" value="{{ old('name') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputtype">Email</label>
                <input type="email" class="form-control" id="exampleInputtype" aria-describedby="" name="email"
                    placeholder="Enter Email" value="{{ old('email') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputtype">Password</label>
                <input type="password" class="form-control" id="exampleInputtype" aria-describedby="" name="password"
                    placeholder="Enter Password" value="{{ old('password') }}">
            </div>

            <div class="form-group">
                <label for="exampleInputtype">Address</label>
                <input type="address" class="form-control" id="exampleInputtype" aria-describedby="" name="address"
                    placeholder="Enter Address" value="{{ old('address') }}">
            </div>

            <div class="form-group" class="form-control">
                <label for="exampleInputName">Gender</label>
                <select class="form-control" name="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>

            <div class="form-group" class="form-control">
                <label for="exampleInputName">User Type</label>
                <select class="form-control" name="user_type_id">
                    @foreach ($data as $data )


                    <option value="{{ $data->id }}">{{ $data->type }}</option>

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
