<select class="form-control chosen-select FilterSelectBoxRight" id="FilterModalBoxTop" name="modal" onChange="save_form()" data-rel="chosen">
    <option value="">All Models</option>
    <?php
    foreach($carName as $id => $brnd)
    {
        ?>
        <option data-name="<?=$brnd?>" <?php if(@$_POST['data']['Home']['model'] == $id) { ?> selected <?php } ?> value="<?=$id?>"><?=$brnd?></option>
        <?php
    }
    ?>
</select>