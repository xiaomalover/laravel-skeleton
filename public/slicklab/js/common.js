
// 自定义Alert弹窗。
function ialert(msg) {
    var func = arguments[1];
    $('#alertModal').find('.modal-body').text(msg).end().one('hidden.bs.modal', function(){
        if (typeof func == 'function') {
            func.call(this);
        }
    }).modal();
}

//自定义Confirm弹窗。
function iconfirm(options) {
	options = $.extend({
		'action': '#',
		'title'	: $("#confirmTitle").val(),
		'body'	: '',
		'data'	: {},
		'ok'		: $.noop,
		'target'	: '_self'
	}, options || {});
	
	var $model = $('#confirmModal');

	var callback = $.noop;
	if (typeof options.ok == 'function') {
		callback = function() {
			if(options.ok.call() !== false) {
				$model.find('input[type="hidden"]').filter('[name!="_token"]').remove();
	        	var $form = $model.find('form').attr('target', options.target).attr('action', options.action)
	        	$.each(options.data, function(key, value) {
                    if($.isArray(value)) {
                        $.each(value, function() {
                            $form.append('<input type="hidden" name="' + key + '[]" value="' + this + '" />');
                        });
                    } else {
                        $form.append('<input type="hidden" name="' + key + '" value="' + value + '" />');
                    }
                });
	        	$form.get(0).submit();
			}
		};
	 }
	
	var submit = false;
	$model.find('button[data-primary="true"]').off('click').on('click', function() {
		submit = true;
		$model.modal('hide');
		if(options.target == '_blank'){
			callback.call();
		}
		 return false;
	});
	
	$('#confirmModalLabel').text(options.title);
	$model.find('.modal-body').html(options.body).end().one('hidden.bs.modal', function(){
        if(submit && options.target != '_blank'){
			callback.call();
		}
    }).modal('show');
	
	if(options.target != '_blank'){
		$model.find('button[data-primary="true"] .fa').hide();
	}else{
		$model.find('button[data-primary="true"] .fa').show();
	}
}

// 限制输入框中只能输入整数
$(document).on('keyup', '.integer_number', function() {
    if ($(this).val() != '' && !/^[\d]+$/.test($(this).val())) {
        $(this).val('');
    }
});

// 现在输入框中只能输入数字
$(document).on('keyup', '.float_number', function() {
    if ($(this).val() != '' && isNaN($(this).val())) {
        $(this).val('');
    }
});

// 返回上一页
$(document).on('click', '#go_back', function(e) {
    e.preventDefault();
    if ($(this).attr('data-url'))
    window.history.go(-1);
});

