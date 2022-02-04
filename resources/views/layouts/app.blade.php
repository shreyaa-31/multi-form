<!DOCTYPE html>
<html>
<head>
    <title>Multi-Step Form</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style>
    .error{
        color: red;
    }
</style>
</head>
<body style="background-color: #f3fdf3">
      
<div class="container">
    <h2>User Registration</h2>
    @yield('content')
</div>
     <script src="{{asset('js/app.js')}}"></script>
</body>
  
</html>