@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('theTitle')
    Cart
@endsection
@section('theHeading')
    Cart
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Dispense Drug</h5>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Drug</th>
                                <th>Amount</th>
                                <th>Unit Type</th>
                                <th>Unit Size</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach(\Gloudemans\Shoppingcart\Facades\Cart::content() as $cart)
                            <tr class="gradeX">
                                <td>{{ \App\Drug::where('id', $cart->name)->first()->genname }} {{ \App\Drug::where('id', $cart->name)->first()->brandname }} </td>
                                <td>{{ $cart->qty }}</td>
                                <td>{{ \App\Drug::where('id', $cart->name)->first()->unittype }}</td>
                                <td>{{ \App\Drug::where('id', $cart->name)->first()->unitsize }}</td>
                                <td>
                                    <a href="{{ route('removeFromCart', ['rowId' => $cart->rowId]) }}" class="btn btn-danger btn-xs"> <i class="fa fa-times-circle"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>

                            <tr>
                                <th>Drug</th>
                                <th>Amount</th>
                                <th>Unit Type</th>
                                <th>Unit Size</th>
                                <th></th>
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
                    <h5>Details</h5>

                </div>
                <div class="ibox-content">

                    <form method="post" action="{{ route('postCheckOutCart') }}" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Client: </label>
                            <div class="col-sm-10">
                                <input name="issueto" type="text" placeholder="Enter Name of the person issuing to" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">Check Out Cart</button>
                            </div>
                        </div>
                    </form>
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
