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
		        'isLoggedIn' 	=> true
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
		$getLoadTransaction = $this->model->getLoadTransaction($userId);

		$data = array(
			'result' => $getLoadTransaction->result()
		);

		generate_json($data);
	}

	public function dashboardAdmin() {
		$this->load->view('dashboard-admin');
	}

	public function loadRequest() {
		$this->load->view('load-request');
	}

	public function viewRequest() {
		$requestSearch = sanitize($this->input->post('requestSearch'));
		$getLoadRequest = $this->model->getLoadRequest($requestSearch);

		$data = array(
			'result' => $getLoadRequest->result()
		);

		generate_json($data);
	}
	
	public function confirmRequest() {
		$requestId = sanitize($this->input->post('requestId'));
		$getConfirmRequest = $this->model->getConfirmRequest($requestId);

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function loadReqCount() {
		$getLoadReqCount = $this->model->getLoadReqCount();

		$data = array(
			'reqCount' => $getLoadReqCount->row()->reqCount
		);

		generate_json($data);
	}
}
