{{--
	$label				标签名
	$name				表单名
	$value				默认值
	$rows				行数
	$placeholder	提示文本
	$help				帮助文本
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-text-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<textarea
			class="form-control"
			name="{{ $name }}"
			id="input-textarea-{{ $name }}"
			rows="{{ $rows or 7 }}"
			placeholder="{{ $placeholder or $label }}"
		>{{ Request::old($name, Request::get($name, isset($data) ? $data->$name : (isset($value) ? $value : ''))) }}</textarea>
		@if ($help ?? '') <p id="help-block-{{ $name }}" class="help-block">{{ $help }}</p> @endif
	</div>
</div>