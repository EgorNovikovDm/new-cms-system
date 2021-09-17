<x-admin-master>
    @section('content')
        <div class="row">
            <div class="col-sm-3">
                @if (session('role-created'))
                    <div class="alert alert-success">{{session('role-created')}}</div>
                    @elseif(session('role-deleted'))
                    <div class="alert alert-danger">{{session('role-deleted')}}</div>
                    @elseif(session('role-update'))
                    <div class="alert alert-primary">{{session('role-update')}}</div>
                @endif
                <form action="{{route('roles.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
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
                        <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->id}}</td>
                                        <td><a href="{{route('role.edit', $role->id)}}">{{$role->name}}</a></td>
                                        <td>{{$role->slug}}</td>
                                        <td>
                                            <form action="{{route('role.destroy', $role->id)}}" method="post" enctype="multipart/form-data">
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
