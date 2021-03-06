<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> <?php echo $heading_title; ?></h3>
  </div>
  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <td class="text-right"><?php echo $column_ad_id; ?></td>
          <td><?php echo $column_customer; ?></td>
          <td><?php echo $column_publish; ?></td>
          <td><?php echo $column_date_added; ?></td>
          <td class="text-right"><?php echo $column_in_charge; ?></td>
          <td class="text-right"><?php echo $column_action; ?></td>
        </tr>
      </thead>
      <tbody>
        <?php if ($ads) { ?>
        <?php foreach ($ads as $item) { ?>
        <tr>
          <td class="text-right"><?php echo $item['advertise_id']; ?></td>
          <td><?php echo $item['customer']; ?></td>
          <td><?php echo $item['publish']; ?></td>
          <td><?php echo $item['date_added']; ?></td>
          <td class="text-right"><?php echo $item['charger']; ?></td>
          <td class="text-right"><a href="<?php echo $item['view']; ?>" data-toggle="tooltip" title="<?php echo $button_view; ?>" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php } ?>
        <?php } else { ?>
        <tr>
          <td class="text-center" colspan="6"><?php echo $text_no_results; ?></td>
        </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</div>
