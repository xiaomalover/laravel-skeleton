<?php

// 翻页信息。
$_paginate_page = Request::input('page', 1);
$_paginate_page = $_paginate_page < 1 ? 1 : $_paginate_page;
$_paginate_limit = @$_COOKIE['limit'] ?  : 15;

// 是否存在下一页。
$has_next = $_paginate_limit == count($data);

// 翻页链接的基础地址。
$_paginate_link = http_build_query(Request::except('page'));
$_paginate_link .= $_paginate_link ? '&' : '';

?>
<div class="tbl-footer clearfix">
	<div class="pull-left">
		<div class="dataTables_info" style="margin: 20px 0;">
			<label>
				每页显示
				<select name="limit" class="form-control input-sm" id="PageLimit" style="display: inline; width: 60px;">
				@foreach ([5,15,20,50,100,200] as $limit)
					<option value="{{ $limit }}" @if ($_paginate_limit == $limit)selected @endif>{{ $limit }}</option>
				@endforeach
				</select>
			</label>
		</div>
	</div>
	<div class="tbl-pagin pull-right">
		<div class="dataTables_paginate paging_simple_numbers">
			<ul class="pager">
				<li class="previous @if ($_paginate_page <= 1) disabled @endif" style="margin-right: 12px;"><a @if ($_paginate_page > 1) href="?{{ $_paginate_link }}page={{ $_paginate_page-1 }}"@endif >{{ trans('pagination.previous') }}</a></li>
				<li class="next @if ( ! $has_next) disabled @endif"><a @if ($has_next) href="?{{ $_paginate_link }}page={{ $_paginate_page+1 }}" @endif >{{ trans('pagination.next') }}</a></li>
			</ul>
		</div>
	</div>
</div>
