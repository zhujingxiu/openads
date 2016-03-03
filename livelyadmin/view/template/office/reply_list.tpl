<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right"><a href="<?php echo $add; ?>" data-toggle="tooltip" title="<?php echo $button_add; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
        <button type="button" data-toggle="tooltip" title="<?php echo $button_delete; ?>" class="btn btn-danger" onclick="confirm('<?php echo $text_confirm; ?>') ? $('#form-country').submit() : false;"><i class="fa fa-trash-o"></i></button>
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
        <form action="<?php echo $delete; ?>" method="post" enctype="multipart/form-data" id="form-country">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td style="width: 1px;" class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked', this.checked);" /></td>
                  <td class="text-center"><?php if ($sort == 'o_r.date') { ?>
                    <a href="<?php echo $sort_date; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date; ?>"><?php echo $column_date; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'o_r.time') { ?>
                    <a href="<?php echo $sort_time; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_time; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_time; ?>"><?php echo $column_time; ?></a>
                    <?php } ?></td>
                  <td class="text-center"><?php if ($sort == 'o_r.office_id') { ?>
                    <a href="<?php echo $sort_user; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_user; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_user; ?>"><?php echo $column_user; ?></a>
                    <?php } ?></td>
                  <td class="text-left"><?php echo $column_content; ?></td>
                  <td class="text-center"><?php if ($sort == 'o_r.date_added') { ?>
                    <a href="<?php echo $sort_date_added; ?>" class="<?php echo strtolower($order); ?>"><?php echo $column_date_added; ?></a>
                    <?php } else { ?>
                    <a href="<?php echo $sort_date_added; ?>"><?php echo $column_date_added; ?></a>
                    <?php } ?></td>
                  <td class="text-right"><?php echo $column_action; ?></td>
                </tr>
              </thead>
              <tbody>
                <?php if ($replies) { ?>
                <?php foreach ($replies as $item) { ?>
                <tr>
                  <td class="text-center"><?php if (in_array($item['reply_id'], $selected)) { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $item['reply_id']; ?>" checked="checked" />
                    <?php } else { ?>
                    <input type="checkbox" name="selected[]" value="<?php echo $item['reply_id']; ?>" />
                    <?php } ?></td>
                  <td class="text-center"><?php echo $item['date']; ?></td>
                  <td class="text-center"><?php echo $item['time']; ?></td>
                  <td class="text-center"><?php echo $item['user']; ?></td>
                  <td class="text-left"><pre><?php echo $item['work_content']; ?></pre></td>
                  <td class="text-center"><?php echo $item['date_added']; ?></td>
                  <td class="text-right">
                    <a href="<?php echo $item['edit']; ?>" data-toggle="tooltip" title="<?php echo $button_edit; ?>" class="btn btn-primary"><i class="fa fa-pencil"></i></a>
                  </td>
                </tr>
                <?php } ?>
                <?php } else { ?>
                <tr>
                  <td class="text-center" colspan="8"><?php echo $text_no_results; ?></td>
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
<?php echo $footer; ?>