<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 1/19/14
 * Time: 9:37 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<?php if(isset($transaction)) { ?>
    <div class="panel <?php echo ($transaction['status'])?'callout radius success':'error';?>">
        <p><?php echo $transaction['statusMsg'];?></p>
    </div>
<?php } ?>
<form class="create expenditure" action="" method="post" data-abide>
    <div class="row">
        <div class="large-8 columns">
            <label>On what did you spend ? <small>required</small></label>
            <input required type="text" placeholder="On what did you spend?" name="item_name" />
            <small class="error">Item name is required.</small>
        </div>
    </div>
    <div class="row">

        <div class="large-4 columns">
            <label>How much ? <small>required</small> </label>
            <input required type="number" placeholder="How much ?" name="item_price"/>
            <small class="error">Item price is required.</small>
        </div>

        <div class="large-4 columns">
            <label>When ? <small>required</small></label>
            <input required type="text" placeholder="When ?" class="datepicker" value="" name="item_purchase_date"/>
            <small class="error">Item purchase date is required.</small>
        </div>
        <div class="large-4 columns">
        </div>
    </div>

    <div class="row">
        <div class="large-8 columns">
            <label>Who paid ? <small>required</small></label>
            <select name="who_paid">
                <?php foreach($members as $key=>$member){?>
                <option value="<?php echo $member['user_id'];?>"><?php echo ucwords($member['user_name']);?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="large-12 columns">
            <label>Select Members involved <small>required</small></label>
            <?php foreach($members as $key=>$member){?>
            <div class="large-<?php echo ceil(12/count($members));?>">
            <input id="checkbox<?php echo $key;?>" type="checkbox" name="member[]" value="<?php echo $member['user_id'];?>"><label for="checkbox<?php echo $key;?>"><?php echo ucwords($member['user_name']);?></label>
            </div>
            <?php }?>
            <small class="error">Please select atleast one member.</small>
        </div>
    </div>
    <div class="row">
    <button type="submit">Create Entry</button>
    </div>
</form>