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
	
	public function expenditure($houseSeoTitle)
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
		
		$items = $this->Database->getItemsBoughtForHouse($houseSeoTitle,$date);
		
		$itemList = array();
		foreach($items as $item)
		{
			$itemList[] = $item['id'];
		}
		$this->data['data'] = $this->Database->getDistributionForItemList($itemList);
		$this->data['members'] = $this->Database->getMembersOfHouse($houseSeoTitle);
		var_dump($this->data);
	}
	
	public function logout()
    {
        session_destroy();
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */