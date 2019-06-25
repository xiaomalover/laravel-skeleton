var S = KISSY;
if(S.Config.debug){
    var srcPath = "../../../../";
    S.config({
    packages:[
    {
        name:"gallery",
        path:srcPath,
        charset:"utf-8"
    }
    ]
    });
}

var __uploader = S.Node.all;

S.use('gallery/uploader/1.4/index,gallery/uploader/1.4/themes/imageUploader/index,gallery/uploader/1.4/themes/imageUploader/style.css', function (S, Uploader,ImageUploader) {
    //上传插件
    var plugins = 'gallery/uploader/1.4/plugins/auth/auth,' +
    'gallery/uploader/1.4/plugins/urlsInput/urlsInput,' +
    'gallery/uploader/1.4/plugins/proBars/proBars,' +
    'gallery/uploader/1.4/plugins/filedrop/filedrop,' +
    'gallery/uploader/1.4/plugins/tagConfig/tagConfig,' +
    'gallery/uploader/1.4/plugins/preview/preview';

    S.use(plugins,function(S,Auth,UrlsInput,ProBars,Filedrop,Preview){
    var uploader = new Uploader('.uploader_btn',{
        //处理上传的服务器端脚本路径
        action:"/admin/file/put?uploader=1",
        multiple:true
    });
    //上传成功后显示图片描述
    uploader.on('success',function(ev) {
        var obj = __uploader('#upload_file_id_'+ev.file.id);
        obj.val(ev.result.hash);
    });

    //使用主题
    uploader.theme(new ImageUploader({
        queueTarget:'#UploaderQueue'
        }))
    //验证插件
    .plug(new Auth({
        //最多上传个数
        max:5,
        //图片最大允许大小
        maxSize:5000
        }))
    //url保存插件
    .plug(new UrlsInput({ target:'#J_Urls'}))
    //进度条集合
    .plug(new ProBars())
    //拖拽上传
    .plug(new Filedrop())
    //图片预览
    .plug(new Preview());
    //渲染默认数据
    uploader.restore();
});
})