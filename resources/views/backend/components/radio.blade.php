{{--
	$name			表单名
	$options		选项列表。$value => $text
	$checked	默认选中项的value
--}}
@foreach ($options as $value => $text)
	<label class="radio-custom inline radio-info">
		<input type="radio" name="{{ $name }}" value="{{ $value }}" id="input-radio-{{ $name }}-{{ $value }}" @if ($value == $checked) checked @endif >
		<label for="input-radio-{{ $name }}-{{ $value }}">{{ $text }}</label>
	</label>
@endforeach