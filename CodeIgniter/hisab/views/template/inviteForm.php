<?php
    /**
     * Created by JetBrains PhpStorm.
     * User: Prasad
     * Date: 1/25/14
     * Time: 3:33 PM
     * To change this template use File | Settings | File Templates.
     */
?>
<div class="row">
    <div class="large-4 columns">
        <form id="inviteForm" name="inviteForm" data-abide="ajax">
            <div>
                <label>Enter Email Id <small>required</small></label>
                <input type="email" name="inviteeEmailId" id='inviteeEmailId' required/>
                <small class="error">Please enter valid email Id.</small>
                <input type="hidden" name='houseSeoTitle' value="<?php echo $houseName; ?>"/>
            </div>
            <div>
                <button type="submit">Invite</button>
            </div>
        </form>
    </div>
</div>
