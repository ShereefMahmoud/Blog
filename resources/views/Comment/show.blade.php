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


            <li class="breadcrumb-item active">{{ $title }}</li>

        </ol>


        <div class="form-group">
            <label for="exampleInputtitle">User</label>
            <input type="text" class="form-control" id="exampleInputtitle" aria-describedby="" readonly
                name="user_name" placeholder="Enter Title" value="{{ $data->user_name }}">
        </div>

        <div class="form-group">
            <label for="exampleInputEmail">Content</label>
            <textarea class="form-control" name="content" id="" readonly cols="20" rows="10">{{ $data->content }}</textarea>
        </div>


        <div class="form-group" class="form-control">
            <label for="exampleInputName">Publisher</label>
            <select class="form-control" name="user_id" readonly>
                @foreach ($user as $key => $value)
                    <option value="{{ $value->id }}" @if ($data->user_id == $value->id) {{ 'selected' }} @endif>
                        {{ $value->name }}</option>
                @endforeach

            </select>
        </div>

        <div class="form-group">
            <label for="exampleInputtitle">Date</label>
            <input type="text" class="form-control" id="exampleInputtitle" aria-describedby="" readonly
                name="user_name" placeholder="Enter Title" value="{{ date('d-M-Y  h:i:s a', $data->date) }}">
        </div>






        <a href="{{ url('/comment') }}"><button class="btn btn-danger">Back</button></a>

    </div>

</main>


@include('layouts/footer');
