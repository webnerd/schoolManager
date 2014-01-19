<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 1/19/14
 * Time: 3:57 PM
 * To change this template use File | Settings | File Templates.
 */

function formatMemberArray($members)
{
    $tmpMembers = array();
    foreach($members as $member)
    {
        $tmpMembers[$member['user_id']] = $member;
    }
    return $tmpMembers;
}

function perUserItemCostDistribution($items)
{
    $usersContribution = array();
    foreach($items as $item)
    {
        $usersContribution[$item['user_id']]['items'][$item['item_id']]['contribution'] = $item['contribution_amount'];
    }
    return $usersContribution;
}