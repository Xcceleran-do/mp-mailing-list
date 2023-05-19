
<!-- // Display the content for the submenu page -->
  <div class="wrap">
  <h1>Report of '<?php echo get_the_title($post_id);?>'</h1>


  <!-- // Check if there are reports -->
<?php  if (!empty($reports_slice)) { ?>

    <table class="wp-list-table widefat fixed striped">
    <thead>
    <tr>
    <th>Email</th>
    <th>Status</th>
    </tr>
    </thead>
    <tbody>

    <!-- // Display reports in table rows -->
    <?php   foreach ($reports_slice as $report) { ?>

      <tr>
      <td> <?php echo $report['email'] ?> </td>
      <td> <?php echo absint($report['status'])? "Sent" : "Failed"; ?> </td>
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