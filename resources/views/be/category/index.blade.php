@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0 ">
            <h2 class="col">Quản lý danh mục</h2>
            <div class="col">
                <button class="btn btn-primary float-end btn-create">Thêm mới danh mục</button>
            </div>

        </div>
        <div class="row ">
            <div class="col-12 ">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title ">Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="brandTable" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên danh mục</th>
                                    <th>Slug</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modal-category" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post"  id="form-category">
                        @csrf
                        <input type="hidden" value="" name="id" id="id" class="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên hãng</label>
                            <input type="text" class="form-control name" id="name" name="name"
                                   placeholder="Nhập tên hãng">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary save">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            var table = $('#brandTable').DataTable({
                "processing": true,
                "serverSide": true,
                ajax: {
                    url : "/admin/get-categories",
                },
                columns : [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'slug' , name: 'slug'},
                    {data : 'created_at',name: 'created_at'},
                    {data : 'updated_at',name: 'updated_at'},
                    {data : 'action',name: 'action',orderable: false,searchable: false},
                ]
            })

            $('body').on('click','.btn-create',function(){
                $('#modal-category').modal('show')
                $('#form-category')[0].reset();
                $('.text-danger').remove();
                $('#id').val('');
                $('.modal-title').html('Thêm danh mục');
            })
            $('body').on('click','.btn-edit',function(){
                $('#form-category')[0].reset();
                $('#modal-category').modal('show')
                $('.modal-title').html('Sửa danh mục');
                $('.text-danger').remove();
                let id = $(this).attr('data-id');
                $.ajax({
                    url : '/admin/edit-category/'+id,
                    type : 'GET',
                    dataType : 'JSON',
                    success : function(response){
                        $('#id').val(response.data.id);
                        $('#name').val(response.data.name);
                    }
                })
            })
            $('body').on('click','.save',function(e) {
                e.preventDefault();
                let id = $('#id').val();
                let url;
                if (id) {
                    url = '/admin/update-category/' + id;
                } else {
                    url = "/admin/create-category";
                }
                $('.text-danger').remove();
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $('#form-category').serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#modal-category').modal('hide');
                            table.ajax.reload();
                            Swal.fire(
                                'Thành công!',
                                response.message,
                                'success'
                            )
                        }else {
                            Swal.fire(
                                'Thất bại!',
                                response.message,
                                'error'
                            )
                        }
                    },
                    error: function (err) {
                        $.each(err.responseJSON.errors,function(key,val){
                            $('#'+key).after('<span class="text-danger">'+val+'</span>')
                        })
                        toastr["error"]("Có lỗi xảy ra", "Thất bại");
                    }
                })

            })
            $('body').on('click','.btn-delete',function(){
                var id = $(this).attr('data-id');
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Nếu bạn xóa thì sẽ không khôi phục được !",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',

                }).then((result) => {
                    if(result.isConfirmed){
                        $.ajax({
                            url : '/admin/delete-category/'+id,
                            type : 'GET',
                            dataType : 'JSON',
                            success : function(response){
                                if(response.success){
                                    table.ajax.reload();
                                    Swal.fire(
                                        'Thành công!',
                                        response.message,
                                        'success'
                                    )
                                }else{
                                    Swal.fire(
                                        'Thất bại!',
                                        response.message,
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                })

            })
        })

    </script>
@endsection
