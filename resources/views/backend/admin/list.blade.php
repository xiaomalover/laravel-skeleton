@extends('backend.layouts.master')

@section('title', __('Admin Management'))
@section('small-title', __('Admin management within the system'))

@section('breadcrumb')
    <li>{{__('System Setting')}}</li>
    <li><a href="{{ route('RootAdminList') }}">{{__('Admin Management')}}</a></li>
@endsection

@section('main')

    <section class="panel">
        <div class="panel-body">
            <form class="form-inline" method="get" role="form" action="{{route(Route::currentRouteName())}}">
                <div class="form-group">
                    <label for="username">{{__('Username')}}: </label>
                    <input type="text" id="username" class="form-control" name="username" value="{{Request::get('username') ?: ''}}">
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> {{__('Search')}}</button>
            </form>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{__('Admin List')}}
                </header>
                <div class="tbl-head clearfix">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm" href="{{ route('RootAdminEdit') }}"><i class="fa fa-plus"></i>
                            {{__('Create')}}</a>
                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Username')}}</th>
                            <th>{{__('Role')}}</th>
                            <th>{{__('Created At')}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data as $item)
                            <tr data-id="{{ $item->id }}" data-username="{{ $item->username }}">
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->username }}</td>
                                <td>{{ $item->roles_name }}</td>
                                <td>{{ $item->created_at }}</td>
                                <td>
                                    <a class="btn btn-xs btn-info"
                                       href="{{ route('RootAdminEdit', ['id'=>$item->id]) }}"><i class="fa fa-edit"></i>
                                        {{__('Edit')}}</a>
                                    <button class="btn btn-xs btn-danger @if ($item->id === 1 || $item->id === auth()->id())disabled @endif"
                                            type="button" data-role="delete"><i class="fa fa-trash-o"></i> {{__('Delete')}}
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @include('backend.layouts.paginate')
            </section>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $('[data-role="delete"]').on('click', function () {
            var data = $(this).parents('tr').data();
            iconfirm({
                action: '{{ route('RootAdminDelete') }}',
                body: '{{__("Are you sure you want to delete this item?")}}',
                data: data
            });
            return false;
        });
    </script>
@endpush
