$(document).ready(function () {

    $('#search').on('keyup', function(){
        var search = $(this).val();
        if(search.trim() !== "") {
            $.ajax({
                url: '/search',
                method: 'get',
                data: {search: search},
                success: function(response){
                    var results = response;
                    $('#search-results').empty()
                    if(results.length > 0) {
                        $.each(results, function(key, value){
                            $('#search-results').append('' +
                                '<li class="mb-3"><a class="h6 " href="/san-pham/'+value.slug+'">' +
                                '<img style="width: 45px;height: 45px" src="/uploads/'+value.image_primary+'" alt="'+value.name+'" class="img-fluid">' +
                                ' '+value.name+'</a></li> ')
                        })
                    } else {
                        $('#search-results').append('<li>No results found</li>')
                    }
                }
            })
        }else {
            $('#search-results').empty()
        }
    })
    $('.filter').on('change', function(){
        $('.form-filter').submit()
    })
    $('body').on('click', '.btn-comment', function (e) {
        e.preventDefault();
        var content = $('.content').val();
        var _token = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '/add-comment',
            method: 'post',
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data : $('.form-comments').serialize(),
            success: function (response) {
                if(response.status == 401) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Chưa đăng nhập',
                        text: 'Bạn cần đăng nhập để bình luận.',
                        showCancelButton: false,
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = response.urlLogin;
                        }
                    });
                }
                content = $('.content').val('');
                fetchComments();
            },
            error: function (err) {
                $('.error').empty()
                $.each(err.responseJSON.errors, function (key, value) {
                    $('.error').append('<li class="text-danger">' + value + '</li>')
                })
            }
        })
    })

    function fetchComments() {
        var product_id = $('.product_id').val();
        $.ajax({
            url: '/get-comments/' + product_id,
            method: 'get',
            success: function (response) {
                var comments = response.comments;
                var count = response.count;
                $('.count').html('Tổng số bình luận : ' + count + '')
                $('.list-comments').empty()
                if (!comments.length > 0) {

                } else {
                    $.each(comments, function (key, value) {
                        $('.list-comments').append('' +
                            '<div class="row">\n' +
                            '<div class="col"> ' +
                            '   <div class="name">  ' +
                            '       <b>Họ Tên : </b>' + value.user_name + '' +
                            '   </div>' +
                            '</div>\n' +
                            '<div class="col"></div>\n' +
                            ' <div class="col"></div>\n' +
                            '</div>\n' +
                            '<div class="content">' +
                            '   <b>Nội dung : </b>' + value.content + '' +
                            '</div>' +
                            '<hr>' +
                            '')
                    })
                }
            }
        })
    }

    fetchComments();
    $('.update-cart').change(function (e) {
        e.preventDefault();
        var ele = $(this);
        console.log(ele);
        $.ajax({
            url : '/update-cart',
            method : "get",
            data : { key: ele.parents("tr").attr("data-id"), product_quantity: ele.parents("tr").find(".product_quantity").val()},
            success: function (response) {
                window.location.reload();
            }
        })
    })
    $("#otherForm .address").change(function () {
        var value = $(this).val();
        $("#form-payment .address-payment").val(value)
    });
    $("#otherForm .phone").change(function () {
        var value = $(this).val();
        $("#form-payment .phone-payment").val(value)
    });
})
