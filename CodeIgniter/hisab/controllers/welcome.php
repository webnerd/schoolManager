<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	public function __construct()
    {
        parent::__construct();
        $this->load->model('Database');
        $this->load->helper('utility');
        //$this->output->cache(1440);
        $this->output->enable_profiler(TRUE);
    }
	public function index()
	{	
		
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
		{
			header('Location: /'.$_SESSION['username'].'/');
		}
		else
		{
			$input['data'] = $this->input->get();
			$result = $this->Database->getUserInfo($input['data']);
			if(!empty($result))
			{
				$_SESSION['user_id']   = $result['id'];
				$_SESSION['username']  = $result['username'];
				header('Location: /'.$result['username'].'/');
			}
		}
	}
	
	public function profile()
    {
		$this->data['data'] = $this->Database->getHouseByUserId($_SESSION['user_id']);
        $structure['content'] = 'profile';
        $this->load_structure($structure);		
    } 
	public function members($houseSeoTitle)
	{
		$this->data['data'] = $this->Database->getMembersOfHouse($houseSeoTitle);
		$structure['content'] = 'members';
        $this->load_structure($structure);
	}

    public function addExpenditure($houseSeoTitle)
    {
        $this->data['members'] = $this->Database->getMembersOfHouse($houseSeoTitle);
        $expenditureData = $this->input->post();

        if(!empty($expenditureData))
        {
            $house = $this->Database->getHouseIdByHouseTitle($houseSeoTitle);
            $itemDetail = array(
                'name' => $expenditureData['item_name'],
                'price' => $expenditureData['item_price'],
                'owner_id' => $_SESSION['user_id'],
                'buyer_user_id' => $expenditureData['who_paid'],
                'house_id' => $house['id'],
                'purchase_date' => $expenditureData['item_purchase_date'],
            );

            $this->db->trans_start();
            $itemId = $this->Database->createItem($itemDetail);
            $contributionDetails = array();
            $perPersonContribution = ceil($expenditureData['item_price']/count($expenditureData['member']));
            foreach($this->data['members'] as $key=>$member)
            {
                $contributionDetails[$key] =
                    array(
                            'item_id' => $itemId,
                            'user_id' =>$member['user_id'],
                            'contribution_amount' => ((in_array($member['user_id'],$expenditureData['member']))?$perPersonContribution:0),
                    );
            }

            $this->Database->createContributionForHouseMembers($contributionDetails);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE)
            {
                $this->data['transaction']['status'] =  false;
                $this->data['transaction']['statusMsg'] =  'Transaction Failed!';
            }
            else
            {
                $this->data['transaction']['status'] =  true;
                $this->data['transaction']['statusMsg'] =  'Transaction finised successfully.';
            }
        }

        $structure['content'] = 'addExpenditureForm';
        $this->load_structure($structure);
    }
	public function viewExpenditure($houseSeoTitle)
	{
		$date  = array();
		
		if(!empty($_GET['startDate']))
        {
            $date['startDate'] = $_GET['startDate'];
        }
        else
        {
            $date['startDate'] = date('Y-m-01');
        }

        if(!empty($_GET['endDate']))
        {
            $date['endDate'] = $_GET['endDate'];
        }
        else
        {
            $date['endDate'] = date('Y-m-d');
        }
		
		$this->data['items'] = $this->Database->getItemsBoughtForHouse($houseSeoTitle,$date);
		
		$itemList = array();
		foreach($this->data['items'] as $item)
		{
			$itemList[] = $item['id'];
		}
		$this->data['data'] = perUserItemCostDistribution($this->Database->getDistributionForItemList($itemList));
		$this->data['members'] = formatMemberArray($this->Database->getMembersOfHouse($houseSeoTitle));
        $structure['content'] = 'expenditure';
        $this->load_structure($structure);
	}
	
	public function logout()
    {
        session_destroy();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */