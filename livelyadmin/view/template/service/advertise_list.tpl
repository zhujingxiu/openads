<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right" style="display:none;">
                <a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) { ?>
                <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container-fluid">
        <?php if ($error_warning) { ?>
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
                <div class="pull-right">
                    <a class="btn btn-info btn-link" onclick="$('#filter-columns').slideToggle();">
                        <?php echo $text_filter_toggle;?>
                    </a>
                </div>
            </div>
            <div class="panel-body">
                <div class="well" id="filter-columns" style="display: none;">
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-ad-sn"><?php echo $entry_ad_sn; ?></label>
                                <input type="text" name="filter_ad_sn" value="<?php echo $filter_ad_sn; ?>" placeholder="<?php echo $entry_ad_sn; ?>" id="input-ad-sn" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-targeting"><?php echo $entry_targeting; ?></label>
                                <select name="filter_targeting" id="input-targeting" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($targeting_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_targeting) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>">
                                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_product; ?></label>
                                <select name="filter_product" id="input-product" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($products as $item) { ?>
                                    <?php if ($item['product_id'] == $filter_product) { ?>
                                    <option value="<?php echo $item['product_id']; ?>" selected="selected"><?php echo $item['code'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['product_id']; ?>"><?php echo $item['code'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-post"><?php echo $entry_post; ?></label>
                                <select name="filter_post" id="input-post" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($post_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_post) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>">
                                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
                                <input name="filter_customer_id" type="hidden" value="<?php echo $filter_customer_id?>">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-photo"><?php echo $entry_photo; ?></label>
                                <select name="filter_photo" id="input-photo" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($photo_statuses as $item) { ?>
                                    <?php if ($item['status_id'] == $filter_photo) { ?>
                                    <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['status_id']; ?>">
                                    <?php echo $item['status_id'].' '.$item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-in-charge"><?php echo $entry_in_charge; ?></label>
                                <select name="filter_in_charge" id="input-in-charge" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($managers as $item) { ?>
                                    <?php if ($item['user_id'] == $filter_in_charge) { ?>
                                    <option value="<?php echo $item['user_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                                    <?php } else { ?>
                                    <option value="<?php echo $item['user_id']; ?>"><?php echo $item['name']; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-publish"><?php echo $entry_publish; ?></label>
                                <select name="filter_publish" id="input-publish" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($ad_publishes as $item) { ?>
                                    <?php if ($item['publish_id'] < $confirmed) { ?>
                                    <option value="<?php echo $item['publish_id']; ?>"
                                        <?php echo ($item['publish_id'] == $filter_publish) ? 'selected' : '' ?> >
                                        <?php echo $item['publish_id'].' '.$item['name']; ?>
                                    </option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-modified-start"><?php echo $entry_date_modified; ?></label>
                                <div class="input-group">
                                    <input type="text" name="filter_modified_start" value="<?php echo $filter_modified_start; ?>" placeholder="<?php echo $entry_modified_start; ?>" data-date-format="YYYY-MM-DD" class="date form-control" />
                                    <div class="input-group-addon"><i class="fa fa-arrows-h"></i> </div>
                                    <input type="text" name="filter_modified_end" value="<?php echo $filter_modified_end; ?>" placeholder="<?php echo $entry_modified_end; ?>" data-date-format="YYYY-MM-DD" class="form-control date" />
                                </div>
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                            <br>
                            <br>
                            <button type="button" id="bulk-button" class="btn btn-info pull-right" style="display:none;"><i class="fa fa-sliders"></i> <?php echo $button_approve; ?></button>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-center"><?php if ($sort == 'a.date_modified') { ?>
                                        <a href="<?php echo $sort_date_modified; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_date_modified; ?>"><?php echo $column_date_modified; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.advertise_sn') { ?>
                                        <a href="<?php echo $sort_ad; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ad_sn; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_ad; ?>"><?php echo $column_ad_sn; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'a.product_id') { ?>
                                        <a href="<?php echo $sort_product; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_product; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_product; ?>"><?php echo $column_product; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'a.in_charge') { ?>
                                        <a href="<?php echo $sort_in_charge; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_in_charge; ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.publish') { ?>
                                        <a href="<?php echo $sort_publish; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_publish; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_publish; ?>"><?php echo $column_publish; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.targeting') { ?>
                                        <a href="<?php echo $sort_targeting; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_targeting; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_targeting; ?>"><?php echo $column_targeting; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.post') { ?>
                                        <a href="<?php echo $sort_post; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_post; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_post; ?>"><?php echo $column_post; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.photo') { ?>
                                        <a href="<?php echo $sort_photo; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_photo; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_photo; ?>"><?php echo $column_photo; ?></a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($advertises) { ?>
                                <?php foreach ($advertises as $item) { ?>
                                <tr <?php echo (!$item['status']) ? 'class="line_locked"' : ''?>>
                                    <td class="text-center">
                                    <?php if (in_array($item['advertise_id'], $selected)) { ?>
                                        <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_id']; ?>" checked="checked" />
                                    <?php } else { ?>
                                        <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_id']; ?>" />
                                    <?php } ?>
                                    </td>
                                    <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                    <td class="text-center"><?php echo $item['advertise_sn']; ?></td>
                                    <td class="text-center"><?php echo $item['product']; ?></td>
                                    <td class="text-center"><?php echo $item['charger']; ?></td>
                                    <td class="text-center">
                                        <a class="btn btn-default" onclick="history(<?php echo $item['advertise_id']?>);">
                                            <?php echo $item['publish_text']; ?>
                                        </a>
                                        <a data-advertise="<?php echo $item['advertise_id']; ?>" data-toggle="tooltip" title="<?php echo $button_preview; ?>" class="btn btn-default advertise-preview" >
                                            <i class="glyphicon glyphicon-expand"></i>
                                        </a>
                                    </td>
                                    <td class="text-center"><?php echo $item['targeting']; ?></td>
                                    <td class="text-center"><?php echo $item['post']; ?></td>
                                    <td class="text-center"><?php echo $item['photo']; ?></td>

                                </tr>

                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="12"><?php echo $text_no_results; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </form>
                <div class="row">
                    <div class="col-sm-6 text-left"><?php echo $pagination; ?></div>
                    <div class="col-sm-6 text-right"><?php echo $results; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Advertise Preview -->
<div id="preview-dialog" style="display:none;" >
    <div class="thumbnail">
        <p class="text-muted" style="color: black" id="advertise_text"></p>
        <p> <img class="img-rounded" id="advertise-photo"/></p>
        <p class="text-muted" style="color: black;font-size:28px" id="advertise_headline"></p>
    </div>
</div>
<script type="text/javascript"><!--

$('.advertise-preview').bind('click',function(){

  $.get('index.php?route=service/advertise/get_preview&token=<?php echo $token ?>',{advertise_id:$(this).attr('data-advertise')},function(data){

    if(data.status==0){
      alert(data.msg);
    }else{

      $('#advertise_text').html(data.data.text);
      $('#advertise-photo').attr('src',data.data.image);
      $('#advertise_headline').html(data.data.headline);
      $('#preview-dialog').dialog('open')
      .dialog('option',{title:data.data.advertise_id+' [ '+data.data.facebook_ad+' ]'});
      $('.loading').remove();

    }
  },'json')
});
$('#preview-dialog').dialog({
    width: 510,
    autoOpen:false,
    resizable:false,

});

function tracking(ad){
    $('#component-detail').remove();
    $('#container').append('<div id="component-detail"></div>');
    $('#component-detail')
        .load('index.php?route=service/advertise/tracking&token=<?php echo $token ?>&advertise_id='+ad)
        .dialog({
            autoOpen:true,
            width: 680,
            height:500,
            resizable:false
        });
}
function history(ad){
    $('#component-detail').remove();
    $('#container').append('<div id="component-detail" ></div>');
    $('#component-detail')
        .load('index.php?route=service/advertise/detail&token=<?php echo $token ?>&advertise_id='+ad)
        .dialog({
            autoOpen:true,
            width: 680,
            resizable:false
        });
}

function detail(ad_id,mode){
    $('#component-detail').remove();
    $('#container').append('<div id="component-detail"></div>');
    $('#component-detail')
        .load('index.php?route=service/advertise/component&token=<?php echo $token ?>',{mode:mode,advertise_id:ad_id})
        .dialog({
            autoOpen:true,
            width: 680,
            resizable:false
        });
}

$('#button-filter').on('click', function() {
	url = 'index.php?route=service/advertise&token=<?php echo $token; ?>';
	 var paramArr=[];
    $(".filter input[name],.filter select[name]").each(function(){
        if($(this).val() && $(this).val()!='*'){
            paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
        }
    });
    if(paramArr.length>0){
        url+="&"+paramArr.join("&");
    }
	location = url;
});

$('#input-customer').autocomplete({
    'delay':500,
    'source': function(request, response) {
        $.ajax({
            url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
            dataType: 'json',
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['username']+' '+item['name'],
                        value: item['customer_id']
                    }
                }));
            }
        });
    },
    'select': function(event,ui) {
        $('#input-customer').val(ui.item['label']);
        $('input[name="filter_customer_id"]').val(ui.item['value']);
        return false;
    },
    focus: function(event, ui) {
        return false;
    }
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
  	e.preventDefault();
	if (confirm('<?php echo $text_confirm; ?>')) {location = $(this).attr('href');}
});

$('.date').datetimepicker({	pickTime: false});

$('input:checkbox').click(function(){
    var length = 0;
    $('input:checkbox[name^="selected"]').each(function(){
        if($(this).is(':checked')){
            length++;
        }
    });
    $('#bulk-button').toggle(length>1);
});
 $('#bulk-button').bind('click',function(){
    var _selected = [];
    $('input:checkbox[name^="selected"]').each(function(){
        if($(this).is(':checked')){
            _selected.push($(this).val());
        }
    });
    $('#component-bulk').remove();
    var _html  = '<div id="component-bulk"><div class="col-sm-12">';
    _html += '<form id="bulk-approve" class="form-horizontal" method="post">';
    _html += '  <input type="hidden" name="action" value="bulk">';
    _html += '  <input type="hidden" name="_selected" value="'+_selected.join()+'">';
    _html += '  <div class="form-group">';
    _html += '      <label class="col-sm-2 control-label"><?php echo $entry_publish ?></label>'
    _html += '      <div class="col-sm-10">';
    _html += '          <select name="_publish" class="form-control">';
                        <?php foreach ($ad_publishes as $item) { ?>
    _html += '  <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>';
                        <?php } ?>
    _html += '          </select>';
    _html += '      </div>';
    _html += '  </div>';
    _html += '  <div class="form-group">';
    _html += '      <label class="col-sm-2 control-label"><?php echo $entry_note ?></label>'
    _html += '      <div class="col-sm-10">';
    _html += '          <textarea name="_note" class="form-control"></textarea>';
    _html += '      </div>';
    _html += '  </div>';
    _html += '</form></div></div>';

    $('#container').append(_html);
    $('#component-bulk').dialog({
        autoOpen:true,
        title:'<?php echo $text_confirm_bulk ?> [ '+_selected.join()+' ]',
        modal: true,
        width: 600,
        resizable:false,
        buttons:{
            'Save':function(){
                if(confirm('<?php echo $text_confirm_approve ?>')){
                    _component.update(
                        '<?php echo $mode_action ?>',
                        $('#bulk-approve').serialize()
                    );
                }
            }
        }
    });

 })
//--></script>

<?php echo $footer; ?>