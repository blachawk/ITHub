<?php

//REGISTER AND SANITIZE SETTING OPTIONS
add_action('admin_init', 'ithub_register_settings');
function ithub_register_settings(){
    register_setting('ithub-settings-group','ithub_options','ithub_sanitize_options');
}

//SANITIZE OPTIONS | BRAIN STORM IDEAS
function ithub_sanitize_options($input) {
    $input['option_name'] = sanitize_text_field($input['option_name']);
    $input['option_email'] = sanitize_text_field($input['option_email']);
    $input['option_url'] = sanitize_text_field($input['option_url']);
    return $input;
}
?>

<form>
<div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
</div>

<div class="form-group">
    <label for="exampleFormControlSelect1">Example select</label>
    <select class="form-control" id="exampleFormControlSelect1">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleFormControlSelect2">Example multiple select</label>
    <select multiple class="form-control" id="exampleFormControlSelect2">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
</div>
<div class="form-group">
    <label for="exampleFormControlTextarea1">Example textarea</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
</div>

<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
    <label class="form-check-label" for="inlineCheckbox1">1</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
    <label class="form-check-label" for="inlineCheckbox2">2</label>
</div>
<div class="form-check form-check-inline">
    <input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="option3" disabled>
    <label class="form-check-label" for="inlineCheckbox3">3 (disabled)</label>
</div>

<?php 
submit_button( 'Save Changes' );
?>
<!--<button type="submit" class="btn btn-info">Submit</button>//-->
</form>