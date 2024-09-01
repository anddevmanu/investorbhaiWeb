@if (session('success'))
    <div class="auto-close-msg alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('success') }}
    </div>
@endif
@if (session('error') && !session('modal'))
    <div class="auto-close-msg alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('error') }}
    </div>
@endif
@if (session('info'))
    <div class="auto-close-msg alert alert-info" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('info') }}
    </div>
@endif
@if (session('dark'))
    <div class="auto-close-msg alert alert-dark" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ Session::get('dark') }}
    </div>
@endif