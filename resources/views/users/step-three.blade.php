@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <form id ="stepThree" enctype="multipart/form-data" method="POST">
                @csrf

                <div class="card">
                    <div class="card-header">Step 3:Documents</div>

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
                            <label for="title">Identification Document:</label>
                            @if(!empty($i1))
                            @foreach($i1 as $i)
                            <img src="storage/images/{{$i ?? '' }}" name="identification_doc[]" height="50px" width="50px"/>
                            @endforeach
                            @endif
                            <button type="button" class="btn btn-info float-right add_doc1" style="margin: 10px;">Add</button>
                            <input type="file" class="form-control" id="identification_doc" name="identification_doc[]">
                        </div>
                        <span id="add_identification"></span>
                        <div class="form-group">
                            <label for="description">Medical Document:</label>
                            <button type="button" class="btn btn-info float-right add_doc2" style="margin: 10px;">Add</button>
                            <input type="file" class="form-control" id="medical_doc" name="medical_doc[]">
                        </div>
                        <span id="add_medical"></span>
                        <div class="form-group">
                            <label for="description">Criminal Document:</label>
                            <button type="button" class="btn btn-info float-right add_doc3" style="margin: 10px;">Add</button>
                            <input type="file" class="form-control" id="criminal_doc" name="criminal_doc[]">
                        </div>
                        <span id="add_criminal"></span>
                        <div class="form-group">
                            <label for="description">Education Document:</label>
                            @if(!empty($i2))
                            @foreach($i2 as $e)
                            <img src="storage/images/{{$e ?? '' }}" name="education_doc[]" height="50px" width="50px"/>
                            @endforeach
                            @endif
                            <button type="button" class="btn btn-info float-right add_doc4" style="margin: 10px;">Add</button>
                            <input type="file" class="form-control" id="education_doc" name="education_doc[]">
                        </div>
                        <span id="add_education"></span>
                    </div>

                    <div class="card-footer text-right">
                    <button type="button" id="back" class="btn btn-info">Back</button>
                        <button type="submit" class="btn btn-primary">Next</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script>
    $(document).ready(function() {

        $('#back').click(function() {
            window.location.href  = "{{ route('stepTwoForm') }}";
        })
        $('.add_doc1').click(function() {

            my_addmore_count = $('body').find('.my_addmore').length;
            i = my_addmore_count + 1;

            var html = `<div class="add_` + i + `"><div class="form-group my_addmore ">
        <input type="file" class="form-control" id="identification_doc_ ` + i + `" name="identification_doc[]">
       </div>
       <div class="form-group">
        <button type="button" class="btn btn-danger float-right delete" style="margin: 10px;">Remove</button>
                        </div></div>`;
            $('#add_identification').append(html);
        });

        $('.add_doc2').click(function() {

            my_addmore_count = $('body').find('.my_addmore').length;
            i = my_addmore_count + 1;

            var html = `<div class="add_` + i + `"><div class="form-group my_addmore ">
        <input type="file" class="form-control" id="medical_doc ` + i + `" name="medical_doc[]">
       </div>
       <div class="form-group">
        <button type="button" class="btn btn-danger float-right delete" style="margin: 10px;">Remove</button>
                        </div></div>`;
            $('#add_medical').append(html);
        });

        $('.add_doc3').click(function() {

            my_addmore_count = $('body').find('.my_addmore').length;
            i = my_addmore_count + 1;

            var html = `<div class="add_` + i + `"><div class="form-group my_addmore ">
        <input type="file" class="form-control" id="criminal_doc ` + i + `" name="criminal_doc[]">
       </div>
       <div class="form-group">
        <button type="button" class="btn btn-danger float-right delete" style="margin: 10px;">Remove</button>
                        </div></div>`;
            $('#add_criminal').append(html);
        });

        $('.add_doc4').click(function() {

            my_addmore_count = $('body').find('.my_addmore').length;
            i = my_addmore_count + 1;

            var html = `<div class="add_` + i + `"><div class="form-group my_addmore ">
        <input type="file" class="form-control" id="education_doc ` + i + `" name="education_doc[]">
       </div>
       <div class="form-group">
        <button type="button" class="btn btn-danger float-right delete" style="margin: 10px;">Remove</button>
                        </div></div>`;
            $('#add_education').append(html);
        });

        $(document).on('click', '.delete', function() {
            $(this).parent().parent().remove();
        });
    });

    $(document).ready(function() {

        $('#stepThree').validate({
            rules: {
                'identification_doc[]': {
                    required: true,
                },
                'education_doc[]': {
                    required: true,
                }
            },
            messages: {
                'identification_doc[]': {
                    required: "Please Upload your id proof",
                },
                'education_doc[]': {
                    required: "Please Upload your educational document",
                }
            },
            submitHandler: function(form) {

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    url: "{{ route('step-three')}}",
                    method: "POST",
                    data: new FormData(form),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: 'JSON',
                    success: function(data) {
                        if (data.status == true) {

                            window.location.href = '{{route("stepFourForm")}}';
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

@endsection