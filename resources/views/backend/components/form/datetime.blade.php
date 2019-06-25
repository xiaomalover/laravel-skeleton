{{--
	$label				标签名
	$name				表单名
	$value				默认值
	$style				附加样式
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-datetime-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<div class="input-group date">
			<input
				class="form-control"
				type="text"
				id="input-datetime-{{ $name }}"
				name="{{ $name }}"
				value="{{ Request::old($name, Request::get($name, $data ? $data->$name : (isset($value) ? $value : ''))) }}"
				placeholder="{{ $label }}"
				autocomplete="off"
				data-mask="9999-99-99 99:99:99"
				style="{{ $style or '' }}"
			>
			<span class="input-group-btn">
				<button type="button" class="btn btn-primary date-set"><i class="fa fa-calendar"></i></button>
			</span>
		</div>
	</div>
</div>

@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('slicklab/js/bootstrap-datetimepicker/css/datetimepicker.css') }}"/>
@endpush

@push('script')
<script src="{{ asset('slicklab/js/bs-input-mask.min.js') }}"></script>
<script src="{{ asset('slicklab/js/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js') }}"></script>
<script src="{{ asset('slicklab/js/bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.zh-CN.js') }}"></script>
<script>
	$('#input-datetime-{{ $name }}').datetimepicker({
		language: 'zh-CN',
	    format: 'yyyy-mm-dd hh:ii:ss',
	    autoclose: true
	});
</script>
@endpush