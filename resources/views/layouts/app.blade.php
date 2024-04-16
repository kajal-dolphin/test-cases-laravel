<!doctype html>
<html lang="en" class="minimal-theme">

<head>
    @include('layouts.head-link')
</head>

<body>
    <!--start wrapper-->
    <div class="wrapper">
        @include('layouts.header')
        @include('layouts.sidebaar')
        <main class="page-content">
            @yield('content')
        </main>
    </div>
    <!--end wrapper-->

    @include('layouts.foot-link')
</body>

</html>
