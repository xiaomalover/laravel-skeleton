{{--
	$label				标签名
	$name				表单名
	$value				默认值
	$min					最小值
	$max				最大值
	$step				步长
	$decimal			小数点位数
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-number-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<input
			class="form-control"
			type="text"
			id="input-number-{{ $name }}"
			name="{{ $name }}"
			value="{{ Request::old($name, Request::get($name, isset($data) ? $data->$name : (isset($value) ? $value : ''))) }}"
		@if (isset($min))
			data-bts-min="{{ $min }}"
		@endif
		data-bts-max="{{ $max or '9999999999' }}"
		@if (isset($step))
			data-bts-step="{{ $step }}"
		@endif
		@if (isset($decimal))
			data-bts-decimal="{{ $decimal }}"
		@endif
		 />
	</div>
</div>

@push('script')
<script src="{{ asset('slicklab/js/touchspin.js') }}"></script>
<script>
	$(function(){
		$('#input-number-{{ $name }}').TouchSpin();
	});
</script>
@endpush