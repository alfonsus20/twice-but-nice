@section('script')
    <script>
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        var toastList = toastElList.map(function(toastEl) {
            return new bootstrap.Toast(toastEl, {})
        })
        var toast = document.getElementById("toast");
        toastList[0].show();

    </script>
@endsection
