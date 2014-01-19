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
	
	public function getUserInfo($user_info)
    {
        $this->db->select('id,username,name')
                 ->where(array('username' => $user_info['username'] , 'password'=>md5($user_info['pass'])));
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
	
		$whereCondition = array('house.seo_title' => $houseSoeTitle);

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
		$this->db->select('item_user_mapping.*')->from('item_user_mapping')
				->where_in('item_user_mapping.item_id',$itemList)
				->order_by('item_user_mapping.user_id');
		$query = $this->db->get();
        return $this->getResultArray($query);
	}
}