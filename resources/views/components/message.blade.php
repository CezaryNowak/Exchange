@if(session()->has('message'))

<div id="messageAppear" class="position-fixed top-0 start-50 translate-middle-x alert alert-info mt-5">
    {{ __(session('message')) }}
</div>

<script>

    if (document.getElementById("messageAppear")) {
        setTimeout(function () {
            document.getElementById("messageAppear").style.display = "none";
        }, 4000);
    }
</script>

@endif