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
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />


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
                    format: 'DD/MM/YYYY'
                    //                    useCurrent: false
                });
            });
        </script>

        <script>
            $(function() {

                function isValidDate(value, userFormat) {

                    // Set default format if format is not provided
                    userFormat = userFormat || 'mm/dd/yyyy';

                    // Find custom delimiter by excluding the
                    // month, day and year characters
                    var delimiter = /[^mdy]/.exec(userFormat)[0];

                    // Create an array with month, day and year
                    // so we know the format by index
                    var theFormat = userFormat.split(delimiter);

                    // Get the user date now that we know the delimiter
                    var theDate = value.split(delimiter);

                    function isDate(date, format) {
                        var m, d, y, i = 0, len = format.length, f;
                        for (i; i < len; i++) {
                            f = format[i];
                            if (/m/.test(f)) m = date[i];
                            if (/d/.test(f)) d = date[i];
                            if (/y/.test(f)) y = date[i];
                        }
                        return (
                            m > 0 && m < 13 &&
                            y && y.length === 4 &&
                            d > 0 &&
                            // Is it a valid day of the month?
                            d <= (new Date(y, m, 0)).getDate()
                        );
                    }

                    return isDate(theDate, theFormat);

                }

                $('.datePicker')
                    .datepicker({
                    format: 'dd/mm/yyyy',
                    forceParse: false,
                    endDate :  new Date()
                })
                    .on('changeDate keyup', function(e) {
                    var submit = $(this).closest('form').find(':submit');

                    if(submit.length==0)
                    {
                        submit = $(this).parents('.modal-content').find(':submit');
                        console.log(submit.length);
                    }

                    var from = $(this).find(':input').val().split("/");
                    var f = new Date(from[2], from[1] - 1, from[0]);

                    console.log("fecha seleccionada: "+f);
                    console.log("fecha actual: "+new Date());
                    if(isValidDate($(this).find(':input').val(),'dd/mm/yyyy')&& new Date() > f){
                        //La fecha es valida
                        $(this).removeClass('has-error has-feedback');
                        submit.prop('disabled', false);
                        console.log("Valido"); 
                        $(this.id+" .error-feedback").remove();
                        $($(this).parent().get( 0 ).tagName+" .alert").remove();
                    }else{
                        //La fecha es invalida                    
                        console.log("Invalido"); 
                        if(!$(this).hasClass('has-error'))
                        {
                            $(this).addClass('has-error has-feedback');
                            submit.prop('disabled', true);
                            $(this).append('<span id="error-feedback" class="error-feedback glyphicon glyphicon-remove form-control-feedback"></span>');
                            $(this).parent().append('<div class="alert alert-danger" style="display: none;" role="alert"><strong>Error!</strong> La fecha debe tener el formato dd/mm/yyyy y ser una fecha valida menor a la actual.</div>')
                                .find('.alert').fadeIn('slow');
                        }
                    }
                });

            });
        </script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

        @yield('scripts')


        <!-- Include this after the sweet alert js file -->
        @include('sweet::alert')

    </body>
</html>
