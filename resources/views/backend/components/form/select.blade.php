{{--
	$label				标签名
	$name				表单名
	$options			选项列表。$value => $text
	$selected			默认选中项的value
	$multiple			是否多选
	$style				附加样式
	$placeholder	提示信息
	$search			显示搜索框
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-select-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<select
			id="input-select-{{ $name }}"
			class="form-control select2-multiple"
			name="{{ $name }}"
			@if (isset($multiple) && $multiple)
				multiple="multiple" size="1"
			@endif
			style="min-width: 180px; {{ $style or '' }}"
		>
			<option value=""></option>
			@foreach ($options as $value => $text)
				<option value="{{ $value }}" @if ($value == Request::old($name, Request::get($name, isset($data) ? $data->$name : (isset($selected) ? $selected : '')))) selected @endif >{{ $text }}</option>
			@endforeach
		</select>
	</div>
</div>

@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('slicklab/css/select2.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('slicklab/css/select2-bootstrap.css') }}">
@endpush

@push('script')
<script src="{{ asset('slicklab/js/select2.js') }}"></script>
<script>
	$(function(){
		$('#input-select-{{ $name }}').select2({
			@if ( ! isset($search) || ! $search)
				minimumResultsForSearch: Infinity,
			@endif
			allowClear: true,
			placeholder: '{{ $placeholder or $label }}'
		});
	});
</script>
@endpush