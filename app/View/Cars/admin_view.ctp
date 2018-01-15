
<div class="row">
 <div class="box col-md-10">
  <div class="box-header well">
   <h2><i class="icon-code-fork"></i><?//php echo ($products['Product']['name']); ?></h2>
   <div class="err_msg"><?php echo $this->Session->flash(); ?></div>
  </div>
   <div class="box-content">
    <?php echo $this->Html->link($this->Html->tag('i', '', array('class' => 'icon-reply')) . ' Back to Car Management', array('action' => 'admin_index'), array('class' => 'btn btn-info', 'escape' => false)); ?><br/><br/>
    <table class="table table-stripped download_product">
     <tbody>
     <?php
    //  $status = $products['Product']['active']==1?'publish':'unpublish';
     ?>
     <tr>
      <td>ID :</td>
      <td><?php echo $product['Car']['id']; ?></td>
     </tr>
     <tr>
      <td>Unique Id :</td>
      <td><?php echo $product['Car']['uniqueid']; ?></td>
     </tr>
     <tr>
      <td>Chassis No :</td>
      <td><?php echo $product['Car']['cnumber']; ?></td>
     </tr>
     <tr>
      <td>Location :</td>
      <td><?php echo $product['Car']['location']; ?></td>
     </tr>
     <tr>
      <td>Transmission :</td>
      <td><?php echo $product['Car']['transmission']; ?></td>
     </tr>
     <tr>
      <td>Drive :</td>
      <td><?php echo $product['Car']['drive']; ?></td>
     </tr>
     <tr>
      <td>Handle :</td>
      <td><?php echo $product['Car']['handle'] ;?></td>
     </tr>
     <tr>
      <td>Fuel :</td>
      <td><?php echo $product['Car']['fuel']; ?>

      </td>
     </tr>
     <tr>
      <td>Stock :</td>
      <td><?php echo $product['Car']['stock']; ?></td>
     </tr>
     <tr>
      <td>Color :</td>
      <td><?php echo $product['Car']['color']; ?></td>
     </tr>
     <tr>
      <td>Door :</td>
      <td><?php echo $product['Car']['door']; ?></td>
     </tr>
     <tr>
      <td>Body Style :</td>
      <td><?php echo $product['Car']['bstyle']; ?></td>
     </tr>
     <tr>
      <td>Mileage :</td>
      <td><?php echo $product['Car']['mileage']; ?></td>
     </tr>
     </tbody>
    </table>
    <div class="clearfix"></div>
   </div>
  </div>
 </div>
  
</div>
</div><!--/row-->
