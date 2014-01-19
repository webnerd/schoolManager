<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 1/19/14
 * Time: 3:25 PM
 * To change this template use File | Settings | File Templates.
 */
?>

<table>
    <thead>
        <th>Sr. No</th>
        <th>Item Name</th>
        <th>Cost</th>
        <th>Date</th>
        <th>Paid By</th>
        <?php foreach($members as $member){?>
            <th><?php echo ucwords($member['user_name']);?></th>
        <?php }?>



    </thead>
    <tbody>
        <?php foreach($items as $key=>$item){?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo ucwords($item['name']); ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo date('Y-m-d',strtotime($item['purchase_date'])); ?></td>
            <td><?php echo ucwords($members[$item['buyer_user_id']]['user_name']); ?></td>

            <?php foreach($members as $member){?>
            <td><?php echo isset($data[$member['user_id']]['items'][$item['id']]['contribution'])?$data[$member['user_id']]['items'][$item['id']]['contribution']:0;?></td>
            <?php }?>

        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
//var_dump($members);
//echo'<pre>';print_r($data);
//var_dump($items);
?>