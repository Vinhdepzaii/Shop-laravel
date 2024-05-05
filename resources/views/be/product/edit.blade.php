@extends('be.layout.app')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0 ">
            <h2 class="col"></h2>
            <div class="col">
                <a href="{{ route('products.index') }}" class="btn btn-primary float-end">Trở lại trang danh sách</a>
            </div>

        </div>



        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="col">Cập nhật sản phẩm</h3>
                    </div>
                    <div class="card-body">
                        <form  id="form-product" action="{{ route('products.update',$product->id) }}" enctype="multipart/form-data" method="post" >
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="code_product" class="form-label">Mã sản phẩm</label>
                                        <input  type="text" class="form-control code_product" id="code_product" name="code"
                                                placeholder="Nhập mã sản phẩm" value="{{ $product->code }}" >
                                        @error('code_product')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control name" id="name" name="name"
                                               placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                                        @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="image_primary" class="form-label">Hình ảnh nổi bật</label>
                                        <input type="file"  name="image_primary"  class="form-control" id="image_primary" accept="image/*" onchange="displayImage()">
                                        <input type="hidden" value="{{ $product->image_primary }}" name="image_primary_old">
                                        <img style="width: 100px" id="uploadedImage" src="{{ asset('uploads/'.$product->image_primary) }}" alt="Uploaded Image" />
                                        @error('image_primary')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="images" class="form-label">Hình ảnh phụ</label>
                                        <input type="file" class="form-control images" id="images" accept="image/*" name="images[]" multiple onchange="displayImages()" >
                                        <div id="imageContainer" class="d-flex" style="width: 400px"></div>
                                        <input type="hidden" value="@foreach($product_images as $image)
                                            {{ $image->image }},
                                            @endforeach" name="images_old[]" multiple>
                                        <div id="imageContainer" class="d-flex" style="width: 400px">
                                            @foreach($product_images as $image)
                                                <img style="width: 100px" src="{{ asset('uploads/'.$image->image) }}" alt="Uploaded Image" />
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="price" class="form-label">Giá sản phẩm</label>
                                        <input type="number" class="form-control price" id="price" name="price" value="{{ $product->price }}"
                                               placeholder="Nhập giá sản phẩm">
                                        @error('price')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="sale_off" class="form-label">Giảm giá</label>
                                        <input type="number" class="form-control sale_off" id="sale_off" name="sale_off" value="{{ $product->sale_off }}"
                                               placeholder="Giảm giá (số lượng theo %)" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select class="form-select category_id" id="category_id" aria-label="Default select example" name="category_id">
                                        <option selected value="">Chọn danh mục</option>
                                        @foreach($categories as $category)
                                            <option {{ $category->id == $product->category_id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="brand_id" class="form-label">Thương hiệu</label>
                                    <select class="form-select brand_id" aria-label="Default select example" id="brand_id" name="brand_id">
                                        <option selected value="">Chọn thương hiệu</option>
                                        @foreach($brands as $brand)
                                            <option {{ $brand->id== $product->brand_id ? "selected" : "" }} value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3 mt-1">
                                        <label for="short_description" class="form-label">Mô tả ngắn</label>
                                        <textarea class="form-control short_description textarea_des" id="short_description" rows="3" name="short_description">{{ $product->short_description }}</textarea>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3 mt-1">
                                        <label for="detail_description" class="form-label">Mô tả chi tiết</label>
                                        <textarea class="form-control detail_description textarea_des" id="detail_description" rows="3" name="description">{{ $product->description }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select class="form-select status" id="status" aria-label="Default select example" name="status">
                                            <option {{ $product->status == 1 ? "selected" : "" }} value="1" selected>Còn hàng</option>
                                            <option {{ $product->status == 0 ? "selected" : "" }} value="0">Hết hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="values" class="form-label">Kích cỡ</label>
                                        <br>
                                        <select class="form-control values select_size"  id="values" multiple="multiple" name="size_name[]">
                                            @foreach($attributes as $size)
                                                <option selected value="{{ $size->size_name }}">{{ $size->size_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('size_name')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="featured" class="form-label">Sản phẩm nổi bật</label> <br>
                                        <input type="checkbox" {{ $product->featured == 1 ? "checked" : "" }}  value="1"  id="featured" name="featured">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">

                                </div>
                                <div class="col">
                                    <button type="submit" class="btn btn-primary float-end">Lưu</button>
                                    <a href="{{ route('products.index') }}" class="btn btn-danger light float-end mr-5" >Hủy</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <style>

        #imageContainer img {
            max-width: 60px; /* Điều chỉnh chiều rộng tối đa của ảnh là 100px */
            max-height: 60px; /* Điều chỉnh chiều cao tối đa của ảnh là 100px */
            margin: 5px; /* Khoảng cách giữa các ảnh */
        }
    </style>
    <script>
        function displayImage() {
            const input = document.getElementById("image_primary");
            const image = document.getElementById("uploadedImage");

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    image.setAttribute("src", e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        function displayImages() {
            const input = document.getElementById("images");
            const imageContainer = document.getElementById("imageContainer");
            imageContainer.innerHTML = ""; // Clear the existing images before displaying new ones

            if (input.files && input.files.length > 0) {
                for (let i = 0; i < input.files.length; i++) {
                    const reader = new FileReader();
                    const imageElement = document.createElement("img");

                    reader.onload = function (e) {
                        imageElement.setAttribute("src", e.target.result);
                    };

                    reader.readAsDataURL(input.files[i]);
                    imageContainer.appendChild(imageElement);
                }
            }
        }
    </script>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            $("select.select_size").select2({
                tags: true,
                tokenSeparators: [',', ' '],
            }).on('select2:selecting', function(e) {
                // Khi người dùng đang thêm một giá trị mới
                var value = e.params.args.data.id.trim().toLowerCase();

                // Lấy danh sách các giá trị đã được chọn
                var selectedValues = $(this).val() || [];
                selectedValues = selectedValues.map(v => v.trim().toLowerCase());

                // Kiểm tra xem giá trị mới có trùng với bất kỳ giá trị nào đã được chọn chưa
                if (selectedValues.indexOf(value) > -1) {
                    // Nếu giá trị đã tồn tại, hủy bỏ việc thêm giá trị mới
                    e.preventDefault();
                    // Cập nhật lại Select2 để hiển thị đúng giá trị đã chọn
                    $(this).val(selectedValues).trigger('change.select2');
                }
            });
        });
    </script>
@endsection
