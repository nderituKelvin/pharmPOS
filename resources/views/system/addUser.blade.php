@extends('backbone.template')
@section('theCss')
    <link href="{{ asset('css/plugins/iCheck/custom.css" rel="stylesheet') }}">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">

@endsection
@section('theTitle')
    Marigat || Add User
@endsection
@section('theHeading')
    Add New User
@endsection
@section('rowContents')
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Add user and Specify Duty</h5>

                </div>
                <div class="ibox-content">

                    <form action="{{ route('postAddUser') }}" method="post" role="form" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Username: </label>
                            <div class="col-sm-10">
                                <input type="text" name="username" placeholder="kelvinnderitu" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Names: </label>
                            <div class="col-sm-10">
                                <input type="text" name="name" placeholder="e.g Kelvin Nderitu" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone Number: </label>
                            <div class="col-sm-10">
                                <input type="tel" name="phone" placeholder="e.g 0705314090" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">ID Number: </label>
                            <div class="col-sm-10">
                                <input type="number" name="idno" placeholder="e.g 12345678" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work Number: </label>
                            <div class="col-sm-10">
                                <input type="text" name="workno" placeholder="e.g MAR-PHC-DH-001" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">User Level: </label>
                            <div class="col-sm-10">
                                <select title="User Level" class="form-control m-b" name="duty">
                                    <option value=""></option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">
                                {{ csrf_field() }}
                                <button class="btn btn-primary" type="submit">Add User</button>
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
