@extends('backend.layouts.master')

@section('title', __('Change Password'))
@section('small-title', __('Change the login password of the current account.'))

@section('breadcrumb')
    <li>{{__('Account Info')}}</li>
    <li><a href="{{ route('RootChangePassword') }}">{{__('Change Password')}}</a></li>
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading"> {{__('Change Password')}}</header>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{ route('RootChangePasswordAction') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">{{__('Old Password')}}</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" name="old_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">{{__('New Password')}}</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 col-sm-2 control-label">{{__('Confirm Password')}}</label>
                            <div class="col-lg-10">
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit">{{__('Save')}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
