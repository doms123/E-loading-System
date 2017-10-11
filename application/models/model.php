<?php 
class Model extends CI_Model {
	public function getLogin($email, $pass) {
		$sql = "SELECT userId, email, firstname, lastname, mobile, positionId FROM tbl_user WHERE email = ? AND password = ? LIMIT 1";
		$data = array($email, $pass);
		return $this->db->query($sql, $data);
	}

	public function getSignup($email, $pass, $fname, $lname, $mobile, $address) {
		$sql = "INSERT INTO tbl_user(`email`, `password`, `firstname`, `lastname`, `mobile`, `address`, `positionId`, `dateAdded`)VALUES(?,?,?,?,?,?,?,?)";
		$data = array($email, $pass, $fname, $lname, $mobile, $address, 2, today());
		$this->db->query($sql, $data);
	}

	public function getCheckEmailExist($email) {
		$sql = "SELECT COUNT(email) as emailCount FROM tbl_user WHERE email = ?";
		$data = array($email);
		return $this->db->query($sql, $data);
	}

	public function getLoadAllNetwork() {
		$sql = "SELECT *, DATE_FORMAT(netDateAdded, '%b. %e %Y') AS dateAdded FROM tbl_network WHERE netIsActive = ?";
		$data = array(1);
		return $this->db->query($sql, $data);
	}

	public function getLoadAllAmounts() {
		$sql = "SELECT *, DATE_FORMAT(dateAdded, '%b. %e %Y') AS dateAdded FROM tbl_loadamount WHERE isActive = ?";
		$data = array(1);
		return $this->db->query($sql, $data);
	}

	public function getNetworkPrefix($networkId) {
		$sql = "SELECT * FROM tbl_netprefix WHERE networkId = ? AND isActive = ?";
		$data = array($networkId, 1);
		return $this->db->query($sql, $data);
	}

	public function getNetworkName($networkId) {
		$sql = "SELECT netName FROM tbl_network WHERE networkId = ? AND netIsActive = ?";
		$data = array($networkId, 1);
		return $this->db->query($sql, $data)->row()->netName;
	}

	public function getPaymentTransact($getSenderUserId, $getAmount, $getNetworkId, $getMobileNo) {
		$sql = "INSERT INTO tbl_payment(`senderUserId`, `loadAmount`, `networkId`, `paymentStatus`, `paymentDate`, `mobileno`)VALUES(?,?,?,?,?,?)";
		$data = array($getSenderUserId, $getAmount, $getNetworkId, 1, today(), $getMobileNo);
		$this->db->query($sql, $data);
	 	return $this->db->insert_id();
	}

	public function getLoadTransaction($userId) {
		$sql = "SELECT p.mobileno, p.loadAmount, n.netName, DATE_FORMAT(p.paymentDate, '%b. %e %Y') AS dateAdded
				FROM tbl_payment p 
				INNER JOIN tbl_user u ON u.userId = p.senderUserId
				INNER JOIN tbl_network n 
				ON n.networkId = p.networkId
				WHERE senderUserId = ?
				ORDER BY paymentDate DESC";
		$data = array($userId);
		return $this->db->query($sql, $data);
	}

	public function getLoadRequest($requestSearch) {

		$sql = "SELECT p.mobileno, p.loadAmount, n.netName, u.firstname, u.lastname, p.paymentId, DATE_FORMAT(p.paymentDate, '%b. %e %Y') AS dateAdded
				FROM tbl_payment p 
				INNER JOIN tbl_user u ON u.userId = p.senderUserId
				INNER JOIN tbl_network n
				ON n.networkId = p.networkId
				WHERE p.paymentStatus = 1";

		if($requestSearch != '') {
			$sql .= " AND n.netName LIKE '%$requestSearch%'
					  OR p.mobileno LIKE '%$requestSearch%' 
					  OR  p.loadAmount LIKE '%$requestSearch%' 
					  OR u.firstname LIKE '%$requestSearch%'
					  OR u.lastname LIKE '%$requestSearch%' 
					  OR DATE_FORMAT(p.paymentDate, '%b. %e %Y') LIKE '%$requestSearch%' ";
		}

		$sql .= " ORDER BY paymentDate DESC";
		// echo $sql;
		// die();
		return $this->db->query($sql);
	}

	public function getConfirmRequest($requestId) {
		$sql = "UPDATE tbl_payment SET paymentStatus = ?, completeDate = ? WHERE paymentId = ?";
		$data = array(2, today(), $requestId);
		return $this->db->query($sql, $data);
	}

	public function getLoadReqCount() {
		$sql = "SELECT COUNT(paymentId) as reqCount FROM tbl_payment WHERE paymentStatus = ?";
		$data = array(1);
		return $this->db->query($sql, $data);
	}

	public function getLoadUsers($userId, $userSearch) {
		$sql = "SELECT email, firstname, lastname, mobile, address, DATE_FORMAT(dateAdded, '%b. %e %Y') AS dateRegistered FROM tbl_user WHERE userId != ? AND isActive = 1 ";

		if($userSearch != '') {
			$sql .= " AND (firstname LIKE '%$userSearch%' 
					  OR lastname LIKE '%$userSearch%'
					  OR email LIKE '%$userSearch%'
					  OR mobile LIKE '%$userSearch%'
					  OR address LIKE '%$userSearch%'
					  OR DATE_FORMAT(dateAdded, '%b. %e %Y') LIKE '%$userSearch%')
					  ";
		}
		$data = array($userId);
		return $this->db->query($sql, $data);
	}

	public function getAddNetwork($netName) {
		$sql = "INSERT INTO tbl_network(`netName`)VALUES(?)";
		$data = array($netName);
		$this->db->query($sql, $data);
	}

	public function getEditNetwork($netName, $netId) {
		$sql = "UPDATE tbl_network SET netName = ? WHERE networkId = ?";
		$data = array($netName, $netId);
		$this->db->query($sql, $data);
	}

	public function getDeleteNetwork($deleteId) {
		$sql = "UPDATE tbl_network SET netIsActive = ? WHERE networkId = ?";
		$data = array(0, $deleteId);
		$this->db->query($sql, $data);

		$sql1 = "UPDATE tbl_netprefix SET isActive = 0 WHERE networkId = ?";
		$data1 = array($deleteId);
		$this->db->query($sql1, $data1);
	}

	public function getAddAmount($loadAmount) {
		$sql = "INSERT INTO tbl_loadamount(`loadAmount`)VALUES(?)";
		$data = array($loadAmount);
		$this->db->query($sql, $data);
	}

	public function getEditAmount($editId, $amount) {
		$sql = "UPDATE tbl_loadamount SET loadAmount = ? WHERE loadAmountId = ?";
		$data = array($amount, $editId);
		$this->db->query($sql, $data);
	}

	public function getDeleteAmount($deleteId) {
		$sql = "UPDATE tbl_loadamount SET isActive = ? WHERE loadAmountId = ?";
		$data = array(0, $deleteId);
		$this->db->query($sql, $data);
	}

	public function getLoadPrefix() {
		$sql = "SELECT np.netprefixId, np.netprefix, np.dateAdded, n.netName, n.networkId,
				DATE_FORMAT(dateAdded, '%b. %e %Y') AS dateAdded
				FROM tbl_netprefix np 
				INNER JOIN tbl_network n 
				ON n.networkId = np.networkId 
				WHERE isActive = ?";
		$data = array(1);
		return $this->db->query($sql, $data);
	}

	public function getAddPrefix($prefixName, $networkId) {
		$sql = "INSERT INTO tbl_netprefix(`netprefix`, `networkId`, `dateAdded`)VALUES(?,?,?)";
		$data = array($prefixName, $networkId, today());
		$this->db->query($sql, $data);
	}

	public function getEditPrefix($editId, $netPrefix, $netId) {
		$sql = "UPDATE tbl_netprefix SET netprefix = ?, networkId = ? WHERE netprefixId = ?";
		$data = array($netPrefix, $netId, $editId);
		$this->db->query($sql, $data);
	}

	public function getDeletePrefix($deleteId) {
		$sql = "UPDATE tbl_netprefix SET isActive = ? WHERE netprefixId = ?";
		$data = array(0, $deleteId);
		$this->db->query($sql, $data);
	}
}