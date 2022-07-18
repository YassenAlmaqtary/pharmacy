<script>
    function loadAllterNative(value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url: "{{route('load_allterNative')}}" + "?id=" + value,
            success: function (data) {
                console.log(data);
                $('#alltrer_native').html(data);
            }
        });
    }

</script>  