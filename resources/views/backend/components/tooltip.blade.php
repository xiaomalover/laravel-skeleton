<span
@if (isset($id))
	id="{{ $id }}"
@endif
	class="tooltips {{ isset($class) ? $class : '' }}"
	data-toggle="tooltip"
	data-placement="top"
	data-original-title="{{ $title or $text }}"
>
	{{ $text }}
</span>