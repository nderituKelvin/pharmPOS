@extends('backbone.template')
@section('theCss')

    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css') }}" rel="stylesheet">

    <link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('theTitle')
    Reports
@endsection
@section('theHeading')
    View Reports
@endsection
@section('rowContents')

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Issued Drugs Summary</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Drug::get() as $drug)
                            <tr class="gradeX">
                                <td>{{ $drug->brandname }}</td>
                                <td>{{ $drug->genname }}</td>
                                <td>{{ $drug->chemname }}</td>
                                <td>{{ \App\Issue::whereBetween('created_at', [$fromDate, $toDate])->where('drug', $drug->id)->sum('amount') }}</td>
                                <td>{{ $drug->unitsize }}</td>
                                <td>{{ $drug->unittype }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>







    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Brought In Summary</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Drug::get() as $drug)
                            <tr class="gradeX">
                                <td>{{ $drug->brandname }}</td>
                                <td>{{ $drug->genname }}</td>
                                <td>{{ $drug->chemname }}</td>
                                <td>{{ \App\Delivery::whereBetween('created_at', [$fromDate, $toDate])->where('drug', $drug->id)->sum('amount') }}</td>
                                <td>{{ $drug->unitsize }}</td>
                                <td>{{ $drug->unittype }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>












    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Issued Drugs History</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                                <th>To</th>
                                <th>By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Issue::whereBetween('created_at', [$fromDate, $toDate])->get() as $issue)
                            <tr class="gradeX">
                                <td>{{ $issue->created_at }}</td>
                                <td>{{ \App\Drug::where('id', $issue->drug)->first()->brandname }}</td>
                                <td>{{ \App\Drug::where('id', $issue->drug)->first()->genname }}</td>
                                <td>{{ \App\Drug::where('id', $issue->drug)->first()->chemname }}</td>
                                <td>{{ $issue->amount }}</td>
                                <td>{{ \App\Drug::where('id', $issue->drug)->first()->unitsize }}</td>
                                <td>{{ \App\Drug::where('id', $issue->drug)->first()->unittype }}</td>
                                <td>{{ $issue->issuedto }}</td>
                                <td>{{ \App\User::where('id', $issue->user)->first()->name }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                                <th>To</th>
                                <th>By</th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>














    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Brought In History</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                                <th>Supplier</th>
                                <th>By</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\App\Issue::whereBetween('created_at', [$fromDate, $toDate])->get() as $delivery)
                            <tr class="gradeX">
                                <td>{{ $delivery->created_at }}</td>
                                <td>{{ \App\Drug::where('id', $delivery->drug)->first()->brandname }}</td>
                                <td>{{ \App\Drug::where('id', $delivery->drug)->first()->genname }}</td>
                                <td>{{ \App\Drug::where('id', $delivery->drug)->first()->chemname }}</td>
                                <td>{{ $delivery->amount }}</td>
                                <td>{{ \App\Drug::where('id', $delivery->drug)->first()->unitsize }}</td>
                                <td>{{ \App\Drug::where('id', $delivery->drug)->first()->unittype }}</td>
                                <td>{{ $delivery->supplier }}</td>
                                <td>{{ \App\User::where('id', $delivery->user)->first()->name }}</td>
                            </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Date</th>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Amount</th>
                                <th>Unit Size</th>
                                <th>Unit Type</th>
                                <th>Supplier</th>
                                <th>By</th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
@section('theJs')
    <!-- Data picker -->
    <script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <!-- Date range picker -->
    <script src="{{ asset('js/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/plugins/jeditable/jquery.jeditable.js') }}"></script>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ]

            });

            /* Init DataTables */
            var oTable = $('#editable').DataTable();

            /* Apply the jEditable handlers to the table */
            oTable.$('td').editable( '../example_ajax.php', {
                "callback": function( sValue, y ) {
                    var aPos = oTable.fnGetPosition( this );
                    oTable.fnUpdate( sValue, aPos[0], aPos[1] );
                },
                "submitdata": function ( value, settings ) {
                    return {
                        "row_id": this.parentNode.getAttribute('id'),
                        "column": oTable.fnGetPosition( this )[2]
                    };
                },

                "width": "90%",
                "height": "100%"
            } );


        });

        function fnClickAddRow() {
            $('#editable').dataTable().fnAddData( [
                "Custom row",
                "New row",
                "New row",
                "New row",
                "New row" ] );

        }
    </script>
@endsection
