<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Marigat | Home</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>

<body>
<div id="wrapper">
	@include('includes.navbar')

    <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
			@include('includes.topNavbar')
        </div>

        <div class="wrapper wrapper-content animated fadeIn">

            <div class="p-w-md m-t-sm">
                <div class="row">

                    <div class="col-sm-6">
                        <h1 class="m-b-xs">
                            {{ \App\Issue::whereBetween('created_at', [Carbon\Carbon::today()->startOfMonth(), Carbon\Carbon::today()->endOfMonth()])->sum('amount') }}

                        </h1>
                        <small>
                            Issues in current month
                        </small>


                    </div>
                    <div class="col-sm-6">
                        <h1 class="m-b-xs">
                            {{ \App\Delivery::whereBetween('created_at', [Carbon\Carbon::today()->startOfMonth(), Carbon\Carbon::today()->endOfMonth()])->sum('amount') }}
                        </h1>
                        <small>
                            Delivered in Current Month
                        </small>


                    </div>


                </div>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="small pull-left col-md-3 m-l-lg m-t-md">
                            <strong>Issues</strong> Per Day
                        </div>
                        <div class="flot-chart m-b-xl">
                            <div class="flot-chart-content" id="flot-dashboard5-chart"></div>
                        </div>
                    </div>
                </div>



            </div>


        </div>

		@include('includes.footer')
    </div>

</div>

<!-- Mainly scripts -->
<script src="{{ asset('js/jquery-2.1.1.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Flot -->
<script src="{{ asset('js/plugins/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.spline.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.resize.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.pie.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.symbol.js') }}"></script>
<script src="{{ asset('js/plugins/flot/jquery.flot.time.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }}"></script>
<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>

<!-- Sparkline -->
<script src="{{ asset('js/plugins/sparkline/jquery.sparkline.min.js') }}"></script>


<script>
    $(document).ready(function() {
        var data1 = [
            @for($i=1;$i<= \Carbon\Carbon::today()->day;$i++)
                [{{ $i }}, {{ \App\Issue::whereDate('created_at', date('Y-m-'.$i))->sum('amount') }}],
            @endfor
        ];

        $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
                data1
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.2,
                        lineWidth: 3,
                        fill: 0.3
                    },
                    points: {
                        radius: 3,
                        show: true
                    },
                    shadowSize: 6
                },
                grid: {
                    hoverable: true,
                    clickable: true,

                    borderWidth: 5,
                    color: 'transparent'
                },
                colors: ["#0000FF"],
                xaxis:{
                },
                yaxis: {
                },
                tooltip: true
            }
        );

    });
</script>
</body>
</html>
