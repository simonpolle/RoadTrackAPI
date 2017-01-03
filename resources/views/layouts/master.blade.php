<html>
<head>
    @include('layouts.head')
</head>
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">
    @include('layouts.nav')

    @include('layouts.sideNav')

    @yield('content')

    @include('layouts.footer')
</div>
</body>
</html>