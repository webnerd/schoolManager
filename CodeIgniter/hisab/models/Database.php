<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Prasad
 * Date: 9/29/13
 * Time: 3:16 PM
 * To change this template use File | Settings | File Templates.
 * echo $this->db->last_query();
 */
class Database extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getResultArray($query)
    {
        $result = array();
        foreach($query->result_array() as $row)
		{
            $result[] = $row;
        }
		return $result;
    }

    public function createUser($userData)
    {
        $this->db->insert('user', $userData);
        return $this->db->insert_id();
    }
	public function getUserInfo($userInfo)
    {
        $this->db->select('id,username,name')
                 ->where(array('email_id' => $userInfo['user_email'] , 'password'=>md5($userInfo['user_password'])));
        return $this->db->get('user')->row_array();
    }

    public function getUserIdByEmail($emailId)
    {
        $this->db->select('id')
            ->where(array('email_id' => $emailId));
        return $this->db->get('user')->row_array();
    }

	public function getHouseByUserId($userId)
	{
		$this->db->select('house.id,house.name,house.address,house.seo_title')->from('house')
				->join('house_user_mapping','house.id = house_user_mapping.house_id')
                ->where( array('house_user_mapping.user_id' => $userId) );
        $query = $this->db->get();
        return $this->getResultArray($query);
	}

	public function getMembersOfHouse($houseSoeTitle)
	{
		$this->db->select('house.*,user.id as user_id,user.username,user.name as user_name')->from('house')
                 ->join('house_user_mapping','house.id = house_user_mapping.house_id')
                 ->join('user', 'user.id = house_user_mapping.user_id')
                 ->where(array('house.seo_title' => $houseSoeTitle));
        $query = $this->db->get();
        return $this->getResultArray($query);
	}
	
	public function getItemsBoughtForHouse($houseSoeTitle,$date)
	{
	
		$whereCondition = array('house.seo_title' => $houseSoeTitle, 'settlement_status' => 0);

        if( isset($date['endDate']) && !empty($date['endDate']) )
        {
            $whereCondition['DATE(item.purchase_date) <='] = $date['endDate'];

            if( isset($date['startDate']) && !empty($date['startDate']) )
            {
                $whereCondition['DATE(item.purchase_date) >='] = $date['startDate'];
            }
        }
		
		$this->db->select('item.*')->from('item')
			->join('house','house.id = item.house_id')
			->where( $whereCondition );
		$query = $this->db->get();
        return $this->getResultArray($query);
	}
	
	public function getDistributionForItemList($itemList)
	{
		if(!empty($itemList))
        {
            $this->db->select('item_user_mapping.*')->from('item_user_mapping')
                ->where_in('item_user_mapping.item_id',$itemList)
                ->order_by('item_user_mapping.user_id');
            $query = $this->db->get();
            return $this->getResultArray($query);
        }
        return array();

	}

    public function getHouseIdByHouseTitle($houseSeoTitle)
    {
        $this->db->select('house.id')
            ->where( array('seo_title' => $houseSeoTitle) );
        return $this->db->get('house')->row_array();
    }

    public function createItem($itemDetail)
    {
        $this->db->insert('item', $itemDetail);
        return $this->db->insert_id();
    }

    public function createContributionForHouseMembers($contributionDetails)
    {
        $this->db->insert_batch('item_user_mapping', $contributionDetails);
        return $this->db->affected_rows();
    }

    public function deleteContributionForHouseMembers($itemId)
    {
        $this->db->delete('item_user_mapping', array('item_id' => $itemId));
        return $this->db->affected_rows();
    }

    public function upsertTag($itemDetail)
    {
        $this->db->set('frequency', 'frequency+1', FALSE);
        $this->db->where('name', $itemDetail['name']);
        $this->db->update('tags');
        if($this->db->affected_rows() == 0)
        {
            $this->db->insert('tags', array('name' =>$itemDetail['name'], 'frequency' => 1));
        }
        return $this->db->affected_rows();
    }

    public function getItemData($itemId)
    {
        return $this->db->get_where('item', array('id' => $itemId))->row_array();
    }

    public function getItemContributionData($itemId)
    {
        $this->db->select('user_id')->from('item_user_mapping')
            ->where( array('item_id' => $itemId, 'contribution_amount <> '=>0) );
        $query = $this->db->get();
        return $this->getResultArray($query);
    }

    public function updateItem($itemDetail,$itemId)
    {
        $this->db->update('item', $itemDetail, array('id' => $itemId));
        return $this->db->affected_rows();
    }

    public function inviteMember($houseId,$userId)
    {
        $this->db->get_where('house_user_mapping', array('house_id' =>$houseId,'user_id'=>$userId));
        if($this->db->affected_rows() == 0)
        $this->db->insert('house_user_mapping', array('house_id' =>$houseId,'user_id'=>$userId, 'status' => 0));
        return $this->db->affected_rows();
    }
}