<x-admin-master>
    @section('content')
        <div class="col-sm-4">
            <h1>Edit Role: {{$role->name}}</h1>
            <form method="post" action="{{route('role.update', $role->id)}}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <lable for="name">Role Name</lable>
                    <input class="form-control" type="text" name="name" id="name" value="{{$role->name}}">
                </div>
                <button class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="row mt-4">
            <div class="col-sm-8">
                @if ($permissions->isNotEmpty())
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Options</th>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Attach</th>
                                    <th>Detach</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td><input type="checkbox"
                                                   @foreach($role->permissions as $role_permissions)
                                                        @if ($role_permissions->slug == $permission->slug )
                                                            checked
                                                        @endif
                                                    @endforeach></td>
                                        <td>{{$permission->id}}</td>
                                        <td>{{$permission->name}}</td>
                                        <td>{{$permission->slug}}</td>
                                        <td>
                                            <form action="{{route('role.permission.attach', $role)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}" >
                                                <button class="btn btn-primary" type="submit"
                                                        @if($role->permissions->contains($permission))
                                                        disabled
                                                    @endif>Attach</button>
                                            </form>
                                        </td>
                                        <td>
                                            <form action="{{route('role.permission.detach', $role)}}" method="post">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="permission" value="{{$permission->id}}" >
                                                <button class="btn btn-danger" type="submit"
                                                        @if(!$role->permissions->contains($permission))
                                                        disabled
                                                    @endif>Detach</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
            </div>
        </div>
    @endsection
</x-admin-master>
