@extends('layouts.app')
@section('content')
<style>
    .selcectcategory {
        width: 300px;
    }
</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form id="stepFour" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">Step 4:About User</div>

                    <div class="card-body">


                        <div class="form-group">
                            <label>Category Name:</label></br>
                            <select class="form-control " name="category_id[]" id="category" multiple>
                                
                                @foreach ($category as $c)
                                <option value="{{$c->id}}">
                                    {{$c->category_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Skill Name:</label></br>
                            <select class="form-control" name="skill_id[]" id="skill" multiple>

                                @foreach ($skill as $c)
                                <option value="{{$c->id}}">
                                    {{$c->skill_name}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">About User:</label>
                            <textarea type="text" class="form-control" id="user_info" name="user_info"></textarea>
                        </div>

                    </div>

                    <div class="card-footer text-right">
                        <button type="button" id="back" class="btn btn-info">Back</button>
                        <button type="submit" class="btn btn-primary">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>

    $(document).ready(function() {
        $("#category").select2({
          placeholder: "Select a category",
          tags: true
        });
        $("#skill").select2({
          placeholder: "Select a skill",
          tags: true
        });

        $('#back').click(function() {
            window.location.href = "{{ route('stepThreeForm') }}";
        })

        $('#stepFour').validate({
            rules: {
                'category_id[]': {
                    required: true,
                },
                'skill_id[]': {
                    required: true,
                },
                user_info: {
                    required: true,
                }
            },
            messages: {
                'category_id[]': {
                    required: "Please Select Appropriate category",
                },
                'skill_id[]': {
                    required: "Please Select Appropriate skill",
                },
                user_info: {
                    required: "This is required",
                }
            },
            submitHandler: function(form) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "{{ route('step-four')}}",
                    method: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {
                            alert(data.message);
                            window.location.href = '{{route("login")}}';
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