<div class="input-group">
    <span class="input-group-addon"><input name="<?php echo $name; ?>_radio" data-role="toggle-disabled" data-target="#<?php echo $field_id."_select"; ?>" id="<?php echo $field_id."_radio"; ?>" type="radio"<?php echo !in_array($default, array_column($options,$option_value))?"":"checked"; ?> onclick="$('#<?php echo $field_id; ?>').val($('#<?php echo $field_id; ?>_select').val());"></span>
    <select id="<?php echo $field_id."_select"; ?>" class="form-control <?php echo $class; ?>" data-default="<?php echo $default; ?>" <?php echo !in_array($default, array_column($options,$option_value))?"disabled":""; ?> onchange="$('#<?php echo $field_id; ?>').val($(this).val());">
        <?php foreach ($options as $item){ ?>
            <option value="<?php echo $item[$option_value]; ?>"><?php echo $item[$option_name]; ?></option>
        <?php } ?>
    </select>
</div>
<div class="input-group margin-top-5">
    <span class="input-group-addon"><input name="<?php echo $name; ?>_radio" data-role="toggle-disabled" data-target="#<?php echo $field_id; ?>" id="<?php echo $field_id."_radio"; ?>" type="radio" <?php echo !in_array($default, array_column($options,$option_value))?"checked":""; ?>></span>
    <input name="<?php echo $name; ?>" id="<?php echo $field_id; ?>" value="<?php echo $default; ?>" class="form-control <?php echo $class; ?>" value="<?php echo $default; ?>" type="text" <?php echo !in_array($default, array_column($options,$option_value))?"":"disabled"; ?> <?php foreach ($attr as $key=>$value){ echo $key.' = "'.$value.'"'; } ?>>
</div>
