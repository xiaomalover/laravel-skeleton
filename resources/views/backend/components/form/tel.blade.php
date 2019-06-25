{{--
	$label				标签名
	$name				表单名
	$value				默认值
	$placeholder	提示文本
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-text-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<input
			class="form-control"
			type="tel"
			name="{{ $name }}"
			id="input-text-{{ $name }}"
			value="{{ Request::old($name, Request::get($name, $data ? $data->$name : (isset($value) ? $value : ''))) }}"
			placeholder="{{ $placeholder or $label }}"
		>
	</div>
</div>