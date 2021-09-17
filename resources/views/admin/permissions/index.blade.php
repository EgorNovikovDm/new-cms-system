<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-3">
            @if (session('permissions-created'))
                <div class="alert alert-success">{{session('permissions-created')}}</div>
                @elseif (session('permission-deleted'))
                <div class="alert alert-danger">{{session('permission-deleted')}}</div>
                @elseif (session('permission-update'))
                <div class="alert alert-primary">{{session('permission-update')}}</div>
                @else
            @endif
                <form action="{{route('permissions.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name Permissions</label>
                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                        <div>
                            @error('name')
                            <div class="alert alert-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Create</button>
                </form>
            </div>
            <div class="col-sm-9">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{$permission->id}}</td>
                                        <td><a href="{{route('permission.edit', $permission->id)}}">{{$permission->name}}</a></td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <form action="{{route('permission.destroy', $permission->id)}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @endsection
</x-admin-master>
