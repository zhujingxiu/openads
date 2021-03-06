<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="javascript:history.go(-1);" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-primary"><i class="fa fa-reply"></i></a>
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
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <?php if ($success) { ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
        <?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row filter">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-ad-sn"><?php echo $entry_ad_sn; ?></label>
                                <input type="text" name="filter_ad_sn" value="<?php echo $filter_ad_sn; ?>" placeholder="<?php echo $entry_ad_sn; ?>" id="input-ad-sn" class="form-control" />
                            </div>

                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-customer"><?php echo $entry_customer; ?></label>
                                <input type="text" name="filter_customer" value="<?php echo $filter_customer; ?>" placeholder="<?php echo $entry_customer; ?>" id="input-customer" class="form-control" />
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

                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-added-start"><?php echo $entry_added_start; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_added_start" value="<?php echo $filter_added_start; ?>" placeholder="<?php echo $entry_added_start; ?>" data-date-format="YYYY-MM-DD" id="input-added-start" class="form-control" />
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label class="control-label" for="input-added-end"><?php echo $entry_added_end; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_added_end" value="<?php echo $filter_added_end; ?>" placeholder="<?php echo $entry_added_end; ?>" data-date-format="YYYY-MM-DD" id="input-added-end" class="form-control" />
                                    <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <br>
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                            <br>
                            <br>
                            <button type="button" id="bulk-button" class="btn btn-info pull-right" style="display:none;"><i class="fa fa-sliders"></i> <?php echo $button_approve; ?></button>
                        </div>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" target="_blank" id="form-order">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                    <td class="text-center"><?php if ($sort == 'ald.advertise_id') { ?>
                                        <a href="<?php echo $sort_ad; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_ad_id; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_ad; ?>"><?php echo $column_ad_id; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'a.website_id') { ?>
                                        <a href="<?php echo $sort_website; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_website; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_website; ?>"><?php echo $column_website; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'customer') { ?>
                                        <a href="<?php echo $sort_customer; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_customer; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_customer; ?>"><?php echo $column_customer; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'ald.from_priority') { ?>
                                        <a href="<?php echo $sort_from; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_from; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_from; ?>"><?php echo $column_from; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'ald.to_priority') { ?>
                                        <a href="<?php echo $sort_to; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_to; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_to; ?>"><?php echo $column_to; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center"><?php if ($sort == 'ald.in_charge') { ?>
                                        <a href="<?php echo $sort_in_charge; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_in_charge; ?>"><?php echo $column_in_charge; ?></a>
                                        <?php } ?>
                                    </td>

                                    <td class="text-center"><?php if ($sort == 'a.date_added') { ?>
                                        <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-right"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($advertises) { ?>
                                <?php foreach ($advertises as $item) { ?>
                                <tr <?php echo (!$item['status']) ? 'class="line_locked"' : ''?>>
                                  <td class="text-center"><?php if (in_array($item['advertise_id'], $selected)) { ?>
                                      <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_id']; ?>" checked="checked" />
                                      <?php } else { ?>
                                      <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_id']; ?>" />
                                      <?php } ?>
                                  </td>
                                  <td class="text-center"><?php echo $item['advertise_id']; ?></td>
                                  <td class="text-center" style="width:16%;word-break:break-all;">
                                    <a target="_blank" href="<?php echo $item['domain'] ?>"  ><?php echo $item['domain']; ?></a>
                                    <?php if(!$item['status']){ ?>
                                    <br>
                                    <?php echo $item['status_text'] ?> 
                                    <?php }?>
                                </td>

                                  <td class="text-center">
                                    <span data-toggle="tooltip" title="<?php echo $item['company'] ?>"><?php echo lively_truncate($item['company']); ?>
                                    <br>
                                    <i><?php echo $item['customer'] ?></i>
                                  </td>
                                  
                                  <td class="text-center"><?php echo $item['from_name']; ?></td>
                                  <td class="text-center"><?php echo $item['to_name']; ?></td>
                                  <td class="text-center"><?php echo $item['charger']; ?></td>
                                  <td class="text-center"><?php echo $item['date_added']; ?></td>
                                  <td class="text-right">
                                      <a href="javascript:;" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-default level-down" data-entry="<?php echo $item['advertise_id'] ?>"><i class="fa fa-eye"></i></a> 
                                  </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="text-center" colspan="9"><?php echo $text_no_results; ?></td>
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
<div id="level-down-dialog" style="display:none;">
    <form class="">
        <div class="col-sm-12">
            <div id="balance-history"></div>
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="form-group clearfix">
                <label class="control-label col-sm-2"><?php echo $entry_from ?></label>
                <div class="col-sm-10">
                    <span class="form-control" id="text-from-priority">
                        
                    </span>
                </div>
            </div>
            <div class="form-group clearfix">
                <label class="control-label col-sm-2"><?php echo $entry_to ?></label>
                <div class="col-sm-10">
                    <span class="form-control" id="text-to-priority"></span>
                </div>
            </div>
            <hr>
        </div>
        <div class="col-sm-12">
            <div class="form-group clearfix">
                <label class="control-label col-sm-2"><?php echo $entry_notify ?></label>
                <div class="col-sm-10">
                    <textarea id="message" name="message" class="form-control"></textarea>
                </div>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript"><!--
var entry = 0;
$('.level-down').bind('click',function(){
    entry = $(this).attr('data-entry');
    $.ajax({
        url:'index.php?route=service/queue/ajax_data&token=<?php echo $token ?>',
        data:{action:'get_demotion',advertise_id:entry},
        dataType:'json',
        success:function(json){
            if(json.status==1){
                $('#balance-history').load('index.php?route=service/advertise/balance&advertise_id='+entry+'&token=<?php echo $token ?>');
                $('#text-from-priority').html(json.data.from_name+' &nbsp; Current Number: #'+json.data.number+' &nbsp; Total Ads:'+json.data.from_list);
                $('#text-to-priority').html(json.data.to_name+' &nbsp; Total Ads:'+json.data.to_list);
                $('#level-down-dialog').dialog('option',{ 'title':'AD '+entry+' Demotion'});
                $('#level-down-dialog').dialog('open');
            }
        }
    })
});
$('#level-down-dialog').dialog({
    title:'AD Demotion',
    width:800,
    autoOpen:false,
    modal:true,
    buttons:{
        '<?php echo $button_pass ?>':function(){
            if(confirm('<?php echo $confirm_pass_demotion ?>')){
                var message = $('#level-down-dialog textarea[name="message"]').val();
                $.ajax({
                    url:'index.php?route=service/queue/ajax_data&token=<?php echo $token ?>',
                    data:{action:'do_demotion',advertise_id:entry,approve:1,message:message},
                    type:'post',
                    dataType:'json',
                    success:function(json){
                        if(json.status==0){
                            alert(json.msg)
                        }else{
                            location.reload();
                        }
                    }
                })
            }
        },
        '<?php echo $button_cancel ?>':function(){
            if(confirm('<?php echo $confirm_cancel_demotion ?>')){
                var message = $('#level-down-dialog textarea[name="message"]').val();
                $.ajax({
                    url:'index.php?route=service/queue/ajax_data&token=<?php echo $token ?>',
                    data:{action:'do_demotion',advertise_id:entry,approve:0,message:message},
                    type:'post',
                    dataType:'json',
                    success:function(json){
                        if(json.status==0){
                            alert(json.msg)
                        }else{
                            location.reload();
                        }
                    }
                })
            }
        },
        '<?php echo $button_close ?>':function(){
            $(this).dialog('close');
        }
    }
})
$('#balance-history').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();
    $('#balance-history').load(this.href);
});

