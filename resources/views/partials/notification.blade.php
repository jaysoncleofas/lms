@if (session('status'))
    <script>
        $(function() {
            // swal("{!! ucwords(session('type')) !!}!","{!! session('status') !!}", "{!! session('type') !!}");
            toastr["{!! session('type') !!}"]("{!! session('status') !!}")
        });
    </script>
@endif
