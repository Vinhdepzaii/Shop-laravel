@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <h2 class="col">
                Quản lý vai trò
            </h2>
            <div class="col">
                <button class="btn btn-primary float-end btn-create">
                    Thêm mới vai trò
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
                                <table id="roleTable" class="display" style="min-width: 845px">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên vai trò</th>
                                        <th>Tên hiển thị</th>
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

    <div class="modal fade" id="modal-role" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 1000px; margin-left: -200px; margin-right: 10px">
                <form id="form-role">
                    <div class="modal-header">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <input type="hidden" value="" name="id" id="id" class="id">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên vai trò</label>
                            <input type="text" class="form-control name" id="name" name="name"
                                   placeholder="Nhập tên vai trò">
                        </div>
                        <div class="mb-3">
                            <label for="display_name" class="form-label">Tên hiển thị</label>
                            <input type="text" class="form-control display_name" id="display_name" name="display_name"
                                   placeholder="Nhập tên hiển thị">
                        </div>
                        <div class="mb-3">
                            <label for="group" class="form-label">Nhóm</label>
                            <select class="form-select group" id="group" name="group">
                                <option value="system">System</option>
                                <option value="user" >User</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="permission" class="form-label">Quyền</label>
                            <div class="row">
                                @foreach($permissions as $key => $value)
                                    <b>{{ $key }}</b>
                                    @foreach($value as $item)
                                        <div class="col-3">
                                            <label class="form-check-label" for="permission_{{ $item->id }}">
                                                {{ $item->display_name }} </label>
                                            <input name="permission_ids[]" type="checkbox" id="permission_{{ $item->id }}"
                                                   value="{{ $item->id }}">
                                        </div>
                                    @endforeach
                                @endforeach
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
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#roleTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('roles.getRoles') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'display_name', name: 'display_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            $('body').on('click', '.btn-delete-role', function () {
                var id = $(this).data('id');
                console.log(id)
                Swal.fire({
                    title: 'Bạn có chắc chắn muốn xóa?',
                    text: "Bạn sẽ không thể khôi phục lại dữ liệu!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'delete-role' + '/' + id,
                            type: 'GET',
                            dataType: 'JSON',
                            success: function (data) {
                                if (data.status === 'success') {
                                    Swal.fire(
                                        'Đã xóa!',
                                        'Xóa thành công.',
                                        'success'
                                    )
                                    $('#roleTable').DataTable().ajax.reload();
                                } else {
                                    Swal.fire(
                                        'Xóa thất bại!',
                                        'Xóa thất bại.',
                                        'error'
                                    )
                                }
                            }
                        })
                    }
                })
            });
            $('.btn-create').click(function () {
                $('#modal-role').modal('show');
                $('#form-role')[0].reset();
                $('#id').val('');
                $('#modal-role .modal-title').html('Thêm mới vai trò');
            })
            $('body').on('click','.save',function (e){
                e.preventDefault();
                let id = $('#id').val();
                let url;
                if (id) {
                    url = '/admin/update-role/' + id;
                } else {
                    url = "/admin/create-role";
                }
                $('.text-danger').remove();
                $.ajax({
                    url: url,
                    type: 'POST',
                    dataType: 'JSON',
                    data: $('#form-role').serialize(),
                    success: function (response) {
                        if (response.success) {
                            $('#modal-role').modal('hide');
                            $('#roleTable').DataTable().ajax.reload();
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
                            $(`#${key}`).after(`<span class="text-danger">${val}</span>`)
                        })
                        toastr.error('Có lỗi xảy ra vui lòng kiểm tra lại')
                    }

                })
            })
            $('body').on('click','.btn-edit',function (){
                $('#form-role')[0].reset();
                $('#modal-role').modal('show');
                $('#modal-role .modal-title').html('Sửa vai trò');
                $('.text-danger').remove();
                let id = $(this).attr('data-id');
                $.ajax({
                    url : '/admin/edit-role/'+id,
                    type : 'GET',
                    dataType : 'JSON',
                    success : function(response){
                        $('#id').val(response.role.id);
                        $('#name').val(response.role.name);
                        $('#display_name').val(response.role.display_name);
                        $('#group').val(response.role.group);
                        $.each(response.role.permissions,function(key,val){
                            $(`#permission_${val.id}`).prop('checked',true);
                        })
                    }
                })
            })
        });
    </script>

@endsection
