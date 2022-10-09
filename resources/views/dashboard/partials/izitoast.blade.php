@if ($message = Session::get('success'))
    <script>
        iziToast.success({
            title: 'Success!',
            message: '{{ $message }}',
            position: 'topRight'
        });
    </script>
@elseif ($message = Session::get('error'))
    <script>
        iziToast.error({
            title: 'Oops!',
            message: '{{ $message }}',
            position: 'topRight'
        });
    </script>
@elseif ($message = Session::get('warning'))
<script>
    iziToast.warning({
        title: 'Oh!',
        message: '{{ $message }}',
        position: 'topRight'
    });
</script>
@endif
