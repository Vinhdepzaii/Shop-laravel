@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <h2 class="col">
                Quản lý quyền
            </h2>
            <div class="col">
                <button class="btn btn-primary float-end btn-create">
                    Thêm mới quyền
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title ">Datatable</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="permissionTable" class="display" style="min-width: 845px">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        Tên quyền
                                    </th>
                                    <th>
                                        Nhóm quyền
                                    </th>
                                    <th>
                                        Action
                                    </th>
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

@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $('#permissionTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('permissions.getPermissions') }}',
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'name', name: 'name'},
                    {data: 'group', name: 'group'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>

@endsection
