
<!-- // Display the content for the submenu page -->
  <div class="wrap">
  <h1>Subscribers</h1>
  <form method="post" action="<?php echo esc_url(admin_url('edit.php?post_type=mp_mail_promotions&page=subscribers'))?>">
  
  <select class="page-title-action" name="filter_by" > 
    <?php
    
      foreach ($mail_promo_types as $promo_type) {
        ?>
          <option value="<?php echo $promo_type->slug?>" <?php if($filter_by===$promo_type->slug) echo 'selected="selected"'?>><?php echo $promo_type->name?></option> 
      <?php
          echo $promo_type->name . '<br>';
      }

      foreach ($additional_subscribers as $additional_subscriber) {
        ?>
          <option value="<?php echo $additional_subscriber['slug']?>" <?php if($filter_by===$additional_subscriber['slug']) echo 'selected="selected"'?>><?php echo $additional_subscriber['name']?></option> 
      <?php
          echo $additional_subscriber['name'] . '<br>';
      }
  ?>
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


    <input type="text" id="user_email" placeholder="Enter user email" required>
    <input type="hidden" id="sub-type" value="<?php echo $filter_by ?>">
    <button id="addNewUser">Add new subscriber to group</button>


  </div>

<script>
    const addNewUser = document.getElementById('addNewUser');

    addNewUser.addEventListener('click', function (e){
        e.preventDefault()

        jQuery.ajax({
            url: ajaxurl,
            type: 'POST',
            data: {
                action: 'mp_add_new_subscriber',
                user_email: document.getElementById('user_email').value,
                sub_type: document.getElementById('sub-type').value,
            },
            beforeSend: function(){
                addNewUser.innerHTML = "Saving......"
            },
            success: function(response) {
                alert(response);
            },
        });
    })

</script>