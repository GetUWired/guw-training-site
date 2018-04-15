<script>
    @if ( Session::get('status') === 'success')
        swal("{{ Session::get('title') }}", "{{ Session::get('message') }}", "success");
    @endif
    @if (Session::get('status') === 'error')
        swal("{{ Session::get('title') }}", "{{ Session::get('message') }}", "error");
    @endif
    @if (Session::get('status') === 'warning')
        swal("{{ Session::get('title') }}", "{{ Session::get('message') }}", "warning");
    @endif
    @if (Session::get('status') === 'info')
        swal("{{ Session::get('title') }}", "{{ Session::get('message') }}", "info");
    @endif
</script>
