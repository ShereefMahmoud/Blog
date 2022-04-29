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



        <form action="{{ url('user/'.$data->id) }}" method="post" enctype="multipart/form-data">


            @method('PUT')

            @csrf

            <div class="form-group">
                <label for="exampleInputtype">Name</label>
                <input type="text" class="form-control" id="exampleInputtype" aria-describedby="" name="name"
                    placeholder="Enter Name" value="{{ $data->name }}">
            </div>

            <div class="form-group">
                <label for="exampleInputtype">Email</label>
                <input type="email" class="form-control" id="exampleInputtype" aria-describedby="" name="email"
                    placeholder="Enter Email" value="{{ $data->email }}">
            </div>

            <div class="form-group">
                <label for="exampleInputtype">Address</label>
                <input type="address" class="form-control" id="exampleInputtype" aria-describedby="" name="address"
                    placeholder="Enter Address" value="{{ $data->address }}">
            </div>

            <div class="form-group" class="form-control">
                <label for="exampleInputName">Gender</label>
                <select class="form-control" name="gender">
                    <option value="male"   @if($data->gender == "male")  {{ "selected" }}    @endif>Male</option>
                    <option value="female" @if($data->gender == "female") {{ "selected" }}  @endif>Female</option>
                </select>
            </div>

            <div class="form-group" class="form-control">
                <label for="exampleInputName">User Type</label>
                <select class="form-control" name="user_type_id">
                    @foreach ($userType as $key => $value )


                    <option value="{{ $value->id }}" @if($data->user_type_id == $value->id) {{ "selected" }}  @endif>{{ $value->type }}</option>

                    @endforeach

                </select>
            </div>



            <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                <input class="form-control" type="file" id="formFile" name="image">
            </div>

            <img src="{{ url('userImage/'.$data->image) }}" width="75px" height="75px" style="margin-bottom: 20px"><br>



            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

</main>


    @include('layouts/footer');
