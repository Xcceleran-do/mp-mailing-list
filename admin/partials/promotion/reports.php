
<!-- // Display the content for the submenu page -->
  <?php $successEmailCount = 0; $openedCount = 0 ?>
  <div class="wrap">
  <h1>Report of '<?php echo get_the_title($post_id);?>'</h1>
  <h1 id="opened-email-h1">Out of <?php echo count($reports_slice);?>/</h1>
  <h1 id="success-email-h1">Out of <?php echo count($reports_slice);?>/</h1>


  <!-- // Check if there are reports -->
<?php  if (!empty($reports_slice)) { ?>

    <table class="wp-list-table widefat fixed striped">
    <thead>
    <tr>
    <th>#</th>
    <th>Email</th>
    <th>Email status</th>
    <th>Is opened</th>
    </tr>
    </thead>
    <tbody>

    <!-- // Display reports in table rows -->
    <?php   for ($i=0; $i < count($reports_slice); $i++) { ?>

      <tr>
      <td> <?php echo $i+1 ?> </td>
      <td> <?php echo $reports_slice[$i]['email'] ?> </td>
      <td> <?php 
      
      if (absint($reports_slice[$i]['status'])){
        echo "success";
        $successEmailCount++;
        }else{
        echo  "Failed"; 
      }
      echo ' - ' .get_the_date('Y-m-d H:m:i', $post_id);
      ?> </td>
      <td> <?php 
        if ($reports_slice[$i]['has_opened'] == "1"){
          echo "Opened at " . $reports_slice[$i]['opened_at'];
          $openedCount++;
          }else{
          echo  "Not opened"; 
        }
      ?> </td>
      </tr>
      <?php  
    
    } ?>
    <script>
      var openedCount = `<?php echo $openedCount;?>`
      var opened_email_h1 = document.getElementById("opened-email-h1");
      opened_email_h1.textContent += openedCount + ' Opened';

      var successEmailCount = `<?php echo $successEmailCount;?>`
      var success_email_h1 = document.getElementById("success-email-h1");
      success_email_h1.textContent += successEmailCount + ' successfully delivered';
    </script>

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