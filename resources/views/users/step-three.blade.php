@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form action="#" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">Step 3:Company Details</div>

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
                            <label for="title">Company Name:</label>
                            <input type="text" class="form-control" id="firstname" name="firstname">
                        </div>
                        <div class="form-group">
                            <label for="description">Address:</label>
                            <textarea type="text" class="form-control" id="address" name="address"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">Zip-Code:</label>
                            <input class="form-control" id="zipcode" name="zipcode" type="text" pattern="[0-9]*">
                        </div>

                        <div class="form-group">
                            <label for="description">Website:</label>
                            <input class="form-control" id="website" name="website" type="url" >
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