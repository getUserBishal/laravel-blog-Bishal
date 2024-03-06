<!DOCTYPE html>
<html lang="en">
   <head>
    <base href="/public">
      @include('home.homecss')
      <style>
        .centered-image {
          display: block;
          margin-left: auto;
          margin-right: auto;
          padding: 20px;
          height: 400px;
          width: 550px;
        }
        .title_deg
        {
            font-size: 30px;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }
        .description_deg
        {
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }
        .name_deg
        {
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }
        .field_deg
        {
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
            text-align: center;
        }
        .btn_deg {
        padding: 15px;
        text-align: center;
        }

        .btn_deg input[type="submit"] {
            background-color: black;
            color: white; /* Optionally, set text color to white for better visibility */
            border: none; /* Optionally, remove border */
        }

      </style>
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
         <!-- banner section start -->
         <!-- banner section end -->
      </div>
      <!-- header section end -->
      <!-- services section start -->


      <div style="" class="col-md-12">

                     <div><img src="/postimage/{{$post->image}}" class="centered-image"></div>
                     @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class ="close" data-dismiss ="alert" aria-hidden="true">x</button>
            {{session()->get('message')}}

        </div>


        @endif
                     <h4 class="title_deg">
                        <b>{{$post->title}}</b>
                        <h4 class="description_deg">
                        {{$post->description}}
                        </h4>
                        <h4 class="description_deg">


                            <table style="width: 50%; margin: 0 auto; border-collapse: collapse;  border: 2px solid black;">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Comment Text</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($comment  as $comment)
                                    <tr>
                                        <td style="border: 1px solid black;">{{ $comment->user_name }}</td>
                                        <td style="border: 1px solid black;">{{ $comment->comment_text }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            </h4>
                     </h4>
                     <p class="name_deg">
                        Post By: <b>{{$post->name}}</b>
                     </p>
                  </div>
                  <div class = "div_deg">
                    <form action="{{url('user_comment',$post->id)}}" method="POST">
                    @csrf

                        <div class ="field_deg">
                            <label for="">Comment Here:</label>
                            <textarea name="comment_text" id="" cols="30" rows="2"></textarea>
                        </div>
                        <div class="btn_deg">
                            <input type="submit" value ="Comment" class="btn btn-primary">
                        </div>
                    </form>
                  </div>
      @include('home.footer')

      @include('home.copyright')
      <!-- copyright section end -->
      <!-- Javascript files-->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.bundle.min.js"></script>
      <script src="js/jquery-3.0.0.min.js"></script>
      <script src="js/plugin.js"></script>
      <!-- sidebar -->
      <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="js/custom.js"></script>
      <!-- javascript -->
      <script src="js/owl.carousel.js"></script>
      <script src="https:cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
   </body>
</html>
