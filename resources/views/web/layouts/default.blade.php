<!DOCTYPE html>
<html lang="en">
    @include('web.includes.head')
<body>
    <div class="container">
        @yield('content')
    </div>

    @include('web.includes.scripts')
    @yield('scripts')
</body>
</html>
