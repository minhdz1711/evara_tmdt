<script src="{{ URL::asset('/assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/chart.js/Chart.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/moment/moment.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script
    src="{{ URL::asset('/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script src="{{ URL::asset('/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ URL::asset('/assets/dist/js/adminlte.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/plugins/toast/dist/jquery.toast.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('/assets/plugins/nestable/jquery.nestable.js') }}"></script>
<script src="{{ URL::asset('/js/main.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/ckfinder/ckfinder.js') }}"></script>
<script>CKFinder.config({connectorPath: '/ckfinder/connector'});</script>
<script src="{{ URL::asset('/assets/plugins/ckeditor4101/ckeditor.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
@include('ckfinder::setup')
<script type="text/javascript">
    //select images
    function selectFileWithCKFinder(elementId, previewSrc) {
        CKFinder.popup({
            chooseFiles: true,
            width: 1300,
            height: 700,
            onInit: function (finder) {
                finder.on('files:choose', function (evt) {
                    var file = evt.data.files.first();
                    var output = document.getElementById(elementId);
                    output.value = file.getUrl();

                    var pr = document.getElementById(previewSrc);
                    pr.src = file.getUrl();
                });
                finder.on('file:choose:resizedImage', function (evt) {
                    var output = document.getElementById(elementId);
                    output.value = evt.data.resizedUrl;
                });
            }
        });

        $('.btn-close').show();
    }

    //remove images
    function removeFileWithCKFinder(elementId, previewSrc) {
        var output = document.getElementById(elementId);
        output.value = "";
        var pr = document.getElementById(previewSrc);
        pr.src = '{{ URL::asset('images/no_picture.gif') }}';
        $('.btn-close').hide();
    }

    $(function () {
        let configCKFINDER = {
            filebrowserBrowseUrl: "{{ route('ckfinder_browser') }}",
            filebrowserImageBrowseUrl: "{{ route('ckfinder_browser') }}?type=Images&token=123",
            filebrowserFlashBrowseUrl: "{{ route('ckfinder_browser') }}?type=Flash&token=123",
            filebrowserUploadUrl: "{{ route('ckfinder_connector',['_token' => csrf_token() ]) }}?command=QuickUpload&type=Files",
            filebrowserImageUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Images",
            filebrowserFlashUploadUrl: "{{ route('ckfinder_connector') }}?command=QuickUpload&type=Flash",
        };
        let configCKFINDER1 = configCKFINDER;

        if ($("#description").length > 0) {
            configCKFINDER1.height = $("#description").attr("height") || 400;
            CKEDITOR.replace("description", configCKFINDER1);
        }
        configCKFINDER1.extraPlugins = 'justify , colorbutton';
    });

    $(document).ready(function () {
        $(".Switch").on('click', function () {
            $.ajax({
                url: "{{ route('admin.updateToggle') }}",
                headers: {'X-CSRF-TOKEN': '{{ @csrf_token() }}'},
                type: "post",
                dataType: "text",
                data: {
                    table: $(this).attr('data-table'),
                    col: $(this).attr('data-col'),
                    id: $(this).attr('data-id')
                },
            }).done(function () {

            });
        });
    })
</script>

<script>
    jQuery(document).ready(function ($) {
        @if (\Session::has('error'))
        $.toast({
            heading: 'Đã xảy ra lỗi',
            text: "{!! \Session::get('error') !!}",
            icon: 'error',
            loader: true,
            hideAfter: 3000,
            position: "top-right"
        });
        @endif
        @if (\Session::has('success'))
        $.toast({
            heading: 'Thành công',
            text: "{!! \Session::get('success') !!}",
            icon: 'success',
            loader: true,
            hideAfter: 3000,
            position: "top-right",
        });
        @endif
    });
</script>

