@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/iCheck/custom.css" rel="stylesheet') }}">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

@endsection
@section('theTitle')
    Marigat || Update Password
@endsection
@section('theHeading')
    Change Password
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update Your Password</h5>

                </div>
                <div class="ibox-content">

                    <form role="form" action="{{ route('updatePassword') }}" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Current Password: </label>
                            <div class="col-sm-10">
                                <input name="pass" type="password" placeholder="" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">New Password: </label>
                            <div class="col-sm-10">
                                <input name="newpass" type="password" placeholder="" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Confirm Password: </label>
                            <div class="col-sm-10">
                                <input name="conpass" type="password" placeholder="" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">Update Password</button>
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
