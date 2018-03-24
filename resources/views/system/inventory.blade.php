@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('theTitle')
    Inventory
@endsection
@section('theHeading')
    Inventory
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Available Drugs</h5>
                    <div class="ibox-tools">
                        <a href="#addNewDrugModal" data-toggle="modal" class="btn btn-primary btn-xs"> <i class="fa fa-plus-circle"></i> New Drug</a>
                        <div id="addNewDrugModal" class="modal fade" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Add New Drug</h3>

                                                <p>Please Fill In The Following Carefully</p>

                                                <form role="form" method="post" action="{{ route('postNewDrug') }}">
                                                    <div class="form-group">
                                                        <label>Brand Name</label>
                                                        <input type="text" name="brandname" value="" placeholder="e.g Panadol" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Generic Name</label>
                                                        <input type="text" name="genname" value="" placeholder="e.g Paracetamol" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Chemical Name</label>
                                                        <input type="text" name="chemname" value="" placeholder="e.g N-(4-hydroxyphenyl)ethanamide" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Unit Type</label>
                                                        <input type="text" name="unittype" value="" placeholder="e.g Tablet" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Unit Size</label>
                                                        <input type="text" name="unitsize" value="" placeholder="e.g 20mg" class="form-control">
                                                    </div>

                                                    <div>
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-sm btn-primary pull-left m-t-n-xs" type="submit">
                                                            <strong> <i class="fa fa-plus"></i> &nbsp; Add Drug</strong>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <th>Unit Type</th>
                                <th>Unit Size</th>
                                <th>Update Info</th>
                                <th>Top Up</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drugs as $drug)
                            <tr class="gradeX">
                                <td>{{ $drug->brandname }}</td>
                                <td>{{ $drug->genname }}</td>
                                <td>{{ $drug->chemname }}</td>
                                <td>{{ \App\Delivery::where('drug', $drug->id)->sum('amount') - \App\Issue::where('drug', $drug->id)->sum('amount') }}</td>
                                <td>{{ $drug->unittype }}</td>
                                <td>{{ $drug->unitsize }}</td>
                                <td>
                                    <a href="{{ route('getUpdateDrug', ['drugid' => $drug->id]) }}" class="btn btn-primary btn-xs"> <i class="fa fa-cloud-upload"></i> &nbsp; Update</a>
                                </td>
                                <td>
                                    <a href="{{ route('getTopUp', ['drugid' => $drug->id]) }}" class="btn btn-primary btn-xs"> <i class="fa fa-plus"></i> &nbsp; Top Up</a>
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
                                <th>Unit Type</th>
                                <th>Unit Size</th>
                                <th>Update Info</th>
                                <th>Top Up</th>
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
