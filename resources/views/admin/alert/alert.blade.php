<div class="container col-md-4 offset-4">
    @if($flash = session('success'))
        <div class="alert alert-success my-5 text-center">
            {{ $flash }}
        </div>
    @endif
</div>