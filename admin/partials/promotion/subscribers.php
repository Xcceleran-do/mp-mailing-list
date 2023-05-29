
<!-- // Display the content for the submenu page -->
  <div class="wrap">
  <h1>Subscribers</h1>


  <!-- // Search form -->
  
  <form method="post" action="<?php echo esc_url(admin_url('edit.php?post_type=mp_mail_promotions&page=subscribers'))?>">
  <!-- <input type="text" name="search" placeholder="Search" value="< ?php echo esc_attr($search)?>"> -->
  <select class="page-title-action" name="filter_by" > 
    <option value="mp_gl_notify_weekly" <?php if($filter_by==='mp_gl_notify_weekly') echo 'selected="selected"'?>>Weekly Notifications</option> 
    <option value="mp_gl_notify_mp_updates" <?php if($filter_by==='mp_gl_notify_mp_updates') echo 'selected="selected"'?>>MP Updates</option>     
  </select>
  
    <input type="submit" name="submit" value="Search">
  </form>


  <!-- // Check if there are subscribers -->
<?php  if (!empty($subscribers_slice)) { ?>

    <table class="wp-list-table widefat fixed striped">
    <thead>
    <tr>
    <th>Email</th>
    </tr>
    </thead>
    <tbody>

    <!-- // Display subscribers in table rows -->
    <?php   foreach ($subscribers_slice as $subscriber) { ?>

      <tr>
      <td> <?php echo $subscriber->user_email ?> </td>
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
    No subscribers found.
    <?php } ?>

  </div>