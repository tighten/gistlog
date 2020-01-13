@if (Session::has('success-message') || Session::has('error-message') || Session::has('message') || count($errors) > 0)
    @if (Session::has('success-message'))
        @include('components.alert', ['color' => 'teal', 'message' => Session::get('success-message')])
    @endif
    @if (Session::has('error-message'))
        @include('components.alert', ['color' => 'blue', 'message' => Session::get('error-message')])
    @endif
    @if (Session::has('message'))
        @include('components.alert', ['color' => 'blue', 'message' => Session::get('message')])
    @endif
    @if (count($errors) > 0)
        <div>
            <ul style="margin: 0; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endif

@push('scripts')
    <script>
        (function () {
            const alerts = document.querySelectorAll('.js-auto_dismiss');
            if (typeof(alerts) !== undefined) {
                alerts.forEach((el) => setTimeout(() => fadeOut(el), 4500));
            }
        })();

        function fadeOut(el) {
            el.style.opacity = 1;
            (function fade() {
                if ((el.style.opacity -= .1) < 0) {
                    el.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }
    </script>
@endpush
