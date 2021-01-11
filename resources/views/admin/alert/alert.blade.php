<div class="container col-md-4 offset-4">
    @if($flash = session('success'))
        <div class="alert alert-success my-5 text-center">
            {{ $flash }}
        </div>
    @endif
</div>

<div class="container col-md-4 offset-4">
    @if($flash = session('danger'))
        <div class="alert alert-danger my-5 text-center">
            {{ $flash }}
        </div>
    @endif
</div>