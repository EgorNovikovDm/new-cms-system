<x-admin-master>
    @section('content')
        <div class="col-sm-4">
            <h1>Edit Permission: {{$permission->name}} </h1>
            <form method="post" action="{{route('permission.update', $permission->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <lable for="name">Permission Name</lable>
                    <input class="form-control" type="text" name="name" id="name" value="{{$permission->name}}">
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
    @endsection
</x-admin-master>
