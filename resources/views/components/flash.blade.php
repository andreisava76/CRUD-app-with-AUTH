<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
    <div class="toast border-success-subtle" role="alert" aria-live="assertive" aria-atomic="true"
         data-autohide="false">
        <div class="d-flex">
            <div class="toast-body">
                @if(Session::has('errors'))
                    {{ Session::get('errors') }};
                @elseif(Session::has('success'))
                    {{ Session::get('success') }};
                @endif
            </div>
            <button type="button" class="btn-close position-absolute top-50 end-0 translate-middle-y me-4"
                    data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>
