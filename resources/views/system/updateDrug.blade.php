@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/iCheck/custom.css" rel="stylesheet') }}">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

@endsection
@section('theTitle')
    Marigat || Update Drug Info
@endsection
@section('theHeading')
    Update Drug
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Adjust The details and Update</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" method="post" action="{{ route('postUpdateDrug') }}" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Brand Name: </label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $drug->brandname }}" name="brandname" placeholder="e.g Panadol" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Generic Name: </label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $drug->genname }}" name="genname" placeholder="e.g Paracetamol" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Chemical Name: </label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $drug->chemname }}" name="chemname" placeholder="e.g N-(4-hydroxyphenyl)ethanamide" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Unit Type: </label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $drug->unittype }}" name="unittype" placeholder="e.g Tablet" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Unit Size: </label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $drug->unitsize }}" name="unitsize" placeholder="e.g 20mg" class="form-control">
                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                <input type="hidden" value="{{ $drug->id }}" name="drugid" required>
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">Save changes</button>
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
