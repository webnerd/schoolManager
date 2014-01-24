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
<form id="expenditure" class="create expenditure" action="/expenditure/<?php echo isset($itemDetail)?"update/$houseName/".$itemDetail['id']:"add/$houseName/";?>/" method="post" data-abide>
    <div class="row">
        <div class="large-8 columns">
            <label>On what did you spend ? <small>required</small></label>
            <input required value="<?php echo isset($itemDetail['name'])?$itemDetail['name']:'';?>" type="text" placeholder="On what did you spend?" name="item_name" />
            <small class="error">Item name is required.</small>
        </div>
    </div>
    <div class="row">

        <div class="large-4 columns">
            <label>How much ? <small>required</small> </label>
            <input required value="<?php echo isset($itemDetail['price'])?$itemDetail['price']:'';?>" type="number" placeholder="How much ?" name="item_price"/>
            <small class="error">Item price is required.</small>
        </div>

        <div class="large-4 columns">
            <label>When ? <small>required</small></label>
            <input required value="<?php echo isset($itemDetail['purchase_date'])?date('Y-m-d',strtotime($itemDetail['purchase_date'])):'';?>" type="text" placeholder="When ?" class="datepicker" value="" name="item_purchase_date"/>
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
                <option <?php if(isset($itemDetail['buyer_user_id'])){if($member['user_id'] == $itemDetail['buyer_user_id']){ echo'selected=selected';}} ?> value="<?php echo $member['user_id'];?>"><?php echo ucwords($member['user_name']);?></option>
                <?php }?>
            </select>
        </div>
    </div>

    <div id="members" class="row">
        <div class="large-12 columns">
            <label>Select Members involved <small>required</small></label>
            <?php foreach($members as $key=>$member){?>
            <div class="large-<?php echo ceil(12/count($members));?>">
            <input <?php if(isset($itemContributionDetail)){if(in_array($member['user_id'],$itemContributionDetail)){ echo'checked=checked';}}?> id="checkbox<?php echo $key;?>" type="checkbox" name="member[]" value="<?php echo $member['user_id'];?>"><label for="checkbox<?php echo $key;?>"><?php echo ucwords($member['user_name']);?></label>
            </div>
            <?php }?>
            <small class="error">Please select atleast one member.</small>
        </div>
    </div>
    <div class="row">
    <button type="submit">Create Entry</button>
    </div>
</form>