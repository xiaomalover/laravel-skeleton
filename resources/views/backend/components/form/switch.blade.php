{{--
	$label				标签名
	$name				表单名
	$checked		是否选中
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-switch-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<input
			type="checkbox"
			id="input-switch-{{ $name }}"
			name="{{ $name }}"
			value="1"
		@if (Request::old($name, Request::get($name, $data ? $data->$name : (isset($checked) ? $checked : ''))))
			checked
		@endif
			>
	</div>
</div>

@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('slicklab/js/switchery/switchery.min.css') }}"/>
@endpush

@push('script')
<script src="{{ asset('slicklab/js/switchery/switchery.min.js') }}"></script>
<script>
	$(function(){
		new Switchery(document.getElementById('input-switch-{{ $name }}'));
	});
</script>
@endpush