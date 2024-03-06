<!DOCTYPE html>
<html>
  <head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @include('admin.css')

    <style>
        .title_deg
        {
            font-size: 30px;
            font-weight: bold;
            color: white;
            padding: 30px;
            text-align: center;

        }
        .table_design
        {
            border: 1px solid white;
            width: 80%;
            text-align: center;
            margin-left: 70px;

        }
        .th_deg
        {
            background-color: skyblue;
        }
        .img_deg
        {
            height: 100px;
            width: 100px;
            padding: 10px;
        }
    </style>
  </head>
  <body>
        @include('admin.header')
    <div class="d-flex align-items-stretch">
       @include('admin.sidebar')
      <!-- Sidebar Navigation end-->
      <div class="page-content">
        @if(session()->has('message'))

        <div class = "alert alert-danger">
            <button type="button" class="close" data-dismiss ="alert" aria-hidden ="true">x</button>
            {{session()->get('message')}}
        </div>

        @endif
        <h1 class="title_deg">All Post</h1>


        <table class="table_design">
            <tr class="th_deg">
                <th>Post title</th>
                <th>Description</th>
                <th>Post By</th>
                <th>Post Status</th>
                <th>User Type</th>
                <th>Post image</th>
                <th>Delete</th>
                <th>Edit</th>
                <th>Accept</th>
                <th>Reject</th>

            </tr>
            @foreach($post as $post)


            <tr>
                <td>{{$post->title}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->name}}</td>
                <td>{{$post->post_status}}</td>
                <td>{{$post->usertype}}</td>
                <td>
                    <img class="img_deg" src="{{ asset('postimage/' . $post->image) }}" alt="">

                </td>
                <td>
                    <a href="{{url('delete_post', $post->id)}}" class="btn btn-danger" onclick ="confirmation(event)">Delete</a>
                </td>
                <td>
                    <a href="{{url('edit_page', $post->id)}}" class="btn btn-success">Edit</a>
                </td>
                <td>
                    <a href="{{url('accept_post', $post->id)}}" class="btn btn-outline-secondary">Accept</a>
                </td>
                <td>
                    <a href="{{url('reject_post', $post->id)}}" class="btn btn-primary">Reject</a>
                </td>
            </tr>

            @endforeach

        </table>
        <!-- index.blade.php -->
    <form action="{{ route('posts.restoreLatest') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-outline-primary" onclick="return confirm('Are you sure you want to restore the latest post?')">Restore Latest Post</button>
    </form>


      </div>





       @include('admin.footer')

       <script type ="text/javascript">
        function confirmation(ev)
        {
            ev.preventDefault();

            var urlToRedirect=ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal(
                {
                    title:"Are you certain to delete this ",
                    text: "you won't be able to rollback the delete",
                    icon: "warning",
                    buttons : true,
                    dangerMode : true,
                })
            .then((willCancel)=>
            {
                if(willCancel)
                {
                    window.location.href=urlToRedirect;
                }
            });

        }
       </script>
  </body>
</html>
