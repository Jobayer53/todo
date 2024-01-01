<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>



    <title>Document</title>
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <span id="datashow">ss</span>
                        <h2>add todo list</h2>
                    </div>
                    <div class="card-body">
                        <form id="addform" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">title</label>
                                <input type="text" name="title" id="title" class="form-control">
                                <span class=" text-danger error-text title_error"></span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">description</label>
                                <input type="text" name="description" id="description" class="form-control">
                                <span class=" text-danger error-text description_error"></span>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
                                <span class=" text-danger error-text image_error"></span>
                            </div>

                            <div class="mb-3">
                                <button id="addbtn" class="btn btn-info">add</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">

                        <h2>add todo list</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="tablerow">
                            <tr>
                                <th>sl</th>
                                <th>title </th>
                                <th>description</th>
                                <th>image</th>
                                <th>action</th>
                            </tr>
                            <tbody id="posts-crud">
                                @foreach($data as $dataa)
                                <tr id="post_id_{{ $dataa->id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $dataa->title }}</td>
                                    <td>{{ $dataa->description }}</td>
                                    <td>
                                        <img class="form-control" src="{{ asset('uploads/image') }}/{{$dataa->image}}" alt="">
                                    </td>
                                   <td><a href="javascript:void(0)" class="editbtn btn btn-info"  id="editdata"  data-id="{{ $dataa->id }}"   data-toggle="modal" data-target="#exampleModal" >Edit</a>
                                    <a href="javascript:void(0)" class="deletebtn btn btn-danger delete-post"  id="deletebtn" data-id="{{ $dataa->id }}" >Delete</a>
                                </td>

                                </tr>
                                @endforeach
                             </tbody>



                        </table>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4">
                <form id="editform" name="editform" enctype="multipart/form-data">
                    <input type="hidden" name="post_id" id="post_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Title</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="edittitle" name="edittitle" value="" required="">

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">description</label>
                        <div class="col-sm-12">
                            <input class="form-control" id="editdescription" name="editdescription" value="" required="">

                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
                    </button>
                    </div>
                </form>

            </div> --}}
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form method="POST" id="editform" name="editform" enctype="multipart/form-data">
                @method('PUT')
                <input type="hidden" name="post_id" id="post_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Title</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="edittitle" name="edittitle" value="" required>

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label">description</label>
                    <div class="col-sm-12">
                        <input class="form-control" id="editdescription" name="editdescription" value=""required >

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">IMAGE</label>
                    <div class="col-sm-12">
                        <input type="file" class="form-control" id="editimage" name="editimage"  >

                    </div>
                </div>



        </div>
        <div class="modal-footer">

          <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save
        </button>
        </div>
         </form>
      </div>
    </div>
  </div>







    <script type="text/javascript">


    $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $("#addform").on('submit',function(e){
            e.preventDefault();


           //    var data = $("#addform").serialize();
          var data = new FormData($('#addform')[0]);


            $.ajax({
                url:"{{ route('todolist.store') }}",
                type:"POST",
                data:data,
                dataType: 'json',
                cache:false,
                processData:false,
                contentType:false,
                beforeSend:function(){
                    $(document).find('span.error-text').text('');
                },
                success:function(data){
                    if(data.status == 0){
                        $.each(data.error,function(name, val){
                            $('span.'+name+'_error').text(val[0]);
                        });
                    }else{
                        $("#addform").trigger('reset');
                        $("#tablerow").load(location.href+' #tablerow');
                    }

                    // var post = '<tr id="post_id_' + data.id + '"><td>' + data.title + '</td><td>' + data.description + '</td>';
                    // post += '<td><a href="javascript:void(0)" class="editbtn"  id="editdata" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                    // post += '<td><a href="javascript:void(0)" class="deletebtn"  id="deletebtn"  data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
                    // $('#posts-crud').prepend(post);
                    // $("#tablerow").load(location.href+' #tablerow');

                    // $("#addbtn").attr("disabled", false);
                    // $("#addform").trigger('reset');
                },
                error: function(data) {
                        console.log('Error:', data.responseText);
                    }
            });
        });



        $('body').on('click', '.editbtn', function () {
            var id = $(this).data('id');
            $.ajax({
                url: 'todolist/' + id + '/edit',
                type: 'GET',
                success: function (data) {
                    $('#post_id').val(data.id);
                    $('#edittitle').val(data.title);
                    $('#editdescription').val(data.description);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        });

        $("#editform").submit(function(e){




            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            e.preventDefault();
            $("#btn-save").attr("disabled", true);
           //  var data = $("#editform").serialize();
             var data = new FormData($('#editform')[0]);
            //var formData = new FormData();

            // Serialize the form data and append it to FormData
            // $.each($('#editform').serializeArray(), function (index, field) {
            //     formData.append(field.name, field.value);
            // });

            // var imageFile = $('#editimage')[0].files[0];
            // formData.append('editimage', imageFile);

             var post_id = $("#post_id").val();
            $.ajax({

                url: "/todolist/" + post_id,
                type:"POST",
                data:data,
                cache:false,
                processData: false,
                contentType: false,


                success:function(data){
                    $("#btn-save").attr("disabled", false);
                    $("#editform").trigger('reset');
                    $('#exampleModal').modal('hide');
                    $("#tablerow").load(location.href+' #tablerow');

                    // var post = '<tr id="post_id_' + data.id + '"><td>' + data.id + '</td><td>' + data.title + '</td><td>' + data.description + '</td>';
                    // post += '<td><a href="javascript:void(0)" class="editbtn"  id="editdata" data-id="' + data.id + '" class="btn btn-info">Edit</a></td>';
                    // post += '<td><a href="javascript:void(0)" class="deletebtn"  id="deletebtn"  data-id="' + data.id + '" class="btn btn-danger delete-post">Delete</a></td></tr>';
                    // $("#post_id_" + data.id).replaceWith(post);
                    // $("#editbtn").attr("disabled", false);
                    // $("#editform").trigger('reset');
                }
            });
        });




        $('body').on('click', '.deletebtn', function() {
                var id = $(this).data("id");

                $.ajax({
                    type: "DELETE",
                    url: "/todolist/" + id,
                    success: function(data) {
                        $("#tablerow").load(location.href+' #tablerow');
                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            });




    });


    </script>

</body>
</html>
