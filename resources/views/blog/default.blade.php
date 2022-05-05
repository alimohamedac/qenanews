<!DOCTYPE html>
<html lang="en">

<head>
    @include('blog.partials.head')
</head>

<body>

@include('blog.partials.navBar')

@include('blog.partials.header')

<!-- Main Content -->
<div class="container">
    <div class="row">
        @yield('content')
    </div>
</div>

<hr>

@include('blog.partials.footer')

@include('blog.partials.footerScripts')

</body>

</html>
