<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
    <div class="page-header">
        <div class="container-fluid">

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
            </div>
            <div class="panel-body">
                <div class="well">
                    <div class="row filter">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-log_time_start"><?php echo $entry_log_time_start; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_log_time_start" value="<?php echo $filter_log_time_start; ?>" placeholder="<?php echo $entry_log_time_start; ?>" id="input-log_time_start" class="form-control" data-date-format="YYYY-MM-DD"/>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-log_time_end"><?php echo $entry_log_time_end; ?></label>
                                <div class="input-group date">
                                    <input type="text" name="filter_log_time_end" value="<?php echo $filter_log_time_end; ?>" placeholder="<?php echo $entry_log_time_end; ?>" id="input-log_time_end" class="form-control" data-date-format="YYYY-MM-DD"/>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-user"><?php echo $entry_user; ?></label>
                                <select name="filter_user_id" id="input-user" class="form-control">
                                    <option value="*"></option>
                                    <?php foreach ($users as $uid => $user) { ?>
                                    <?php if ($uid == $filter_user_id) { ?>
                                    <option value="<?php echo $uid; ?>" selected="selected"><?php echo $user; ?></option>
                                      <?php } else { ?>
                                    <option value="<?php echo $uid; ?>"><?php echo $user; ?></option>
                                    <?php } ?>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-action"><?php echo $entry_action; ?></label>
                                <input type="text" name="filter_action" value="<?php echo $filter_action; ?>" placeholder="<?php echo $entry_action; ?>" id="input-action" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="control-label" for="input-url"><?php echo $entry_url; ?></label>
                                <input type="text" name="filter_url" value="<?php echo $filter_url; ?>" placeholder="<?php echo $entry_url; ?>" id="input-url" class="form-control" />
                            </div>
                            <button type="button" id="button-filter" class="btn btn-primary pull-left"><i class="fa fa-refresh"></i> <?php echo $button_reset; ?></button>
                            
                            <button type="button" id="button-filter" class="btn btn-primary pull-right"><i class="fa fa-search"></i> <?php echo $button_filter; ?></button>
                        </div>

                    </div>
                </div>
                <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <td width="1" style="text-align: center;"><input type="checkbox" onclick="$('input[name*=\'selected\']').attr('checked', this.checked);" /></td>
                                    <td class="text-left"><?php if ($sort == 'username') { ?>
                                        <a href="<?php echo $sort_username; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user_name; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_username; ?>"><?php echo $column_user_name; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php if ($sort == 'action') { ?>
                                        <a href="<?php echo $sort_action; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_action; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_action; ?>"><?php echo $column_log_action; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php if ($sort == 'url') { ?>
                                        <a href="<?php echo $sort_url; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_url; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_url; ?>"><?php echo $column_log_url; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="text-left"><?php echo $column_log_data ?></td>
                                    <td class="text-left"><?php if ($sort == 'log_time') { ?>
                                        <a href="<?php echo $sort_log_time; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_log_time; ?></a>
                                        <?php } else { ?>
                                        <a href="<?php echo $sort_log_time; ?>"><?php echo $column_log_time; ?></a>
                                        <?php } ?>
                                    </td>
                                    <td class="right"><?php echo $column_action; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  if ($user_logs) { ?>
                                <?php foreach ($user_logs as $log) { ?>
                                <tr>
                                    <td style="text-align: center;">
                                        <input type="checkbox" name="selected[]" value="<?php echo $log['user_log_id']; ?>" <?php echo ($log['selected']) ? 'checked="checked"' :'' ?>/>
                                    </td>
                                    <td class="text-left"><?php echo $log['username']; ?></td>
                                    <td class="text-left"><?php echo $log['logaction']; ?></td>
                                    <td class="text-left"><?php echo $log['url']; ?></td>
                                    <td class="text-left"><?php echo lively_truncate(strip_tags($log['data']),120); ?></td>
                                    <td class="text-left"><?php echo $log['log_time']; ?></td>
                                    <td class="right"><?php foreach ($log['action'] as $action) { ?>
                                        [ <a href="<?php echo $action['href']; ?>"><?php echo $action['text']; ?></a> ]
                                      <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                                <?php } else { ?>
                                <tr>
                                    <td class="center" colspan="7"><?php echo $text_no_results; ?></td>
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
<div class="modal fade" id="export-dialog" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="menuLabel">Export Logs</h4>
            </div>
            <div class="modal-body">
                <form action="<?php echo $export ?>" method="post" >
                  	<div class="form-group">
                    	<label for="operator" class="control-label col-sm-3">Operator:</label>
                        <div class="input-group col-sm-6">
                          	<select name="operator" id="operator" class="form-control">
              					<option value="0"> -- All -- </option>
              				    <?php foreach ($all_users as $user){?>
              					<option value="<?php echo $user['user_id']?>"><?php echo $user['username'].' '.$user['lastname'].$user['firstname'];?></option>
              				    <?php }	?>
              				</select>
                        </div>
                    </div>
                    <div class="form-group">
                      	<label for="date-start" class="control-label col-sm-3">Date Start:</label>
                      	<div class="input-group date col-sm-6">
                            <input type="text" name="date_start" id="date-start" class="form-control" data-date-format="YYYY-MM-DD"/>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span>
                    	</div>
                    </div>
                    <div class="form-group">
                      	<label for="date-end" class="control-label col-sm-3">Date End:</label>
                      	<div class="input-group date col-sm-6">
                            <input type="text" name="date_end" id="date-end" value="<?php echo date('Y-m-d H:i')?>" class="form-control" data-date-format="YYYY-MM-DD"/>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-action="export">Export</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript"><!--
$('#export-button').bind('click',function(){$('#export-dialog').modal('show');});
$('button[data-action="export"]').click(function(){ $('#export-dialog form').submit();});
function truncate_logs(){
	if (confirm('Logging data will not resume! Are you sure you want to do this?')) {
    	$.ajax({
            url:'index.php?route=user/user_log/truncate&token=<?php echo $token; ?>',
            type:'get',
            dataType:'json',
            success:function(data){
      			$('.msg').remove();
      			if(data.warning){
      				$('.breadcrumb').after('<div class="warning msg">'+data.warning+'</div>');
      			}else{		
      				$('.breadcrumb').after('<div class="success msg">'+data.success+'</div>');
      				location.reload();
      			}
        	}
        });
    }
}
$('#button-filter').on('click', function() {
	url = 'index.php?route=user/user_log&token=<?php echo $token; ?>';
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
$('.date').datetimepicker({
    pickTime: false
});
//--></script>

<?php echo $footer; ?> 