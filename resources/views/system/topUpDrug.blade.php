@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/iCheck/custom.css" rel="stylesheet') }}">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

@endsection
@section('theTitle')
    Marigat || Top Up Drug
@endsection
@section('theHeading')
    Top Up Drug
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add The Amount in Inventory</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" method="post" action="{{ route('postTopUp') }}" class="form-horizontal">


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Amount: </label>
                            <div class="col-sm-10">
                                <input id="amount" type="number" name="amount" placeholder="e.g 3000" class="form-control" required>
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Source: </label>
                            <div class="col-sm-10">
                                <input id="source" type="text" name="source" placeholder="e.g KEMSA" class="form-control" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" value="{{ $drug->id }}" name="drugid">
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">Top Up Inventory</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('theJs')
    <!-- iCheck -->
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection
