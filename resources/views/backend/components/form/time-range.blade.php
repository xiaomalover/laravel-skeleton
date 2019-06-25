{{--
	$label				标签名
	$name				表单名
	$value				默认值
	$style				附加样式
--}}
<div class="form-group">
	<label class="sr-only" for="input-select-{{ $name }}">{{ $label }}</label>
	<div class="input-group">
		<input
			id="input-select-{{ $name }}"
			class="form-control"
			type="text"
			name="{{ $name }}"
			value="{{ $value }}"
			placeholder="{{ $label }}"
			data-mask="9999-99-99 ~ 9999-99-99"
			autocomplete="off"
			style="{{ $style }}"
		>
	</div>
</div>

@push('head')
<link rel="stylesheet" type="text/css" href="{{ asset('slicklab/js/bootstrap-daterangepicker/daterangepicker.css') }}"/>
@endpush

@push('script')
<script src="{{ asset('slicklab/js/bs-input-mask.min.js') }}"></script>
<script src="{{ asset('slicklab/js/bootstrap-daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('slicklab/js/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<script>
	$('#input-select-{{ $name }}').daterangepicker({
		ranges: {
			'最近7天': [moment().subtract(7, 'day'), moment()],
			'最近30天': [moment().subtract(30, 'day'), moment()],
			'本周': [moment().startOf('isoWeek'), moment().endOf('isoWeek')],
			'上周': [moment().subtract(1, 'week').startOf('isoWeek'), moment().subtract(1, 'week').endOf('isoWeek')],
			'本月': [moment().startOf('month'), moment().endOf('month')],
			'上月': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		opens: 'right',
		maxDate: moment(),
		locale: {
			format: 'YYYY-MM-DD',
			separator: ' ~ ',
			applyLabel: '应用',
			cancelLabel: '清空',
			weekLabel: '周',
			customRangeLabel: '自定义时间段',
			daysOfWeek: ['日', '一', '二', '三', '四', '五','六'],
			monthNames: ['一月', '二月', '三月', '四月', '五月', '六月', '七月', '八月', '九月', '十月', '十一月', '十二月'],
			firstDay: 1
		},
		buttonClasses: ['btn']
	}).on('cancel.daterangepicker', function() {
		$(this).val('');
	}).val('{{ $value }}');
</script>
@endpush