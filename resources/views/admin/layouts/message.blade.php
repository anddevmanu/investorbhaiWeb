@if (session('success'))
    <div class="auto-close-msg alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('success') }}
    </div>
@endif

@if (session('error') && !session('modal'))
    <div class="auto-close-msg alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('error') }}
    </div>
@endif

@if (session('info'))
    <div class="auto-close-msg alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('info') }}
    </div>
@endif

@if (session('dark'))
    <div class="auto-close-msg alert alert-dark" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('dark') }}
    </div>
@endif

@if (session('message'))
    <div class="auto-close-msg alert alert-primary" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('message') }}
    </div>
@endif
