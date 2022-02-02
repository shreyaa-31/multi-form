@extends('layouts.master')


@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0">Category</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);"></a></li>
                                <li class="breadcrumb-item active"></li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="card-header-actions">

                                <button class="btn btn-success btn-save float-right" title="Add " id="addcat" data-toggle="modal" data-target="#category_add_modal" data-id="'.$data->id.'">Add</button>

                            </div>
                        </div>
                        <div class="card-body">
                            <!-- ajax form response -->

                            <div class="ajax-msg"></div>
                            <div class="table-responsive">
                                
                                {!! $dataTable->table(['class' => 'table table-bordered dt-responsive nowrap']) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>

<div class="modal" id="edit-category" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editcat">

                    <div class="form-group">
                        <label>Category Name:</label>
                        <input type="text" class="form-control" value="" name="category_name" id="category_name" placeholder="Type your Category">
                        <span class="error-msg-input text-danger"></span>
                    </div>

                    <input type="hidden" id="hidden_id">

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" id="btn" value="submit" class="btn btn-primary">Update</button>

            </div>
        </div>
    </div>
</div>

</section>
@include('admin.categories.create')
@endsection
@push('page_scripts')

{!! $dataTable->scripts() !!}

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.bootstrap4.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.bootstrap4.min.js"></script>

<script>
    $(document).on('click', '.delete', function() {
        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    var id = $(this).attr('id');

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        url: "{{ route('admin.category.delete')}}",
                        method: "POST",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data.status == true)

                            {
                                swal("Done!", data.message, "success");
                                $('#category-table').DataTable().ajax.reload();
                            }


                        },

                    })
                }
            });



    })


    $(document).on('click', '#btn', function() {

        var id = $('#hidden_id').val();
        // console.log(id);
        var category_name = $('#category_name').val();


        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('admin.category.update')}}",
            method: "post",
            data: {
                id: id,
                category_name: category_name
            },
            success: function(data) {
                if (data.status == true)

                {
                    swal("Done!", data.message, "success");
                    $("#edit-category").modal('hide');
                    $('#category-table').DataTable().ajax.reload();
                }

            },

            error: function(response) {
                $('.text-strong').text('');
                $.each(response.responseJSON.errors, function(field_name, error) {
                    $('[name=' + field_name + ']').after('<span class="text-strong" style="color:red">' + error + '</span>')
                })
            }

        })

    })

    $(document).on('click', '.edit', function() {

        var id = $(this).attr('id');
      

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            url: "{{ route('admin.category.edit')}}",
            method: "post",
            data: {

                id: id,
            },
            success: function(data) {
                  console.log(data.data);
                $('#category_name').val(data.data.category_name);
                $('#hidden_id').val(data.data.id);
            }

        })

    })
</script>

@endpush