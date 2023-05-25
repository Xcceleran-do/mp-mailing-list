
<!-- // Display the content for the submenu page -->
  <div class="wrap">
  <h1>Report of '<?php echo get_the_title($post_id);?>'</h1>


  <!-- // Check if there are reports -->
<?php  if (!empty($reports_slice)) { ?>

    <table class="wp-list-table widefat fixed striped">
    <thead>
    <tr>
    <th>#</th>
    <th>Email</th>
    <th>Status</th>
    <th>Date</th>
    </tr>
    </thead>
    <tbody>

    <!-- // Display reports in table rows -->
    <?php   for ($i=0; $i < count($reports_slice); $i++) { ?>

      <tr>
      <td> <?php echo $i+1 ?> </td>
      <td> <?php echo $reports_slice[$i]['email'] ?> </td>
      <td> <?php echo absint($reports_slice[$i]['status'])? "success" : "Failed"; echo ' - ' .get_the_date('Y-m-d H:m:i', $post_id);?> </td>
      <td> <?php echo $reports_slice[$i]['has_opened'] == "1" ? "Opened" : "Unknown"; ?> </td>
      </tr>
      <?php   } ?>

    </tbody>
    </table>
    <?php 
        // Pagination
        if ($total_pages > 1) { ?>
        <div class="tablenav">
        <div class="tablenav-pages">
        <?php echo paginate_links(array(
            'base' => add_query_arg('paged', '%#%'),
            'format' => '',
            'prev_text' => '&laquo;',
            'next_text' => '&raquo;',
            'total' => $total_pages,
            'current' => $current_page,
        )); ?>
        </div>
        </div>
        <?php }
    } else { ?>
    No reports found.
    <?php } ?>

  </div>