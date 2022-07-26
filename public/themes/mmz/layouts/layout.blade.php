<!DOCTYPE html>
<html lang="en">

<head>
{{--    {!! meta_init() !!}--}}
    <meta http-equiv="Content-Language" content="vi">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="revisit-after" content="1 days"/>
    <meta name="keywords" content="@get('keywords')">
    <meta name="description" content="@get('description')">
    <meta name="author" content="@get('author')">
    <title>@get('title')</title>
    <link rel="icon" type="image/png" href="@get('favicon')" />

    @styles()
</head>

<body>


    @partial('header')

        @content()

    @partial('footer')

    @partial('preloader')

    @scripts()
{{--    <script type="text/javascript">--}}
{{--        $(document).ready(function(){--}}

{{--            load_comment();--}}
{{--            function load_comment(){--}}
{{--                var product_id=$('.comment_product_id').val();--}}
{{--                var _token=$('input[name="_token"]').val();--}}
{{--                $.ajax({--}}
{{--                    url:"{{url('/load-comment')}}",--}}
{{--                    method:"POST",--}}
{{--                    data:{product_id:product_id,_token:_token},--}}
{{--                    success:function(data){--}}
{{--                        $('#comment_show').html(data);--}}
{{--                    }--}}

{{--                });--}}
{{--            }--}}
{{--            $('.send-comment').click(function(){--}}
{{--                var product_id=$('.comment_product_id').val();--}}
{{--                var comment_name=$('.comment_name').val();--}}
{{--                var comment_content=$('.comment_content').val();--}}
{{--                var _token=$('input[name="_token"]').val();--}}
{{--                $.ajax({--}}
{{--                    url:"{{url('/send-comment')}}",--}}
{{--                    method:"POST",--}}
{{--                    data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},--}}
{{--                    success:function(data){--}}

{{--                        $('#notify_comment').html('<span class="text text-success">Bình luận thành công, bình luận đang chờ duyệt</span>');--}}
{{--                        // load_comment();--}}
{{--                        // $('#notify_comment').fadeOut(9000);--}}
{{--                        // $('.comment_name').val('');--}}
{{--                        //--}}
{{--                        // $('.comment_content').val('');--}}
{{--                    }--}}

{{--                });--}}
{{--            });--}}

{{--        });--}}
{{--    </script>--}}

</body>

</html>
