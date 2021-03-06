<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-advertise" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="hidden btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <div class="do-result">
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
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>
      </div>
      <div class="panel-body">
        <form  method="post"  id="form-advertise" class="form-horizontal">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
            <li><a href="#tab-targeting" data-toggle="tab"><?php echo $tab_targeting; ?></a></li>
            <li><a href="#tab-post" data-toggle="tab"><?php echo $tab_post; ?></a></li>
            <li><a href="#tab-photo" data-toggle="tab"><?php echo $tab_photo; ?></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab-general">

              <fieldset>
                <legend><?php echo $text_publish; ?></legend>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-indesign"><span data-toggle="tooltip" title="<?php echo $help_publish_indesign; ?>"><?php echo $entry_publish_indesign; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_indesign" id="input-publish-indesign" class="form-control">
                      <option value="0"><?php echo $text_none; ?></option>
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_indesign) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-waiting"><span data-toggle="tooltip" title="<?php echo $help_publish_waiting; ?>"><?php echo $entry_publish_waiting; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_waiting" id="input-publish-waiting" class="form-control">
                      <option value="0"><?php echo $text_none; ?></option>
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_waiting) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-confirmed"><span data-toggle="tooltip" title="<?php echo $help_publish_confirmed; ?>"><?php echo $entry_publish_confirmed; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_confirmed" id="input-publish-confirmed" class="form-control">
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_confirmed) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-opening"><span data-toggle="tooltip" title="<?php echo $help_publish_opening; ?>"><?php echo $entry_publish_opening; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_opening" id="input-publish-opening" class="form-control">
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_opening) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-success"><span data-toggle="tooltip" title="<?php echo $help_publish_success; ?>"><?php echo $entry_publish_success; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_success" id="input-publish-success" class="form-control">
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_success) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-deliveried"><span data-toggle="tooltip" title="<?php echo $help_publish_deliveried; ?>"><?php echo $entry_publish_deliveried; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_deliveried" id="input-publish-deliveried" class="form-control">
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_deliveried) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-failed"><span data-toggle="tooltip" title="<?php echo $help_publish_failed; ?>"><?php echo $entry_publish_failed; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_failed" id="input-publish-failed" class="form-control">
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_failed) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-publish-terminal"><span data-toggle="tooltip" title="<?php echo $help_publish_terminal; ?>"><?php echo $entry_publish_terminal; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_publish_terminal" id="input-publish-terminal" class="form-control">
                      <?php foreach ($ad_publishes as $item) { ?>
                      <?php if ($item['publish_id'] == $ad_publish_terminal) { ?>
                      <option value="<?php echo $item['publish_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['publish_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </fieldset>

              <fieldset>
                <legend><?php echo $text_checkout; ?></legend>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-checkout"><span data-toggle="tooltip" title="<?php echo $help_checkout; ?>"><?php echo $entry_checkout; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_checkout_id" id="input-checkout" class="form-control">
                      <option value="0"><?php echo $text_none; ?></option>
                      <?php foreach ($informations as $information) { ?>
                      <?php if ($information['information_id'] == $ad_checkout_id) { ?>
                      <option value="<?php echo $information['information_id']; ?>" selected="selected"><?php echo $information['title']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $information['information_id']; ?>"><?php echo $information['title']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-priority"><span data-toggle="tooltip" title="<?php //echo $help_priority; ?>"><?php echo $entry_priority; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_priority_id" id="input-priority" class="form-control">
                      <option value="0"><?php echo $text_none; ?></option>
                      <?php foreach ($priorities as $item) { ?>
                      <?php if ($item['priority_id'] == $ad_priority_id) { ?>
                      <option value="<?php echo $item['priority_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['priority_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </fieldset>
            </div>

            <div class="tab-pane" id="tab-targeting">
              <fieldset>
                <legend><?php echo $text_targeting_status ?></legend>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-targeting-pending"><span data-toggle="tooltip" title="<?php echo $help_targeting_pending; ?>"><?php echo $entry_targeting_pending; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_targeting_pending" id="input-targeting-pending" class="form-control">
                      <?php foreach ($targeting_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_targeting_pending) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-targeting-transferred"><span data-toggle="tooltip" title="<?php echo $help_targeting_transferred; ?>"><?php echo $entry_targeting_transferred; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_targeting_transferred" id="input-targeting-transferred" class="form-control">
                      <?php foreach ($targeting_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_targeting_transferred) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-targeting-review"><span data-toggle="tooltip" title="<?php echo $help_targeting_review; ?>"><?php echo $entry_targeting_review; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_targeting_review" id="input-targeting-review" class="form-control">
                      <?php foreach ($targeting_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_targeting_review) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-targeting-levels"><span data-toggle="tooltip" title="<?php echo $help_targeting_levels; ?>"><?php echo $entry_targeting_levels; ?></span></label>
                  <div class="col-sm-8">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($targeting_statuses as $item) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($item['status_id'], $ad_targeting_levels)) { ?>
                          <input type="checkbox" name="ad_targeting_levels[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                          <?php echo $item['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="ad_targeting_levels[]" value="<?php echo $item['status_id']; ?>" />
                          <?php echo $item['name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-targeting-rejected"><span data-toggle="tooltip" title="<?php echo $help_targeting_rejected; ?>"><?php echo $entry_targeting_rejected; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_targeting_rejected" id="input-targeting-rejected" class="form-control">
                      <?php foreach ($targeting_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_targeting_rejected) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </fieldset>
            </div>
            <div class="tab-pane" id="tab-post">
              <fieldset>
                <legend><?php echo $text_post_status ?></legend>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-post-pending"><span data-toggle="tooltip" title="<?php echo $help_post_pending; ?>"><?php echo $entry_post_pending; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_post_pending" id="input-post-pending" class="form-control">
                      <?php foreach ($post_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_post_pending) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-post-transferred"><span data-toggle="tooltip" title="<?php echo $help_post_transferred; ?>"><?php echo $entry_post_transferred; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_post_transferred" id="input-post-transferred" class="form-control">
                      <?php foreach ($post_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_post_transferred) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-post-robot-review"><span data-toggle="tooltip" title="<?php echo $help_post_robot_review; ?>"><?php echo $entry_post_robot_review; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_post_robot_review" id="input-post-robot-review" class="form-control">
                      <?php foreach ($post_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_post_robot_review) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-post-review"><span data-toggle="tooltip" title="<?php echo $help_post_review; ?>"><?php echo $entry_post_review; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_post_review" id="input-post-review" class="form-control">
                      <?php foreach ($post_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_post_review) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-post-levels"><span data-toggle="tooltip" title="<?php echo $help_post_levels; ?>"><?php echo $entry_post_levels; ?></span></label>
                  <div class="col-sm-8">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($post_statuses as $item) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($item['status_id'], $ad_post_levels)) { ?>
                          <input type="checkbox" name="ad_post_levels[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                          <?php echo $item['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="ad_post_levels[]" value="<?php echo $item['status_id']; ?>" />
                          <?php echo $item['name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-post-rejected"><span data-toggle="tooltip" title="<?php echo $help_post_rejected; ?>"><?php echo $entry_post_rejected; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_post_rejected" id="input-post-rejected" class="form-control">
                      <?php foreach ($post_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_post_rejected) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-similar-headline"><span data-toggle="tooltip" title="<?php echo $help_similar_headline; ?>"><?php echo $entry_similar_headline; ?></span></label>
                  <div class="col-sm-8">
                    <input type="text" name="ad_similar_headline" value="<?php echo $ad_similar_headline;?>">
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-similar-content"><span data-toggle="tooltip" title="<?php echo $help_similar_content; ?>"><?php echo $entry_similar_content; ?></span></label>
                  <div class="col-sm-8">
                     <input type="text" name="ad_similar_content" value="<?php echo $ad_similar_content;?>" >
                  </div>
                </div>                
              </fieldset>
            </div>
            <div class="tab-pane" id="tab-photo">
              <fieldset>
                <legend><?php echo $text_photo_status ?></legend>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-photo-pending"><span data-toggle="tooltip" title="<?php echo $help_photo_pending; ?>"><?php echo $entry_photo_pending; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_photo_pending" id="input-photo-pending" class="form-control">
                      <?php foreach ($photo_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_photo_pending) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-photo-transferred"><span data-toggle="tooltip" title="<?php echo $help_photo_transferred; ?>"><?php echo $entry_photo_transferred; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_photo_transferred" id="input-photo-transferred" class="form-control">
                      <?php foreach ($photo_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_photo_transferred) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-photo-review"><span data-toggle="tooltip" title="<?php echo $help_photo_review; ?>"><?php echo $entry_photo_review; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_photo_review" id="input-photo-review" class="form-control">
                      <?php foreach ($photo_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_photo_review) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-photo-levels"><span data-toggle="tooltip" title="<?php echo $help_photo_levels; ?>"><?php echo $entry_photo_levels; ?></span></label>
                  <div class="col-sm-8">
                    <div class="well well-sm" style="height: 150px; overflow: auto;">
                      <?php foreach ($photo_statuses as $item) { ?>
                      <div class="checkbox">
                        <label>
                          <?php if (in_array($item['status_id'], $ad_photo_levels)) { ?>
                          <input type="checkbox" name="ad_photo_levels[]" value="<?php echo $item['status_id']; ?>" checked="checked" />
                          <?php echo $item['name']; ?>
                          <?php } else { ?>
                          <input type="checkbox" name="ad_photo_levels[]" value="<?php echo $item['status_id']; ?>" />
                          <?php echo $item['name']; ?>
                          <?php } ?>
                        </label>
                      </div>
                      <?php } ?>
                    </div>
                  </div>
                </div>
                <div class="form-group clearfix required">
                  <label class="col-sm-3 control-label" for="input-photo-rejected"><span data-toggle="tooltip" title="<?php echo $help_photo_rejected; ?>"><?php echo $entry_photo_rejected; ?></span></label>
                  <div class="col-sm-8">
                    <select name="ad_photo_rejected" id="input-photo-rejected" class="form-control">
                      <?php foreach ($photo_statuses as $item) { ?>
                      <?php if ($item['status_id'] == $ad_photo_rejected) { ?>
                      <option value="<?php echo $item['status_id']; ?>" selected="selected"><?php echo $item['name']; ?></option>
                      <?php } else { ?>
                      <option value="<?php echo $item['status_id']; ?>"><?php echo $item['name']; ?></option>
                      <?php } ?>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </fieldset>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $('#form-advertise :input').bind('change', function () {
    var value = this.value, name = this.name;
    if(this.type=='checkbox'){
      value = [];
      $.each($('[name="'+name+'"]:checked'), function () {
        value.push($(this).val());
      });
    }
    $.post('index.php?route=setting/advertise/save&token=<?php echo $token?>',{name:name,value:value},function(){
      //$('[name="'+name+'"]').parent().after('<span class="saved bg-success"><i class="fa fa-check"></i></span>');
      //$('.saved').delay(3000).remove();
    });
  });

</script>


<?php echo $footer; ?>