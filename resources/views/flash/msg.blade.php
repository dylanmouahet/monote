@if (session()->has('msg_flash'))
    <script>
        $.notify({
            // options
            message:  "<div class='container' style='color:white; font-size:15px; text-align:center;'> <i class='fas fa-bell' style='color:white;'></i> &nbsp; <b>{{ session()->get('msg_flash') }}</b></div>"
        },{
            // settings
            type: "{{ session()->get('msg_type') }}",
            showProgressbar: true,
            mouse_over: 'pause',
            delay: 3000,
        });
    </script>
@endif

