<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PayPal\Api\Payer;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;


class Main extends CI_Controller {

	public function index() {
		if($this->session->userdata('isLoggedIn') == true) {
			header("location:/Main/dashboard");
		}
		$this->load->view('login');
	}

	public function signup() {
		$this->load->view('signup');
	}

	public function login() {
		$email 	= sanitize($this->input->post('email'));
		$pass 	= sanitize($this->input->post('pass'));	

		$getLogin = $this->model->getLogin($email, $pass);

		if($getLogin->num_rows() == 1) { // logged in
			$userObj = $getLogin->row();
			$userData = array(
				'userId'		=> $userObj->userId,
		        'email'  		=> $userObj->email,
		        'firstname'     => $userObj->firstname,
		        'lastname'     	=> $userObj->lastname,
		        'mobile'		=> $userObj->mobile,
		        'isLoggedIn' 	=> true,
		        'positionId'	=> $userObj->positionId
			);

			$this->session->set_userdata($userData);

			$data = array(
				'success' => 1,
				'userData' => $getLogin->row()
			);
		}else {
			$data = array(
				'success' => 0,
				'$email' => $email,
				'$pass' => $pass
			);
		}
		
		generate_json($data);
	}

	public function isLoggedIn() {
		if($this->session->userdata('isLoggedIn') == false) {
			header("location:/");
		}
	}

	public function isAdminLoggedIn() {
		if($this->session->userdata('positionId') != 1) {
			header("location:/");
		}
	}

	public function dashboard() {
		$this->isLoggedIn();
		$data = array(
			'networks' => $this->model->getLoadAllNetwork()->result(),
			'amounts' => $this->model->getLoadAllAmounts()->result()
		);
		$this->load->view('dashboard', $data);
	}

