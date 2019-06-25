@extends('backend.layouts.master')

@section('title', __('Role Management'))
@section('small-title', __('Role management within the system'))

@section('breadcrumb')
    <li>{{__('System Setting')}}</li>
    <li><a href="{{ route('RootRoleList') }}">{{__('Role Management')}}</a></li>
@endsection

@section('main')

    <section class="panel">
        <div class="panel-body">
            <form class="form-inline" method="get" role="form" action="{{route(Route::currentRouteName())}}">
                <div class="form-group">
                    <label for="name">{{__('Name')}}: </label>
                    <input type="text" id="name" class="form-control" name="name" value="{{Request::get('name') ?: ''}}">
                </div>

                <div class="form-group">
                    <label for="remark">{{__('Remark')}}: </label>
                    <input type="text" id="remark" class="form-control" name="remark" value="{{Request::get('remark') ?: ''}}">
                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i> {{__('Search')}}</button>
            </form>
        </div>
    </section>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    {{__('Role List')}}
                </header>
                <div class="tbl-head clearfix">
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm" href="{{ route('RootRoleEdit') }}"><i class="fa fa-plus"></i>
                            {{__('Create')}}</a>
                    </div>
                </div>
                <div class="panel-body">
                    @if ($data->isEmpty())
                        <p class="text-center">{{__("No Data")}}</p>
                    @else
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Remark')}}</th>
                                <th>{{__('Created At')}}</th>
                                <th>{{__('Operation')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($data as $item)
                                <tr data-id="{{ $item->id }}" data-name="{{ $item->name }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>@include('backend.components.tooltip', [ 'text' => Str::limit($item->remark, 20), 'title' => $item->remark ])</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-info"
                                           href="{{ route('RootRoleEdit', ['id'=>$item->id]) }}"><i
                                                    class="fa fa-edit"></i> {{__('Edit')}}</a>
                                        <button class="btn btn-xs btn-danger" type="button" data-role="delete"
                                                @if ( ! has_role(auth()->user(), $item)) disabled="disabled" @endif ><i
                                                    class="fa fa-trash-o"></i> {{__('Delete')}}
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @endif
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
                action: '{{ route('RootRoleDelete') }}',
                body: '{{__("Are you sure you want to delete this item?")}}',
                data: data
            });
            return false;
        });
    </script>
@endpush
