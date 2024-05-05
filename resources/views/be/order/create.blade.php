@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col">
                <h3>Tạo mới đơn hàng</h3>
            </div>
            <div class="col">
                <a href="{{ route('orders.index') }}" class="btn btn-primary float-right">Quay lại</a>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('orders.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Tên khách hàng</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') ?? "Thanh toán tại quầy" }}">
                            @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="payment" class="form-label">Phương thức thanh toán</label>
                            <select name="payment" id="payment" class="form-control">
                                <option selected value="Thanh toán tại quầy">Thanh toán tại quầy</option>
                                <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
                                <option value="Thanh toán qua thẻ">Thanh toán qua thẻ</option>
                            </select>
                            @error('payment')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="product_id" class="form-label">Danh sách sản phẩm</label>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(function () {
            $('.select2').select2()
        })
    </script>
@endsection
