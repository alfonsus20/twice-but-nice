@if (session()->has('success'))
    <div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 p-3" role="alert"
        aria-live="assertive" style="z-index: 5" aria-atomic="true" id="toast">
        <div class="d-flex">
            <div class="toast-body">
                {{session()->get('success')}}
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
@endif
