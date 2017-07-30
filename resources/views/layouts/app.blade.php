<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->

        <link href="{{ asset('css/all.css') }}" rel="stylesheet">
        <script src="https://use.fontawesome.com/9879a64c41.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

    </head>
    <body>


        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" >{{ config('app.name', 'Laravel') }}</a>
                </div>
                <!-- /.navbar-header -->

                {{--@include('partials.sidebar')--}}
                {{--@include('partials.rightnav')--}}

            </nav>
        </div>
        <!-- Page Content -->
        <div id="<!--page--->wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1">
                        <h1 class="page-header">@yield('page-title')</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-10 col-lg-offset-1">
                        @yield('content')
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

        <!-- Scripts -->
        <script src="{{ asset('js/all.js') }}"></script>
        <script type="text/javascript">
            $(function () {
                $('.datetimepicker').datetimepicker({
                    format: 'DD/MM/YYYY',
                    maxDate : 'now'
                    //                    useCurrent: false
                });
            });
        </script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

        @yield('scripts')

        <!-- Include this after the sweet alert js file -->
        @include('sweet::alert')
    </body>
</html>
