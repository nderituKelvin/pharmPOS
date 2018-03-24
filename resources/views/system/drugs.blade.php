@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('theTitle')
    Drugs
@endsection
@section('theHeading')
    Drugs
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Issue Drugs From here</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Available</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drugs as $drug)
                            <tr class="gradeX">
                                <td>{{ $drug->brandname }}</td>
                                <td>{{ $drug->genname }}</td>
                                <td>{{ $drug->chemname }}</td>
                                <td>{{ \App\Delivery::where('drug', $drug->id)->sum('amount') - \App\Issue::where('drug', $drug->id)->sum('amount') }}</td>
                                <td>
                                    <form class="text-center" method="post" action="{{ route('postToCart') }}">
                                        <input type="number" name="amount" class="form-control" placeholder="Enter Amount"> <br>
                                        <input type="hidden" name="drugid" value="{{ $drug->id }}">
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-xs btn-primary"> <i class="fa fa-shopping-cart"></i> &nbsp; Add To Cart</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Brand Name</th>
                                <th>Generic Name</th>
                                <th>Chemical Name</th>
                                <th>Available</th>
                                <th></th>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('theJs')
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
