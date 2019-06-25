@if ( ! $data->isEmpty())
<div class="tbl-footer clearfix">
	<div class="pull-left">
		<div class="dataTables_info" style="margin: 20px 0;">
			<label>
				{{__('Every page shows')}}
				<select name="limit" class="form-control input-sm" id="PageLimit" style="display: inline; width: 60px;">
				@foreach ([5,15,20,50,100,200] as $limit)
					<option value="{{ $limit }}" @if ( (isset($_COOKIE['limit']) ? $_COOKIE['limit'] : 15) == $limit)selected @endif>{{ $limit }}</option>
				@endforeach
				</select>
			</label>
			{{__('items')}}，{{__('Total')}} {{ number_format($data->total()) }} {{__('items')}}。
		</div>
	</div>
	<div class="tbl-pagin pull-right">
		<div class="dataTables_paginate paging_simple_numbers">
			{!! $data->render() !!}
		</div>
	</div>
</div>
@endif