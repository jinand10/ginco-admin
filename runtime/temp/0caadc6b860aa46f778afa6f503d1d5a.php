<?php if (!defined('THINK_PATH')) exit(); /*a:4:{s:78:"/www/ginco/ginco-admin/public/../application/admin/view/banner/banner/add.html";i:1587659511;s:65:"/www/ginco/ginco-admin/application/admin/view/layout/default.html";i:1580299046;s:62:"/www/ginco/ginco-admin/application/admin/view/common/meta.html";i:1580299046;s:64:"/www/ginco/ginco-admin/application/admin/view/common/script.html";i:1580299046;}*/ ?>
<!DOCTYPE html>
<html lang="<?php echo $config['language']; ?>">
    <head>
        <meta charset="utf-8">
<title><?php echo (isset($title) && ($title !== '')?$title:''); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="renderer" content="webkit">

<link rel="shortcut icon" href="/assets/img/favicon.ico" />
<!-- Loading Bootstrap -->
<link href="/assets/css/backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.css?v=<?php echo \think\Config::get('site.version'); ?>" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
<!--[if lt IE 9]>
  <script src="/assets/js/html5shiv.js"></script>
  <script src="/assets/js/respond.min.js"></script>
<![endif]-->
<script type="text/javascript">
    var require = {
        config:  <?php echo json_encode($config); ?>
    };
</script>
    </head>

    <body class="inside-header inside-aside <?php echo defined('IS_DIALOG') && IS_DIALOG ? 'is-dialog' : ''; ?>">
        <div id="main" role="main">
            <div class="tab-content tab-addtabs">
                <div id="content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <section class="content-header hide">
                                <h1>
                                    <?php echo __('Dashboard'); ?>
                                    <small><?php echo __('Control panel'); ?></small>
                                </h1>
                            </section>
                            <?php if(!IS_DIALOG && !$config['fastadmin']['multiplenav']): ?>
                            <!-- RIBBON -->
                            <div id="ribbon">
                                <ol class="breadcrumb pull-left">
                                    <li><a href="dashboard" class="addtabsit"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
                                </ol>
                                <ol class="breadcrumb pull-right">
                                    <?php foreach($breadcrumb as $vo): ?>
                                    <li><a href="javascript:;" data-url="<?php echo $vo['url']; ?>"><?php echo $vo['title']; ?></a></li>
                                    <?php endforeach; ?>
                                </ol>
                            </div>
                            <!-- END RIBBON -->
                            <?php endif; ?>
                            <div class="content">
                                <form id="edit-form" class="form-horizontal" role="form" data-toggle="validator" method="POST" action="">
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Module'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_select('row[module]', $moduleList, null, ['class'=>'form-control selectpicker', 'data-rule'=>'required']); ?>
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('Article'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_select('row[article_id]', $articleList, null, ['class'=>'form-control selectpicker', 'data-rule'=>'required']); ?>
        </div>
    </div>

    <div class="form-group">
        <label for="c-cover" class="control-label col-xs-12 col-sm-2"><?php echo __('Cover'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input placeholder="建议图片尺寸720*350哦~" id="c-cover" data-rule="required" class="form-control" size="50" name="row[cover]" type="text" value="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-cover" class="btn btn-danger plupload" data-input-id="c-cover" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-cover"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-cover" class="btn btn-primary fachoose" data-input-id="c-cover" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-cover"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-cover"></ul>
        </div>
    </div>
    <div class="form-group">
        <label for="c-english_cover" class="control-label col-xs-12 col-sm-2"><?php echo __('EnglishCover'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <div class="input-group">
                <input placeholder="建议图片尺寸720*350哦~" id="c-english_cover" data-rule="required" class="form-control" size="50" name="row[english_cover]" type="text" value="">
                <div class="input-group-addon no-border no-padding">
                    <span><button type="button" id="plupload-english_cover" class="btn btn-danger plupload" data-input-id="c-english_cover" data-mimetype="image/gif,image/jpeg,image/png,image/jpg,image/bmp" data-multiple="false" data-preview-id="p-english_cover"><i class="fa fa-upload"></i> <?php echo __('Upload'); ?></button></span>
                    <span><button type="button" id="fachoose-english_cover" class="btn btn-primary fachoose" data-input-id="c-english_cover" data-mimetype="image/*" data-multiple="false"><i class="fa fa-list"></i> <?php echo __('Choose'); ?></button></span>
                </div>
                <span class="msg-box n-right" for="c-english_cover"></span>
            </div>
            <ul class="row list-inline plupload-preview" id="p-english_cover"></ul>
        </div>
    </div>
    <div class="form-group">
        <label for="c-sort" class="control-label col-xs-12 col-sm-2"><?php echo __('Sort'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <input placeholder="升序排序~" id="c-sort" data-rule="required" class="form-control" name="row[sort]" type="number" value="">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-12 col-sm-2"><?php echo __('IsShow'); ?>:</label>
        <div class="col-xs-12 col-sm-8">
            <?php echo build_radios('row[is_show]', ['0'=>__('False'), '1'=>__('True')]); ?>
        </div>
    </div>
    
    <div class="form-group layer-footer">
        <label class="control-label col-xs-12 col-sm-2"></label>
        <div class="col-xs-12 col-sm-8">
            <button type="submit" class="btn btn-success btn-embossed disabled"><?php echo __('OK'); ?></button>
            <button type="reset" class="btn btn-default btn-embossed"><?php echo __('Reset'); ?></button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="/assets/js/require<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js" data-main="/assets/js/require-backend<?php echo \think\Config::get('app_debug')?'':'.min'; ?>.js?v=<?php echo htmlentities($site['version']); ?>"></script>
    </body>
</html>