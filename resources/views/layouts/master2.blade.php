<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.partials._head')
</head>

<style>
        @media (min-width: 1200px) {
        .container {
            max-width: 90% !important;
        }
    }
</style>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            @include('layouts.partials._nav2')

            <nav class="navbar navbar-secondary navbar-expand-lg">

            </nav>
            @include('layouts.partials._menu')
            <!-- Main Content -->
            <div class="main-content">
                <section class="section mt-5">
                    <div class="section-body">
                        @yield('content')
                    </div>
                </section>
                @include('layouts.partials._footer')
            </div>

        </div>
    </div>
    @include('layouts.partials._scripts')
</body>

</html>