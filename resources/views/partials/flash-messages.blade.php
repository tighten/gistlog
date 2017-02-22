@if (Session::has('success-message') || Session::has('error-message') || Session::has('message') || count($errors) > 0)
<div class="container">
    @if (Session::has('success-message'))
    <div class="notice notice--success" data-dismiss="timeout">
        {{ Session::get('success-message') }}
    </div>
    @endif
    @if (Session::has('error-message'))
    <div class="notice notice--error" data-dismiss="timeout">
        {{ Session::get('error-message') }}
    </div>
    @endif
    @if (Session::has('message'))
    <div class="notice notice--info" data-dismiss="timeout">
        {{ Session::get('message') }}
    </div>
    @endif
    @if (count($errors) > 0)
    <div class="notice notice--error">
        <ul style="margin: 0; padding: 0;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>
@endif
