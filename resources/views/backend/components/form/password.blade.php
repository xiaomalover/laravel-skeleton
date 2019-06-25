{{--
	$label				标签名
	$name				表单名
	$placeholder	提示文本
	$help				帮助文本
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-text-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		<input
			class="form-control"
			type="password"
			name="{{ $name }}"
			id="input-text-{{ $name }}"
			placeholder="{{ $placeholder or $label }}"
		>
		@if (isset($help) && $help)
			<p class="help-block">{{ $help }}</p>
		@endif
	</div>
</div>