@extends('backend.layouts.master')

@section('title', __('Edit Role'))
@section('small-title', __('Create or edit role'))

@section('breadcrumb')
    <li>{{__('System Setting')}}</li>
    <li><a href="{{ route('RootRoleList') }}">{{__('Role Management')}}</a></li>
    <li><a href="{{ route('RootRoleEdit', [ 'id' => $data ? $data->id : '' ]) }}">{{__('Edit Role')}}</a></li>
@endsection

@section('main')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">{{__('Role Info')}}</header>
                <div class="panel-body">
                    <form method="post" class="form-horizontal" action="{{ route('RootRoleEditAction') }}">
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
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Name')}}</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="text" name="name"
                                       value="{{ Request::old('name', $data ? $data->name : '') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Remark')}}</label>
                            <div class="col-sm-10">
                                <textarea class="form-control"
                                          name="remark">{{ Request::old('remark', $data ? $data->remark : '') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">{{__('Permissions')}}</label>
                            <div class="col-sm-10">
                                @if ($permissions->isEmpty())
                                    <p class="form-control-static">{{__('Please create permissions in permission management first.')}} <a href="{{ route('RootPermissionList') }}">{{__('Go to create')}}</a></p>
                                    @else
                                    <?php $_temp = null; ?>
                                    @foreach ($permissions as $item)
                                    @if ($item->group !== $_temp)
                                    @if ($_temp !== null)
                                    </dl>
                                @endif
                                <dl class="col-lg-3">
                                    <dt>{{ $item->group }}</dt>
                                    <?php $_temp = $item->group; ?>
                                    @endif
                                    <dd>
                                        <label for="purview-{{ $item->key }}" class="checkbox-custom inline check-info">
                                            <input type="checkbox" name="permissions[]" value="{{ $item->key }}"
                                                   id="purview-{{ $item->key }}"
                                                   @if ($data && in_array($item->key, (array)Request::old('permissions', $data->permissions->pluck('key')->all()))) checked
                                                   @endif
                                                   @if ( ! has_permission(auth()->user(), $item)) disabled @endif
                                            >
                                            <label for="purview-{{ $item->key }}">{{ $item->name }}</label>
                                        </label>
                                    </dd>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <input type="hidden" name="id" value="{{ isset($data) ? $data->id : '' }}">
                                <button class="btn btn-primary" type="submit"
                                        @if ($data && ! has_role(auth()->user(), $data)) disabled="disabled" @endif >{{__('Save')}}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
