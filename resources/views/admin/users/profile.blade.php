<x-admin-master>

    @section('content')
        <h1>User Profile for: {{$user->name}}</h1>
        @if(session('user-update'))
            <div class="alert alert-primary">{{session('user-update')}}</div>
        @endif
        <div class="row">
            <div class="col-sm-6">
                <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <img height="200px" class="rounded-circle" src="{{asset($user->avatar)}}">
                    </div>
                    <div class="form-group">
                        <input type="file" name="avatar">
                        @error('avatar')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable for="name">Name</lable>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" value="{{$user->name}}">
                        @error('name')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable for="username">Username</lable>
                        <input type="text" name="username" class="form-control {{$errors->has('username') ? 'is-invalid' : ''}}" id="username" value="{{$user->username}}">
                        @error('username')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable for="email">Email</lable>
                        <input type="text" name="email" class="form-control" id="email" value="{{$user->email}}">
                        @error('email')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable for="password">Password</lable>
                        <input type="password" name="password" class="form-control" id="password" >
                        @error('password')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <lable for="password-confirmation">Confirm Password</lable>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" >
                        @error('password_confirmation')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
        <div class="card shadow mb-4 mt-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
            </div>
        <div class="row">
        <div class="col-sm-12">
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
                        @foreach($roles as $role)
                            <tr>
                                <td><input type="checkbox"
                                           @foreach($user->roles as $user_role)
                                                @if ($user_role->slug == $role->slug )
                                                    checked
                                                @endif
                                           @endforeach
                                    ></td>
                                <td>{{$role->id}}</td>
                                <td>{{$role->name}}</td>
                                <td>{{$role->slug}}</td>
                                <td>
                                    <form action="{{route('user.role.attach', $user)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}" >
                                        <button class="btn btn-primary"
                                                @if($user->roles->contains($role))
                                                disabled
                                            @endif>Attach</button>
                                    </form>


                                <td>
                                    <form action="{{route('user.role.detach', $user)}}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="role" value="{{$role->id}}" >
                                    <button class="btn btn-danger"
                                            @if(!$user->roles->contains($role))
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
        </div>
        </div>
    @endsection
</x-admin-master>
