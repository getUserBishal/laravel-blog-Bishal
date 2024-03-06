<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')

      <style>
        .post_deg
        {
            padding: 30px;
            text-align: Center;
            background-color: black;

        }
        .title_deg
        {
            font-size: 30px;
            font-weight: bold;
            padding: 15px;
            background-color: white;
        }
        .description_deg
        {
            font-size: 18px;
            font-weight: bold;
            padding: 15px;
        }
        .img_deg
        {
            height: 400px;
            width: 450px;
            padding: 30px;
            margin: auto;


        }
      </style>
   </head>
   <body>
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')

         @if(session()->has('message'))

         <div class="alert alert-success">

            <button type = "button" class = "close" data-dismiss = "alert" aria-hidden="true">x</button>
            {{session()->get('message')}}

         </div>


         @endif

         @foreach($data as $data)
         <!-- banner section start -->

      </div>
      <div class="post_deg">
        <img class ="img_deg" src="/postimage/{{$data->image}}" alt="">
        <h4 class="title_deg">{{$data->title}}</h4>
        <p class="description_deg">{{$data->description}}</p>
        <a onclick = "return confirm('are you sure to delete this?')" class ="btn btn-danger" href="{{url('my_post_del',$data->id)}}">Delete</a>
        <a href="{{url('my_post_update', $data->id)}}" class= "btn btn-primary">Update</a>
      </div>

      @endforeach


      @include('home.footer')
      <!-- footer section end -->
      <!-- copyright section start -->
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