	public function paypalProcess() {
		// for PayPal Payment Process
		if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])) {
			header("location:/Main/dashboard?paymentSuccess=0");
			die();
		}

		if($_GET['success'] == 0) {
			header("location:/Main/dashboard?paymentSuccess=0");
		}

		require APPPATH . 'vendor/autoload.php';

		define('SITE_URL', base_url());

		$paypal = new \PayPal\Rest\ApiContext(
			new \PayPal\Auth\OAuthTokenCredential(
				'AZ1FnJT7fH4FW3nHJiobuyKLu7MZrsQlUgDnFnyCAaoT8jDwi1sHnevGhMf66Y0CglzaF4YBtm5dzUBg', // Client Id
				'ELrkCWLRD9sw1JXv4JS1vIkPoXwNI60sUg8tuwGTalgEck6Wgq784f_f5zOADOsedlsl4ksrjmNKHLWR' // Client Secret
			)
		);

		$paymentId = $_GET['paymentId'];
		$payerId = $_GET['PayerID'];

		$payment = Payment::get($paymentId, $paypal);
		$execute = new PaymentExecution();
		$execute->setPayerId($payerId);

		try {
			$result = $payment->execute($execute, $paypal);
		}catch(Exception $e) {
			$data = json_decode($e->getData());
			echo $data->message;
			die();
		}

		$getSenderUserId = $this->session->userdata('userId');
		$getAmount = $_GET['getAmount'];
		$getNetworkId = $_GET['getNetworkId'];
		$getMobileNo = $_GET['getMobileNo'];

		// Insert Payment transaction to the database
		$insertRecord = $this->model->getPaymentTransact($getSenderUserId, $getAmount, $getNetworkId, $getMobileNo);
		if($insertRecord != 0) {
			header("location:/Main/dashboard?paymentSuccess=1");
		}
	}

	public function signupUser() {
		$email 		= sanitize($this->input->post('email'));
		$pass 		= sanitize($this->input->post('pass'));
		$fname 		= sanitize($this->input->post('fname'));
		$lname 		= sanitize($this->input->post('lname'));
		$mobile 	= sanitize($this->input->post('mobile'));
		$address 	= sanitize($this->input->post('address'));

		$checkEmailExist = $this->model->getCheckEmailExist($email);

		if($checkEmailExist->row()->emailCount) {
			$data = array(
				'success' => 0
			);
		}else {
			$getSignup = $this->model->getSignup($email, $pass, $fname, $lname, $mobile, $address);

			$data = array(
				'success' => 1
			);
		}

		generate_json($data);
	}

	public function logout() {
		$this->session->sess_destroy();

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function systemLogout() {
		$this->session->sess_destroy();

		header("location:".base_url());
	}

	public function networkPrefix() {
		$networkId = sanitize($this->input->post('networkId'));

		$getNetworkPrefix = $this->model->getNetworkPrefix($networkId);

		$data = array(
			'result' => $getNetworkPrefix->result()
		);

		generate_json($data);
	}

	public function buyLoad() {
		if(!isset($_POST['networkId'], $_POST['mobileNo'], $_POST['loadAmount'])) {
			header("location:/Main/dashboard");
			die();
		}

		require APPPATH . 'vendor/autoload.php';

		define('SITE_URL', base_url());

		$paypal = new \PayPal\Rest\ApiContext(
			new \PayPal\Auth\OAuthTokenCredential(
				'AZ1FnJT7fH4FW3nHJiobuyKLu7MZrsQlUgDnFnyCAaoT8jDwi1sHnevGhMf66Y0CglzaF4YBtm5dzUBg', // Client Id
				'ELrkCWLRD9sw1JXv4JS1vIkPoXwNI60sUg8tuwGTalgEck6Wgq784f_f5zOADOsedlsl4ksrjmNKHLWR' // Client Secret
			)
		);

		$networkId 		= sanitize($this->input->post('networkId'));
		$networkName 	= $this->model->getNetworkName($networkId);
		$price 			= sanitize($this->input->post('loadAmount'));
		$product 		= $networkName.' - '.$price;
		$prefix  		= sanitize($this->input->post('prefix'));
		$mobileNo  		= sanitize($this->input->post('mobileNo'));

		$payer = new Payer();
		$payer->setPaymentMethod('paypal');

		$item = new Item();
		$item->setName($product) // Can be multiple for multiple items
			->setCurrency('PHP')
			->setQuantity(1)
			->setPrice($price);

		$itemList = new ItemList();
		$itemList->setItems([$item]); // accept multiple item ex. [$item1, $item2, $item3]

		$details = new Details();
		$details->setShipping(0)
				->setSubtotal($price);

		$amount = new Amount();
		$amount->setCurrency('PHP')
			->setTotal($price)
			->setDetails($details);

		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription('LoadTopUp Payment')
			->setInvoiceNumber(uniqid());
			$test = "TESTING_PRODUCT";
		$redirectUrls = new RedirectUrls();

		// passing metadata to the URL
		$getAmount = $price;
		$getNetworkId = $networkId;
		$getMobileNo =  $prefix.''.$mobileNo;

		$redirectUrls->setReturnUrl(base_url('Main/paypalProcess?success=1&getAmount='.$getAmount.'&getNetworkId='.$getNetworkId.'&getMobileNo='.$getMobileNo))
			->setCancelUrl(base_url('Main/paypalProcess?success=0'));

		$payment = new Payment();
		$payment->setIntent('sale')
			->setPayer($payer)
			->setRedirectUrls($redirectUrls)
			->setTransactions([$transaction]);

		try {
			$payment->create($paypal);
		} catch(Exception $e) {
			die($e);
		}

		$approvalUrl = $payment->getApprovalLink();

		header("location:".$approvalUrl);
	}

	public function loadTransaction() {
		$userId = $this->session->userdata('userId');
		$trasactionSearch = sanitize($this->input->post('trasactionSearch'));
		$currentPage = sanitize($this->input->post('currentPage'));
		$rowPerPage = sanitize($this->input->post('rowPerPage'));

		$currentPage = $currentPage > 1 ? $currentPage : 0;
		$currentPage = $currentPage * $rowPerPage;
		if($currentPage > 10) {
			$currentPage -= 10;
		}



		$getLoadTransaction = $this->model->getLoadTransaction($userId, $trasactionSearch, $currentPage, $rowPerPage);

		$data = array(
			'result' => $getLoadTransaction->result(),
			'entrieStart' => $currentPage + 1,
			'entrieEnd' => $currentPage + 10
		);

		generate_json($data);
	}

	public function dashboardAdmin() {
		$this->isAdminLoggedIn();
		$this->load->view('dashboard-admin');
	}

	public function loadRequest() {
		$this->isAdminLoggedIn();
		$this->load->view('load-request');
	}

	public function viewRequest() {
		$currentPage 	= sanitize($this->input->post('currentPage'));
		$rowPerPage 	= sanitize($this->input->post('rowPerPage'));
		$requestSearch 	= sanitize($this->input->post('requestSearch'));

		$currentPage = $currentPage > 1 ? $currentPage : 0;
		$currentPage = $currentPage * $rowPerPage;
		if($currentPage > 10) {
			$currentPage -= 10;
		}

		$getLoadRequest = $this->model->getLoadRequest($requestSearch, $currentPage, $rowPerPage);

		$data = array(
			'result' => $getLoadRequest->result(),
			'entrieStart' => $currentPage + 1,
			'entrieEnd' => $currentPage + 10
		);

		generate_json($data);
	}
	
	public function confirmRequest() {
		$this->isAdminLoggedIn();
		$requestId = sanitize($this->input->post('requestId'));
		$getConfirmRequest = $this->model->getConfirmRequest($requestId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function loadReqCount() {
		$requestSearch = sanitize($this->input->post('requestSearch'));
		$getLoadReqCount = $this->model->getLoadReqCount($requestSearch);

		$data = array(
			'reqCount' => $getLoadReqCount->row()->reqCount
		);

		generate_json($data);
	}

	public function users() {
		$this->isAdminLoggedIn();
		$this->load->view('users');
	}

	public function loadUsers() {
		$userId = $this->session->userdata('userId');
		$userSearch = sanitize($this->input->post('userSearch'));
		$currentPage = sanitize($this->input->post('currentPage'));
		$rowPerPage = sanitize($this->input->post('rowPerPage'));

		$currentPage = $currentPage > 1 ? $currentPage : 0;
		$currentPage = $currentPage * $rowPerPage;
		if($currentPage > 10) {
			$currentPage -= 10;
		}
		
		$getLoadUsers = $this->model->getLoadUsers($userId, $userSearch, $currentPage, $rowPerPage);

		$data = array(
			'result' => $getLoadUsers->result(),
			'entrieStart' => $currentPage + 1,
			'entrieEnd' => $currentPage + 10
		);

		generate_json($data);
	}

	public function network() {
		$this->isAdminLoggedIn();
		$this->load->view('network');
	}

	public function loadNetwork() {
		$getLoadNetwork = $this->model->getLoadAllNetwork();

		$data = array(
			'result' => $getLoadNetwork->result()
		);

		generate_json($data);
	}

	public function addNetwork() {
		$netName = sanitize($this->input->post('netName'));

		$getAddNetwork = $this->model->getAddNetwork($netName);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function editNetwork() {
		$netName = sanitize($this->input->post('netName'));
		$netId = sanitize($this->input->post('netId'));

		$getEditNetwork = $this->model->getEditNetwork($netName, $netId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function deleteNetwork() {
		$deleteId = sanitize($this->input->post('deleteId'));

		$getDeleteNetwork = $this->model->getDeleteNetwork($deleteId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function loadamount() {
		$this->isAdminLoggedIn();
		$this->load->view('loadamount');
	}

	public function loadAllAmount() {
		$getLoadAmount = $this->model->getLoadAllAmounts();

		$data = array(
			'result' => $getLoadAmount->result()
		);

		generate_json($data);
	}

	public function addAmount() {
		$loadAmount = sanitize($this->input->post('loadAmount'));

		$getAddAmount = $this->model->getAddAmount($loadAmount);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function editAmount() {
		$editId = sanitize($this->input->post('editId'));
		$amount = sanitize($this->input->post('amount'));

		$getEditAmount = $this->model->getEditAmount($editId, $amount);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function deleteAmount() {
		$deleteId = sanitize($this->input->post('deleteId'));

		$getDeleteAmount = $this->model->getDeleteAmount($deleteId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function numberPrefix() {
		$this->isAdminLoggedIn();
		$data = array(
			'networks' => $this->model->getLoadAllNetwork()->result()
		);

		$this->load->view('number-prefix', $data);
	}

	public function loadPrefix() {
		$getLoadPrefix = $this->model->getLoadPrefix();

		$data = array(
			'result' => $getLoadPrefix->result()
		);

		generate_json($data);
	}

	public function addPrefix() {
		$prefixName = sanitize($this->input->post('prefixName'));
		$networkId = sanitize($this->input->post('networkId'));


		$getAddPrefix = $this->model->getAddPrefix($prefixName, $networkId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function editPrefix() {
		$editId = sanitize($this->input->post('editId'));
		$netPrefix = sanitize($this->input->post('netPrefix'));
		$netId = sanitize($this->input->post('netId'));

		$getEditPrefix = $this->model->getEditPrefix($editId, $netPrefix, $netId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function deletePrefix() {
		$deleteId = sanitize($this->input->post('deleteId'));

		$getDeletePrefix = $this->model->getDeletePrefix($deleteId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function completeRequestCount() {
		$completeSearch = sanitize($this->input->post('completeSearch'));
		$getCompleteRequestCount = $this->model->getCompleteRequestCount($completeSearch);

		$data = array(
			'count' => $getCompleteRequestCount->row()->count,
			'totalAmount' => $getCompleteRequestCount->row()->totalAmount
		);

		generate_json($data);
	}

	public function registeredUserCount() {
		$userId = $this->session->userdata('userId');
		$userSearch = sanitize($this->input->post('userSearch'));
		$getRegisteredUserCount = $this->model->getRegisteredUserCount($userId, $userSearch);

		$data = array(
			'count' => $getRegisteredUserCount->row()->count
		);

		generate_json($data);
	}

	public function adminNetworkCount() {
		$getAdminNetworkCount = $this->model->getAdminNetworkCount();

		$data = array(
			'count' => $getAdminNetworkCount->row()->count
		);

		generate_json($data);
	}

	public function adminLoadAmountCount() {
		$adminLoadAmountCount = $this->model->adminLoadAmountCount();

		$data = array(
			'count' => $adminLoadAmountCount->row()->count
		);

		generate_json($data);
	}

	public function completeRequest() {
		$this->isAdminLoggedIn();
		$this->load->view('complete-request');
	}
	
	public function viewCompleteRequest() {
		$currentPage = sanitize($this->input->post('currentPage'));
		$rowPerPage = sanitize($this->input->post('rowPerPage'));
		$completeSearch = sanitize($this->input->post('completeSearch'));

		$currentPage = $currentPage > 1 ? $currentPage : 0;
		$currentPage = $currentPage * $rowPerPage;
		if($currentPage > 10) {
			$currentPage -= 10;
		}

		$getCompleteRequest = $this->model->getCompleteRequest($completeSearch, $currentPage, $rowPerPage);

		$data = array(
			'result' => $getCompleteRequest->result(),
			'entrieStart' => $currentPage + 1,
			'entrieEnd' => $currentPage + 10
		);

		generate_json($data);
	}

	public function transactCount() {
		$userId = $this->session->userdata('userId');
		$trasactionSearch = sanitize($this->input->post('trasactionSearch'));

		$getTransactCount = $this->model->getTransactCount($userId, $trasactionSearch);

		$data = array(
			'count' => $getTransactCount->row()->count
		);

		generate_json($data);
	}
}
