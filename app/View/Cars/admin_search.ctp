<?php echo $this->Html->css(array('bootstrap.min','jquery-ui-1.8.4.custom','select2'));?>
<?php echo $this->Html->script(array('bootstrap.min','select2.min','cbunny'));?>
<div class="row">
    <div class="col-md-12">

    <!-- Select2 Auto Complete -->
    <div class="pull-right">
        <input type="text" id="user-select2">
    </div>
<!--
    <h2><?php echo __('Cars');?></h2>
    <table class="table"cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?/*php echo $this->Paginator->sort('UniqueId');?></th>
                <th><?php echo $this->Paginator->sort('Country');?></th>
                <th><?php echo $this->Paginator->sort('Chassis No');?></th>
                <th><?php echo $this->Paginator->sort('Transmission');?></th>
                <th><?php echo $this->Paginator->sort('Drive');?></th>
                <th><?php echo $this->Paginator->sort('Handle');?></th>
                <th><?php echo $this->Paginator->sort('Fuel');?></th>
                <th><?php echo $this->Paginator->sort('stock');?></th>
                <th><?php echo $this->Paginator->sort('All Stock');?></th>
                <th class="actions"><?//php echo __('Actions');?></th>
            </tr>
        </thead>
        <tbody>
		<?/*phpforeach ($cars as $user): ?>
            <tr>
                <td><?php echo h($user['User']['UniqueId']); ?> </td>
                <td><?php echo h($user['User']['Country']); ?> </td>
                <td><?php echo h($user['User']['password']); ?> </td>
                <td><?php echo h($user['User']['created']); ?> </td>
                <td><?php echo h($user['User']['modified']); ?> </td>
                <td class="actions">
                    <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['Car']['id'])); */?>
                </td>
            </tr>
            <?//php endforeach; ?>
        </tbody>
    </table>-->
</div>

                 
                 
                  <?/*php echo $this->Form->create(null,array('url'=>array('controller'=>'cars', 'action'=>'/admin/search','' ), 'type'=>'get', 'class'=>'search-form'));?>
                  
                    <?php  echo $this->Form->input('query', array('class'=>'searchfield pull-left','label'=>false,'div'=>false, 'placeholder'=>"Search your Car "));?>
                    
                    
                    <?php echo $this->Form->submit("search" , array('class'=>'btn add-on search_btn btn-primary', 'div'=>false));?>
                   
                 
                  <?php  echo $this->Form->end();   */?>
                 

<script>
 $(document).ready(function () {
 
  $('#user-select2').select2({
    placeholder: "Search user auto complete",
    minimumInputLength: 1,
    ajax: {
      url:'/ukcars_dashboard/admin/cars/search',
      dataType: 'json',
      data: function (term, page) {
        return {
          q: term
        };
      },
      results: function (data, page) {
        return { results: data };
      }
    }
  });
});
</script>
