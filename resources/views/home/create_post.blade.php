<!DOCTYPE html>
<html lang="en">
   <head>
      @include('home.homecss')
      <style>
        .div_deg
        {
            text-align:center;
            background-color: black;

        }
        .title_deg
        {
            font-size: 30px;
            font-weight: bold;
            color:white;
            padding: 30px;

        }
        label{
            display: inline-black;
            width: 200px;
            color: white;
            font-size: 20px;
            font-weight: bold;

        }
        .field_deg
        {
            padding: 25px;
        }
      </style>
   </head>
   <body>
    @include('sweetalert::alert')
      <!-- header section start -->
      <div class="header_section">
         @include('home.header')
         <!-- banner section start -->


      <div class = "div_deg">
        <h1 class ="title_deg">Add Post</h1>
            <form id="postForm" action="{{url('user_post')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="field_deg">
                    <label for="post_code">Post_code</label>
                    <input type="text" name="post_code" id="post_code" >
                    <div class="invalid-feedback">Please enter the post code.</div>
                </div>
                <div class="field_deg">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" >
                    <div class="invalid-feedback">Please enter the title.</div>
                </div>
                <div class="field_deg">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="3" ></textarea>
                    <div class="invalid-feedback">Please enter the description.</div>
                </div>
                <div class="field_deg">
                    <label for="image">Add Image</label>
                    <input type="file" name="image" id="image" >
                    <div class="invalid-feedback">Please select an image.</div>
                </div>
                <div>
                    <input type="submit" value="Add Post" class="btn btn-secondary">
                </div>
            </form>
        </div>

        <script>
            document.getElementById('postForm').addEventListener('submit', function(event) {
                let inputs = this.querySelectorAll('input, textarea');
                let emptyFields = [];

                // Remove existing error messages
                let errorMessages = this.querySelectorAll('.error-message');
                errorMessages.forEach(function(errorMessage) {
                    errorMessage.remove();
                });

                // Check each input field for empty value
                inputs.forEach(function(input) {
                    if (!input.value.trim()) { // Check if input value is empty or contains only whitespace
                        emptyFields.push(input.id); // Add id of empty field to array
                    }
                });

                // If there are empty fields, prevent form submission and display error message
                if (emptyFields.length > 0) {
                    event.preventDefault(); // Prevent form submission
                    event.stopPropagation(); // Stop event propagation to prevent default browser behavior

                    // Show error message for each empty field
                    emptyFields.forEach(function(fieldId) {
                        let field = document.getElementById(fieldId);
                        let errorMessage = document.createElement('div');
                        errorMessage.className = 'error-message';
                        errorMessage.textContent = 'Please fill ' + field.getAttribute('name') + ' first.';
                        errorMessage.style.color = 'red';
                        field.parentNode.appendChild(errorMessage);
                    });
                } else {
                    this.classList.add('was-validated'); // Add 'was-validated' class to enable styling of invalid fields
                }
            });
        </script>




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
