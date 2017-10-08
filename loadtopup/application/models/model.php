<?php 
class Model extends CI_Model {
	public function getLogin($email, $pass) {
		$sql = "SELECT email, firstname, lastname, mobile FROM tbl_user WHERE email = ? AND password = ? LIMIT 1";
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
}