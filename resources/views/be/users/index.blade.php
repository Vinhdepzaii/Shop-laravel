@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <h2 class="col">
                Quản lý người dùng
            </h2>
            <div class="col">
                <button class="btn btn-primary float-end btn-create">
                    Thêm mới người dùng
                </button>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header ">
                            <h4 class="card-title ">Datatable</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="userTable" class="display" style="min-width: 845px">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên</th>
                                            <th>Email</th>
                                            <th>Avatar</th>
                                            <th>Vai trò</th>
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
    </div>

    <div class="modal fade" id="modal-user" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000px; margin-left: -200px; margin-right: 10px">
                <form id="form-user" enctype="multipart/form-data" >
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                    @csrf
                        <input type="hidden" name="id" value="" id="id">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mật khẩu</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar</label>
                                    <input type="file"  name="avatar" class="form-control" id="avatar" accept="image/*" onchange="displayImage()">
                                    <img  style="width: 80px" id="uploadedImage" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRC5aYKgNtOpE7-FnqBfqgYxLCfGS4mFZvdWA&usqp=CAU" alt="Uploaded Image" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Địa chỉ</label>
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="role" class="form-label">Vai trò</label>
                                <select class="form-select" id="role" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <label for="status" class="form-label">Trạng thái</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="">Chọn trạng thái</option>
                                    <option value="active">Hoạt động</option>
                                    <option value="inactive">Không hoạt động</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger light" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary save">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function displayImage() {
            const input = document.getElementById("avatar");
            const image = document.getElementById("uploadedImage");

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    image.setAttribute("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

@section('script')
    <script>
        $(document).ready(function (){
            $('#userTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('users.getUsers') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {
                        data: 'avatar',
                        name: 'avatar',
                        render: function (data, type, full, meta){
                            return "<img src=" + data + " width='70' class='img-thumbnail' />";
                        },
                        orderable: false

                    },
                    {data: 'role', name: 'role'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('.btn-create').click(function (){
                $('#modal-user').modal('show');
                $('#modal-user .modal-title').html('Thêm mới người dùng');
                $('#form-user')[0].reset();
                $('#id').val('')
            })
            $('body').on('click','.save',function (e){
                e.preventDefault();
                let id = $('#id').val();
                let url = '';
                if(id === ''){
                    url = 'create-user';
                }else{
                    url = 'update-user/'+id;
                }
                var formData = new FormData($('#form-user')[0]);
                $.ajax({
                    url: url,
                    type: 'POST',
                    processData : false,
                    contentType : false,
                    data: formData,
                    dataType: 'JSON',
                    success: function (data){
                        if(data.status === 'success') {
                            $('#modal-user').modal('hide');
                            $('#userTable').DataTable().ajax.reload();
                            Swal.fire(
                                'Thành công!',
                                data.message,
                                'success'
                            )
                        }else {
                            toastr.error(data.message)
                            Swal.fire(
                                'Thất bại!',
                                data.message,
                                'error'
                            )
                        }
                    },
                    error: function (err){
                        $.each(err.responseJSON.errors,function(key,val){
                            $(`#${key}`).after(`<span class="text-danger">${val}</span>`)
                        })
                        toastr.error('Có lỗi xảy ra vui lòng kiểm tra lại')
                    }
                })
            })
            $('body').on('click','.btn-delete-user',function (){
                let id = $(this).data('id');
                console.log(id)
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu đã xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Xóa',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete-user/'+id,
                            type: 'GET',
                            dataType: 'JSON',
                            success: function (data){
                                if(data.status === 'success') {
                                    $('#userTable').DataTable().ajax.reload();
                                    Swal.fire(
                                        'Thành công!',
                                        data.message,
                                        'success'
                                    )
                                }else {
                                    toastr.error(data.message)
                                    Swal.fire(
                                        'Thất bại!',
                                        data.message,
                                        'error'
                                    )
                                }
                            },
                            error: function (err){
                                toastr.error('Có lỗi xảy ra vui lòng kiểm tra lại')
                            }
                        })
                    }
                })
            })
            $('body').on('click','.btn-edit',function (){
                let id = $(this).data('id');
                $.ajax({
                    url: 'edit-user/'+id,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (data){
                        if(data.status === 'success') {
                            $('#modal-user').modal('show');
                            $('#modal-user .modal-title').html('Cập nhật người dùng');
                            $('#id').val(data.user.id)
                            $('#name').val(data.user.name)
                            $('#email').val(data.user.email)
                            $('#phone').val(data.user.phone)
                            $('#address').val(data.user.address)
                            $('#role').val(data.user.role_id)
                            $('#status').val(data.user.status)
                            $('#password').val('')
                            $('#uploadedImage').attr('src', '/uploads/' +data.user.avatar)
                        }else {
                            toastr.error(data.message)
                            Swal.fire(
                                'Thất bại!',
                                data.message,
                                'error'
                            )
                        }
                    },
                    error: function (err){
                        toastr.error('Có lỗi xảy ra vui lòng kiểm tra lại')
                    }
                })
            })
        })
    </script>

@endsection