// 异步提交通用配置
$.ajaxSetup({
    type: "POST",
    dataType: 'json',
    headers: {
    	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    statusCode: {
        401: function() {
            ialert('请先登录');
        },
        403: function() {
            ialert('您没有相关权限执行此操作')
        },
        404: function() {
            ialert('访问错误');
        },
        422: function(xhq) {
        	var message = xhq.responseText;
        	if(xhq.responseJSON){
        		message = '';
        		$.each(xhq.responseJSON, function(){
        			message += this.join('\n');
        		});
        	}
            ialert(message);
        },
        500: function() {
            ialert('系统错误');
        }
    }
});

// 异步提交表单
function submitForm(func, form, options) {
    if (typeof  form == 'undefined') {
        form = $("#form");
    }
    options = $.extend({
        data: form.serialize(),
        url: form.attr('action'),
        success: function(data) {
            if (data.status == 200) {
                func(data);
            } else {
                ialert(data.message);
            }
        }
    }, options || {});

    $.ajax(options);

}


//自定义Confirm弹窗。
function iconfirm2(options) {
    options = $.extend({
        'action': '#',
        'title'	: '操作确认',
        'body'	: '',
        'data'	: {},
        'autoHide' : false,
        'ok'		: null
    }, options || {});

    var $form = $('#confirmModal').find('form').attr('action', options.action);
    $('#confirmModal button[data-primary="true"]').off('click').on('click', function() {
        if (options.autoHide) {
            $('#confirmModal').modal('hide');
        }
        var html = '';
        $.each(options.data, function(key, value) {
            if($.isArray(value)) {
                $.each(value, function() {
                    html += '<input type="hidden" name="' + key + '[]" value="' + this + '" />';
                });
            } else {
                html += '<input type="hidden" name="' + key + '" value="' + value + '" />';
            }
        });
        $form.append('<div id="_extra_field_data_">'+html+'</div> ');

        if (typeof options.ok == 'function') {
            if (options.ok.call(this) == true) {
                $('#confirmModal').modal('hide');
            }
        } else {
            $('#confirmModal').modal('hide');
            $form.get(0).submit();
        }
        return false;
    });

    $('#confirmModalLabel').text(options.title);
    $('#confirmModal').find('.modal-body').html(options.body).end().one('hidden.bs.modal', function(){
        $("#_extra_field_data_").remove();
    }).modal('show');
}

// 文件上传控件。
$.fn.iFile = function(options){
	this.each(function(){
		var $this = $(this);

		// 控件属性。
		var opt =  {
			language : 'zh',
			uploadUrl : '/storage/upload-ajax'
		};
		if($this.val() != ''){
			opt.initialPreview = [
				'<img src="' + $this.val() + '" class="file-preview-image" alt="" title="">'
			]
		}
		opt = $.extend(opt, options || {});

		// 创建一个文件上传控件。
		var $elem = $('<input class="file" type="file" name="file">');

		// 隐藏当前文本输入框。
		$this.attr('type', 'hidden').after($elem);

		// 创建文件上传控件，并绑定相关事件。
		$elem.fileinput(opt).on('filecleared', function(event){
			$this.val('');
		}).on('fileuploaded', function(event, data, previewId, index){
			var url = data.response.url;
			$this.val(url);
		});
	});
};

// 本地配置存储。
// 用户储存用户图标的线条展示隐藏等等。
iconfig = new function(){
	if(window.localStorage){
		var storage = window.localStorage;
		this.set = function(key, value, path){
			if(typeof path == 'undefined'){
				path = window.location.pathname;
			}
			var _k = 'config:' + path + '?' + key;
			storage[_k] = value;
		};
		this.get = function(key, def, path){
			if(typeof def == 'undefined'){
				def = null;
			}
			if(typeof path == 'undefined'){
				path = window.location.pathname;
			}
			var _k = 'config:' + path + '?' + key;
			return typeof storage[_k] == 'undefined' ? def : storage[_k];
		};
	}else{
		this.set = function(key, value, path){
			if(typeof path == 'undefined'){
				path = window.location.pathname;
			}
			$.cookie(key, value, { path: path });
		};
		this.get = function(key, def, path){
			if(typeof def == 'undefined'){
				def = null;
			}
			if(typeof path == 'undefined'){
				path = window.location.pathname;
			}
			var ret = $.cookie(key, value, { path: path });
			return ret === null ? def : ret;
		};
	}
};

// HTML编辑器。
// 处理好summernote的图片上传。
$.fn.htmlEditor = function(upload_url){
	this.each(function(){
		$(this).summernote({
			lang					: 'zh-CN',
			height				: 300,
			dialogsInBody	: true,
			dialogsFade		: true,
			codemirror		: {
				theme: 'monokai'
			},
			toolbar: [
				['font', ['bold', 'italic', 'strikethrough', 'underline', 'clear']],
				['fontsize', ['fontsize']],
				['height', ['height']],
				['color', ['color']],
				['para', ['ul', 'ol', 'paragraph']],
				['insert', ['link', 'picture', 'video']],
				['view', ['fullscreen', 'codeview']]
			],
			callbacks: {
				onImageUpload: function(files) {
					var $editor = $(this), completed = 0;
					$editor.summernote('disable');
					$.each(files, function(index){
						var data = new FormData();
						data.append('file', files[index]);
						$.ajax({
							data					: data,
							type					: 'POST',
							url					: upload_url,
							cache				: false,
							contentType	: false,
							processData	: false,
							dataType			: 'text',
							success			: function(url) {
								$editor.summernote('insertImage', url);
							},
							complete			: function(){
								completed ++;
								if(completed == files.length){
									$editor.summernote('enable');
								}
							}
						});
					});
				}
			}
		});
	});
};

//调整好样式的统计图。
$.fn.iCharts = function(options){
	this.each(function(){
		var opt = {
			chart: {
				type: 'spline',
				zoomType: 'x',
				height: options.height || 700
			},
			title: {
	            text: null
	        },
			xAxis: {
	            categories: options.categories
	        },
	        yAxis: {
	        	title: {
	                text: null
	            },
	            min: 0
	        },
	        tooltip: {
	            crosshairs: {
	                width: 1
	            },
	            shared: true
	        },
	        plotOptions: {
	        		spline: {
	            		lineWidth: 2,
	            		states: {
	            			hover: {
	            				lineWidthPlus: 0,
	            				halo: {
	            					size: 8
	            				}
	                     }
	            		},
	                marker: {
	                		enabled: false,
	                		radius: 2
	                }
	        		}
			},
	        series: options.series
	    };
		for(var i = 0; i < options.series.length; i++){
			if(typeof options.series[i].summary != 'undefined'){
				opt.legend = {
		            layout: 'vertical',
		            labelFormat: '{name} <span style="font-weight:normal">{options.summary}</span>'
		        };
				break;
			}
		}
		for(var i = 0; i < options.series.length; i++){
			opt.series[i].events = {
	        	hide: function(e){
	        		iconfig.set('iCharts/' + e.currentTarget.name + '/visible', false);
	    		},
	        	show: function(e){
	        		iconfig.set('iCharts/' + e.currentTarget.name + '/visible', true);
	    		}
	        };
			switch(iconfig.get('iCharts/' + options.series[i].name + '/visible')){
				case null:
				case 'true':
					opt.series[i].visible = true;
					break;
				case false:
				case 'false':
					opt.series[i].visible = false;
					break;
			}
		}
		$(this).highcharts(opt);
	});
};

//比率图。
$.fn.iRatio = function(options){
	this.each(function(){
		var opt = {
			chart: {
				type: 'spline',
				zoomType: 'x',
				height: options.height || 500
			},
			title: {
				text: null
			},
			xAxis: {
				categories: options.categories
			},
			yAxis: {
				title: {
					text: null
				},
				min: 0,
				max: 100
			},
			tooltip: {
				crosshairs: {
					width: 1
				},
				shared: true
			},
			plotOptions: {
	        		spline: {
	            		lineWidth: 2,
	            		states: {
	            			hover: {
	            				lineWidthPlus: 0,
	            				halo: {
	            					size: 8
	            				}
	                     }
	            		},
	                marker: {
	                		enabled: false,
	                		radius: 2
	                }
	        		}
			},
			series: options.series
	    };
		for(var i = 0; i < options.series.length; i++){
			if(typeof options.series[i].summary != 'undefined'){
				opt.legend = {
		            layout: 'vertical',
		            labelFormat: '{name} <span style="font-weight:normal">{options.summary}</span>'
		        };
				break;
			}
		}
		for(var i = 0; i < options.series.length; i++){
			opt.series[i].events = {
	        	hide: function(e){
	        		iconfig.set('iRatio/' + e.currentTarget.name + '/visible', false);
	    		},
	        	show: function(e){
	        		iconfig.set('iRatio/' + e.currentTarget.name + '/visible', true);
	    		}
	        };
			switch(iconfig.get('iRatio/' + options.series[i].name + '/visible')){
				case null:
				case 'true':
					opt.series[i].visible = true;
					break;
				case false:
				case 'false':
					opt.series[i].visible = false;
					break;
			}
		}
		$(this).highcharts(opt);
	});
};
