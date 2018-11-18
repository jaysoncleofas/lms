@if (session('status'))
    <script>
        $(function() {
            swal({
                title: 'Success!',
                text: '{!! ucwords(session('status')) !!}.',
                type: '{!! session('type') !!}',
                confirmButtonText: 'Ok'
            })
        });
    </script>
@endif

@if ($errors->any())
<script>
    $(function() {
        swal({
            title: 'Oops!',
            text: '{!! $errors->first() !!}',
            type: 'error',
            confirmButtonText: 'Ok'
        })
    });
</script>

    {{-- <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div> --}}
@endif
