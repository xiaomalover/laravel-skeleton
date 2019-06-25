{{--
	$label					标签名
	$name					表单名
	$value					默认值
	$placeholder		提示文本
	$help					帮助文本
	$addon_before	额外元素-前
	$addon_after		额外元素-后
--}}
<div class="form-group">
	<label class="col-sm-2 col-sm-2 control-label" for="input-text-{{ $name }}">{{ $label }}</label>
	<div class="col-sm-10">
		@if (isset($addon_after) || isset($addon_before)) <div class="input-group"> @endif
			@if (isset($addon_before))
				<span class="input-group-addon" id="input-text-{{ $name }}-addon_before">{{ $addon_before }}</span>
			@endif
			<input
				class="form-control"
				type="text"
				name="{{ $name }}"
				id="input-text-{{ $name }}"
				value="{{ Request::old($name, Request::get($name, isset($data) ? $data->$name : (isset($value) ? $value : ''))) }}"
				placeholder="{{ $placeholder or $label }}"
			>
			@if (isset($addon_after))
				<span class="input-group-addon" id="input-text-{{ $name }}-addon_after">{{ $addon_after }}</span>
			@endif
		@if (isset($addon_after) || isset($addon_before)) </div> @endif
		@if ($help ?? '') <p id="help-block-{{ $name }}" class="help-block">{{ $help }}</p> @endif
	</div>
</div>