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
		$sql = "SELECT * FROM tbl_network WHERE netIsActive = ?";
		$data = array(1);
		return $this->db->query($sql, $data);
	}

	public function getLoadAllAmounts() {
		$sql = "SELECT * FROM tbl_loadamount WHERE isActive = ?";
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
				WHERE paymentStatus = 1";

		if($requestSearch != '') {
			$sql .= " AND mobileno = '%$requestSearch%' ";
		}

		$sql .= " ORDER BY paymentDate DESC";
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
}