$('#button-filter').on('click', function() {
    url = 'index.php?route=service/queue/demotion&token=<?php echo $token; ?>';
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

$('input[name=\'filter_customer\']').autocomplete({
    'source': function(request, response) {
        $.ajax({
            url: 'index.php?route=customer/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request),
            dataType: 'json',           
            success: function(json) {
                response($.map(json, function(item) {
                    return {
                        label: item['name'],
                        value: item['customer_id']
                    }
                }));
            }
        });
    },
    'select': function(item) {
        $('input[name=\'filter_customer\']').val(item['label']);}
});

$('input[name^=\'selected\']:first').trigger('change');

$('a[id^=\'button-delete\']').on('click', function(e) {
    e.preventDefault();
    if (confirm('<?php echo $text_confirm; ?>')) {location = $(this).attr('href');}
});

$('.date').datetimepicker({ pickTime: false});

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
    _html += '      <label class="col-sm-2 control-label"><?php echo $entry_note ?></label>'
    _html += '      <div class="col-sm-10">';
    _html += '          <textarea name="_note" class="form-control"></textarea>';
    _html += '      </div>';
    _html += '  </div>';
    _html += '</form></div></div>';
    
    $('#container').append(_html);
    $('#component-bulk').dialog({
        autoOpen:true,
        title:'Bulk Edit [ '+_selected.join()+' ]',
        modal: true,
        width: 600,
        resizable:false,
        buttons:{
            'Save':function(){
                if(confirm('Approve ?')){
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