<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Comment</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style=" background-image: linear-gradient(to right, #ff7810 , #f5fff3);">




    <div class="container" style="margin-top:2vh">
        <h1 style="text-align: center;margin-bottom:10vh">{{ $title }}</h1>


        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('/comment') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="exampleInputName">User Name</label>
                <input type="text" class="form-control" id="exampleInputName" aria-describedby="" name="user_name"
                    placeholder="Enter Name" value="{{ old('title') }}">
            </div>

            <div class="form-group" class="form-control">
                <label for="exampleInputName">Publisher</label>
                <select class="form-control" name="user_id">
                    @foreach ($data as $data )


                    <option value="{{ $data->id }}">{{ $data->name }}</option>

                    @endforeach

                </select>
            </div>

            <div class="form-group">
                <label for="exampleInputEmail">Content</label>
                <textarea class="form-control" name="content" id="" cols="30" rows="10">{{ old('content') }}</textarea>
            </div>


            <a href="{{ url('/') }}"><button type="button" class="btn btn-danger">Back</button></a>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>


</body>

</html>
