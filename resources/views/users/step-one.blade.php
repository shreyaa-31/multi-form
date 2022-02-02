@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="{{route('step-one')}}" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">Step 1:Basic Details</div>

                    <div class="card-body">

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="form-group">
                            <label for="title">First Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="description">Last Name:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" />
                        </div>
                        <div class="form-group">
                            <label for="title">Gender:</label>
                            <div class="custom-control custom-radio custom-control-inline">
                                <label for="title">Male:</label>
                                <input class="form-check" value="1" type="radio" name="gender" id="male">

                                <label for="title">Female:</label>
                                <input class="form-check " value="2" type="radio" name="gender" id="female">
                            </div>
                            

                        </div>
                        <div class="form-group">
                            <label for="description">Mobile:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" />
                        </div>

                        <div class="form-group">
                            <label for="description">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" />
                        </div>

                        <div class="form-group">
                            <label for="description">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" />
                        </div>

                        <div class="form-group">
                            <label for="description">Birth-Date:</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" />
                        </div>

                        <div class="form-group">
                            <label for="description">Zip-Code:</label>
                            <input class="form-control" id="zipcode" name="zipcode" type="text" pattern="[0-9]*">
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection