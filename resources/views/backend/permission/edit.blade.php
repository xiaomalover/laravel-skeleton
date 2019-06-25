@extends('backend.layouts.master')

@section('title', __('Edit Permission'))
@section('small-title', __('Create or edit permission'))

@section('breadcrumb')
    <li>{{__('System Setting')}}</li>
    <li><a href="{{ route('RootPermissionList') }}">{{__('Permission Management')}}</a></li>
    <li><a href="{{ route('RootPermissionEdit', [ 'key' => ($data ? $data->key : '') ]) }}">{{__('Edit Permission')}}</a></li>
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">{{__('Permission Info')}}</header>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" action="{{ route('RootPermissionEditAction') }}">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Key</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="key"
                                       value="{{ Request::old('key', ($data ? $data->key : '')) }}"
                                       @if ($data)readonly @endif>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Name')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name"
                                       value="{{ Request::old('name', ($data ? $data->name : '')) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Group Name')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="group"
                                       value="{{ Request::old('group', ($data ? $data->group : '')) }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Remark')}}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"
                                          name="remark">{{ Request::old('remark', ($data ? $data->remark : '')) }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Operation')}}</label>
                            <div class="col-sm-10">
                                @foreach ($routes as $key => $name)
                                    <label class="checkbox-custom inline check-info">
                                        <input type="checkbox" name="actions[]" value="{{ $key }}" id="route-{{ $key }}"
                                               @if (in_array($key, (array)Request::old('actions', $data ? $data->actions->all() : []))) checked
                                               @endif
                                               @if (auth()->user()->denies($key)) disabled @endif
                                        >
                                        <label for="route-{{ $key }}">{{ $name }}</label>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit"
                                        @if ($data && ! has_permission(auth()->user(), $data)) disabled="disabled" @endif >
                                    {{__('Save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
