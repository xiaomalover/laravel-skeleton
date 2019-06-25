@extends('backend.layouts.master')

@section('title', __('Edit Admin'))
@section('small-title', __('Create or edit admin'))

@section('breadcrumb')
    <li>{{__('System Setting')}}</li>
    <li><a href="{{ route('RootAdminList') }}">{{__('Admin Management')}}</a></li>
    <li><a href="{{ route('RootAdminEdit', [ 'id' => $data ? $data->id : '' ]) }}">{{__('Edit Admin')}}</a></li>
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">{{__('Admin Info')}}</header>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" action="{{ route('RootAdminEditAction') }}">
                        {!! csrf_field() !!}
                        @if ($data)
                            <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label">#</label>
                                <div class="col-lg-10">
                                    <p class="form-control-static">{{ $data->id }}</p>
                                </div>
                            </div>
                        @endif
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Username')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="username"
                                       value="{{ Request::old('username', $data ? $data->username : '') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Password')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password">
                                @if ($data)<p class="help-block">{{__('Please leave blank if you do not change your password.')}}</p>@endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Confirm Password')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="password" name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Roles')}}</label>
                            <div class="col-sm-10">
                                @if ($roles->isEmpty())
                                    <p class="form-control-static">
                                        {{__('Please create role in role management first.')}} <a href="{{ route('RootRoleList') }}">{{__('Go to create')}}</a>
                                    </p>
                                @else
                                    @if ($data && $data->id == 1)
                                        <p class="form-control-static">Root</p>
                                    @else
                                        <p class="help-block">{{__('Each user has at least one role.')}}</p>
                                        @foreach ($roles as $item)
                                            <label class="checkbox-custom inline check-info">
                                                <input type="checkbox" name="roles[]" value="{{ $item->id }}"
                                                       id="role-{{ $item->id }}"
                                                       @if ($data && $data->roles && in_array($item->id, (array)Request::old('roles', $data->roles->pluck('id')->all())))checked
                                                       @endif
                                                       @if ( ! has_role(auth()->user(), $item)) disabled @endif
                                                >
                                                <label for="role-{{ $item->id }}">{{ $item->name }}</label>
                                            </label>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Permissions')}}</label>
                            <div class="col-sm-10">
                                @if ($permissions->isEmpty())
                                    <p class="form-control-static">
                                        {{__('Please create permissions in permission management first.')}} <a href="{{ route('RootPermissionList') }}">{{__('Go to create')}}
                                    </p>
                                @else
                                    @if ($data && $data->id == 1)
                                        <p class="form-control-static">{{__('All Permission')}}</p>
                                    @else
                                        <p class="help-block">{{__('Permission to the user, in addition to the permissions that the user role has.')}}</p>
                                        <div class="clearfix">
                                            <?php $_temp = null; ?>
                                            @foreach ($permissions as $item)
                                            @if ($item->group !== $_temp)
                                            @if ($_temp !== null)
                                            </dl>
                                            @endif
                                            <dl class="col-lg-3">
                                                <dt>{{ isset($item) ? $item->group : '' }}</dt>
                                                <?php $_temp = $item->group; ?>
                                                @endif
                                                <dd>
                                                    <label for="purview-{{ $item->key }}"
                                                           class="checkbox-custom inline check-info">
                                                        <input type="checkbox" name="permissions[]"
                                                               value="{{ $item->key }}" id="purview-{{ $item->key }}"
                                                               @if ($data && in_array($item->key, (array)Request::old('permissions', $data->permissions->pluck('key')->all()))) checked
                                                               @endif
                                                               @if ( ! has_permission(auth()->user(), $item)) disabled @endif
                                                        >
                                                        <label for="purview-{{ $item->key }}">{{ $item->name }}</label>
                                                    </label>
                                                </dd>
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="hidden" name="id" value="{{ $data ? $data->id : '' }}">
                                <button class="btn btn-primary" type="submit"
                                        @if ($data && ! sub_admin(auth()->user(), $data)) disabled="disabled" @endif >{{__('Save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
