<script>
    function load_medication(value) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({

            url: "{{route('load_medications')}}" + "?id=" + value,
            success: function (data) {
                console.log(data);
                $('#medications').html(data);
            }
        });
    }

</script>    