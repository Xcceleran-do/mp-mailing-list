<div id="main_body">
  <main>
    <?php $successEmailCount = 0;
    $openedCount = 0 ?>

    <div class="report-container">
      <h3 class="report-title">Report of '<?php echo get_the_title($post_id); ?>'</h3>
    </div>
    <div class="grid-container report-types">
      <div class="card">
        <span class="card-title" id="opened-email-h1">Out of <?php echo count($reports_slice); ?><br>recipients </span>
      </div>
      <div class="card" id="rate">

        <span class="card-title" id="success-email-h1">Out of <?php echo count($reports_slice); ?><br> subscribers </span>
      </div>
    </div>
    <button class="stats-btn" id="">Stats</button>

    <!-- // Check if there are reports -->
    <?php if (!empty($reports_slice)) { ?>

      <table class="wp-list-table widefat fixed striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Email</th>
            <th>Delivery status</th>
            <th>Email status</th>
          </tr>
        </thead>
        <tbody>

          <!-- // Display reports in table rows -->
          <?php for ($i = 0; $i < count($reports_slice); $i++) { ?>

            <tr>
              <td> <?php echo $i + 1 ?> </td>
              <td> <?php echo $reports_slice[$i]['email'] ?> </td>
              <td> <?php

                    if (absint($reports_slice[$i]['status'])) {
                      echo "success";
                      $successEmailCount++;
                    } else {
                      echo  "Failed";
                    }
                    echo ' - ' . get_the_date('Y-m-d H:m:i', $post_id);
                    ?> </td>
              <td> <?php
                    if ($reports_slice[$i]['has_opened'] == "1") {
                      echo "Opened at " . $reports_slice[$i]['opened_at'];
                      $openedCount++;
                    } else {
                      echo  "Not opened";
                    }
                    ?> </td>
            </tr>
          <?php

          } ?>

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

<script>
  var openedCount = `<?php echo $openedCount; ?>`
  var opened_email_h1 = document.getElementById("opened-email-h1");
  opened_email_h1.innerHTML += openedCount + ' <br>Opened';

  var successEmailCount = `<?php echo $successEmailCount; ?>`
  var success_email_h1 = document.getElementById("success-email-h1");
  success_email_h1.innerHTML += successEmailCount + ' <br> have recieved.';
</script>