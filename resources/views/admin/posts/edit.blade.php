<x-admin-master>
    @section('content')
        <h1>Edit a Post</h1>
        <form action="{{route('post.update', $post->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <lable for="title">Title</lable>
                <input type="text"
                       name="title"
                       class="form-control"
                       id="title"
                       aria-describedby=""
                       placeholder="Enter Title"
                       value="{{$post->title}}">
            </div>
            <div class="form-group">
                <div><img height="100px" src="{{$post->post_image}}" alt=""></div>
                <lable for="file">File</lable>
                <input type="file"
                       name="post_image"
                       class="form-control-file"
                       id="post_image"
                       placeholder="">
            </div>
            <div class="form-group">
                <textarea name="body"
                          class="form-control"
                          id="body"
                          cols="30"
                          rows="10">{{$post->body}}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    @endsection
</x-admin-master>
