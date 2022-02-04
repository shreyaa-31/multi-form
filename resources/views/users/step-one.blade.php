@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form id="stepOne" class="abc" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">Step 1:Basic Details</div>

                    <div class="card-body">

                       

                        <div class="form-group">
                            <label for="title">First Name:</label>
                            <input type="text" value="{{ $user->firstname ?? '' }}"  class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="description">Last Name:</label>
                            <input type="text" value="{{ $user->lastname ?? '' }}" class="form-control" id="lastname" name="lastname" />
                        </div>
                        <div class="form-group">
                            <label for="title">Gender:</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <label for="title">Male:</label>
                                <input class="form-check"  type="radio" name="gender" id="male" value="1">

                                <label for="title">Female:</label>
                                <input class="form-check " type="radio" name="gender" id="female" value="2">
                            </div>


                        </div>
                        <div class="form-group">
                            <label for="description">Mobile:</label>
                            <input type="text" value="{{ $user->mobile ?? '' }}" class="form-control" id="mobile" name="mobile" />
                        </div>

                        <div class="form-group">
                            <label for="description">Email:</label>
                            <input type="email" class="form-control"value="{{ $user->email ?? '' }}" id="email" name="email" />
                        </div>

                        <div class="form-group">
                            <label for="description">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" />
                        </div>

                        <div class="form-group">
                            <label for="description">Birth-Date:</label>
                            <input type="date"  value="{{ $user->date_of_birth ?? '' }}" class="form-control" id="date_of_birth" name="date_of_birth" />
                        </div>

                        <div class="form-group">
                            <label for="description">Zip-Code:</label>
                            <input class="form-control" value="{{ $user->user_zipcode ?? '' }}"  id="user_zipcode" name="user_zipcode" type="text" pattern="[0-9]*">
                        </div>

                    </div>

                    <div class=" text-right">
                        <button type="submit" id="btn" name="submit" value="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {

        $('#stepOne').validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                gender: {
                    required: true,
                },
                mobile: {
                    required: true,
                },
                password: {
                    required: true,
                },
                email: {
                    required: true,
                },
                date_of_birth: {
                    required: true,
                },
                user_zipcode: {
                    required: true,
                }
            },
            messages: {
                firstname: {
                    required: "The firstname is required",
                },
                lastname: {
                    required: "The lastname is required",
                },
                gender: {
                    required: "Gender is required",
                },
                mobile: {
                    required: "Mobile is required",
                },
                password: {
                    required: "Password is required",
                },
                email: {
                    required: "Email is required",
                },
                date_of_birth: {
                    required: "Date of birth is required",
                },
                user_zipcode: {
                    required: "ZipCode is required",
                }
            },
            submitHandler: function(form) {
               
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "{{route('step-one')}}",
                    method: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                           
                            window.location.href = '{{route("stepTwoForm")}}';
                        }
                    },
                    error: function(response) {
                        $('.text-strong').text('');
                        $.each(response.responseJSON.errors, function(field_name, error) {
                            $('[name=' + field_name + ']').after('<span class="text-strong" style="color:red">' + error + '</span>')
                        })
                    }
                });
            }
        })
    })
</script>