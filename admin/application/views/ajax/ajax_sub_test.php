<table class="table">
    <tr>
      <th>Sl. No.</th>
      <th>Sub Test</th>
      <th>Unit</th>
      <th>Reference</th>
      <th>Result Box</th>
      <th>Action</th>
    </tr>
    <tbody>
<?php

if($result!=105)
{
    foreach($result as $key2=>$value2)
    {
        ?>
        <tr>
            <td><?php echo ($key2+1); ?></td>
              <td>
                <label id="lbl_sub_test_<?php echo $key2; ?>"><?php echo $value2['sub_test_name']; ?></label>
                <input style="display: none;" id="inp_sub_test_<?php echo $key2; ?>" class="form-control" type="text" name="" value='<?php echo $value2['sub_test_name']; ?>'>
              </td>
              <td>
                <label id="lbl_unit_<?php echo $key2; ?>"><?php if(empty($value2['unit'])){echo '-';}else{ echo $value2['unit'];} ?></label>
                <select style="display: none;" id="inp_unit_<?php echo $key2; ?>" class="form-control">
                  <?php 
                    foreach($unit_list as $keyU=>$valU)
                    {
                      ?>
                      <option <?php if($value2['unit']==$valU['id']){echo'selected="selected"';} ?> value="<?php echo $valU['id']; ?>"><?php echo $valU['unit']; ?></option>
                      <?php
                    }
                   ?>
                </select>
              </td>
              <td>
                <label id="lbl_reference_<?php echo $key2; ?>"><?php if(empty($value2['test_reference_id'])){echo'-';}else{echo $value2['test_reference_id'];}  ?></label>
                <input style="display: none;" id="inp_reference_<?php echo $key2; ?>" class="form-control" type="text" name="" value="<?php echo $value2['test_reference_id']; ?>">
              </td>
              <td>
                <label title="<?php echo $value2['box_details']; ?>" id="lbl_result_box_<?php echo $key2; ?>"><?php echo $value2['input_box_name']; ?></label>
                <select style="display: none;" id="inp_result_box_<?php echo $key2; ?>" class="form-control">
                  <?php 
                    foreach($result_box_list as $keyR=>$valR)
                    {
                      ?>
                      <option title="<?php echo $valR['box_details']; ?>" <?php if($value2['result_box']==$valR['id']){echo'selected="selected"';} ?> value="<?php echo $valR['id']; ?>"><?php echo $valR['input_box_name']; ?></option>
                      <?php
                    }
                   ?>
                </select>
              </td>
              <td>
                <input id="hdn_id_<?php echo $key2; ?>" type="hidden" value="<?php echo $value2['id']; ?>">
                <i title="Edit" id="edit_btn_<?php echo $key2; ?>" onclick="edit_btn_click('<?php echo $key2; ?>')"  class="icon-pencil icons" style="cursor: pointer;"></i>
                <i title="Delete" id="delete_btn_<?php echo $key2; ?>" onclick="delete_sub_test('<?php echo $key2; ?>')" class="icon-trash icons" style="cursor: pointer;"></i>
                
                <i title="Save" style="display: none;cursor: pointer;" id="update_btn_<?php echo $key2; ?>"  onclick="update_sub_test('<?php echo $key2; ?>')"  class="fa fa-check"></i>
                <i title="Cancel" style="display: none;cursor: pointer;" id="close_btn_<?php echo $key2; ?>"  onclick="close_btn_click('<?php echo $key2; ?>')"  class="fa fa-close"></i>
              </td>
            </tr>
        <?php
    }
}

?>
  </tbody>
</table>

  