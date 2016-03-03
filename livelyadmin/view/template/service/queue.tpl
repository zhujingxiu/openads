<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <a href="<?php echo $demotion ?>" data-toggle="tooltip" title="<?php echo $button_demotion; ?>" class="btn btn-info"><i class="fa fa-level-down"></i> <?php echo $button_demotion ?></a>
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
        <div class="panel panel-default list">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-list"></i> <?php echo $text_list; ?></h3>
            </div>
            <div class="panel-body">
                <form method="post" enctype="multipart/form-data" id="form-order">
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs" id="ad">
                                <?php foreach ($queue as $key => $item): ?>
                                <li <?php echo ($priority_id == $item['priority_id']) ? 'class="active bg-primary"' : '' ?> >
                                    <a href="<?php echo $item['link'] ;?>">
                                        <?php echo $item['name']; ?> 
                                        (<?php echo $item['quantity'] ?>)
                                    </a>
                                </li>    
                                <?php endforeach ?>
                            </ul>
                            <div class="tab-content">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                                            <td class="text-center"><?php echo $column_number; ?>
                                            </td>
                                            <td class="text-center"><?php echo $column_ad_sn; ?>
                                            </td>
                                            <td class="text-center"><?php echo $column_product; ?>
                                            </td>
                                            <td class="text-center"><?php echo $column_website; ?>
                                            </td>
                                            <td class="text-center"><?php echo $column_customer; ?>
                                            </td>
                                            <td class="text-center"><?php echo $column_in_charge; ?>
                                            </td>

                                            <td class="text-center"><?php echo $column_date_modified; ?>
                                            </td>
                                            <td class="text-right">
                                                <?php echo $column_action; ?> 
                                                &nbsp; &nbsp; 
                                                <button type="button" id="button-push" class="btn btn-success pull-right btn-sm"><i class="fa fa-arrow-right"></i> <?php echo $text_push_selected; ?></button>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if ($advertises) { ?>
                                        <?php foreach ($advertises as $key => $item) { ?>
                                        <tr>
                                            <td class="text-center"><?php if (in_array($item['advertise_id'], $selected)) { ?>
                                              <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_sn']; ?>" checked="checked" data-entry="<?php echo $item['advertise_id'] ?>"/>
                                              <?php } else { ?>
                                              <input type="checkbox" name="selected[]" value="<?php echo $item['advertise_sn']; ?>" data-entry="<?php echo $item['advertise_id'] ?>"/>
                                              <?php } ?>
                                            </td>
                                            <td class="text-center"><?php echo $key+1; ?></td>
                                            <td class="text-center"><?php echo $item['advertise_sn']; ?></td>
                                            <td class="text-center"><?php echo $item['product']; ?></td>
                                            <td class="text-center" style="width:16%;word-break:break-all;">
                                            <a target="_blank" href="<?php echo $item[
                                            'website'] ?>"  >
                                                <?php echo $item['website']; ?>
                                            </a>
                                            </td>
                                            <td class="text-center">
                                            <span data-toggle="tooltip" title="<?php echo $item['company'] ?>"><?php echo lively_truncate($item['company']); ?>
                                            <br>
                                            <i><?php echo $item['customer'] ?></i>
                                            </td>

                                            <td class="text-center"><?php echo $item['charger']; ?></td>
                                            <td class="text-center"><?php echo $item['date_modified']; ?></td>
                                            <td class="text-right">
                                            <?php if($item['msg']){ ?>
                                                <span class="label label-danger pull-left"><?php echo $item['msg'] ?></span>
                                            <?php }?>
                                            <?php if($item['demotion']){ ?>
                                            <a href="javascript:;" class="btn btn-info level-down" data-entry="<?php echo $item['advertise_id'] ?>"><i class="fa fa-level-down"></i> <?php echo $list_demotion ?></a>
                                            <?php }else{ ?>
                                                <a href="javascript:push_designing(<?php echo $item['advertise_id'] ?>)" data-toggle="tooltip" title="<?php echo $button_designing; ?>" class="btn btn-default">
                                                    <i class="fa fa-arrow-right"></i>
                                                    <?php echo $button_designing; ?>
                                                </a>
                                            <?php }?>
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
                        </div>
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
                $('#level-down-dialog').dialog('option',{
                    'title':'AD '+entry+' Level Down'}
                ).dialog('open');
            }
        }
    })
});
$('#level-down-dialog').dialog({
    title:'AD Level Down',
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
        'Close':function(){
            $(this).dialog('close');
        }
    }
})
$('#balance-history').delegate('.pagination a', 'click', function(e) {
    e.preventDefault();
    $('#balance-history').load(this.href);
});

function push_designing(ad){
    
        $.ajax({
            url: 'index.php?route=service/advertise/history&token=<?php echo $token; ?>&advertise_id='+ad,
            type: 'post',
            dataType: 'json',
            data: 'publish=<?php echo $publish_indesign ?>&notify=1&note=',
            success: function(json) {
                $('.alert').remove();
                if (json['error']) {
                    $('.list').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                } 
                if (json['success']) {
                    
                    location.reload();
                }     
                return false;
            },      
            error: function(xhr, ajaxOptions, thrownError) {
              alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
   
}
$('#button-push').bind('click',function(){
    var selected = [];
    $.each($('input[name="selected[]"]:checked'),function(){
        selected.push($(this).attr('data-entry'));
    })
    if(selected.length){
        
            $.ajax({
                url: 'index.php?route=service/advertise/history&token=<?php echo $token; ?>',
                type: 'post',
                dataType: 'json',
                data: 'publish=<?php echo $publish_designing ?>&notify=1&ads='+selected.join(),
                success: function(json) {
                    $('.alert').remove();
                    if (json['error']) {
                        $('.list').before('<div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> ' + json['error'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                    } 
                    if (json['success']) {
                        
                        location.reload();
                    }     
                    return false;
                },      
                error: function(xhr, ajaxOptions, thrownError) {
                  alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
       
    }else{
        alert('<?php echo $text_atleast_one?>');
    }
});
$('#button-filter').on('click', function() {
    url = 'index.php?route=service/queue&token=<?php echo $token; ?>';
     var paramArr=[];
    $(".filter input[name],.filter select[name]").each(function(){
        if($(this).val() && $(this).val()!='*'){
            paramArr.push($(this).attr("name")+"="+encodeURIComponent($(this).val()))
        }
    });
    paramArr.push('priority_id=<?php echo $priority_id ?>');
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
//--></script>

<?php echo $footer; ?>