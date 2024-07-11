<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Login Page';
			$data['email'] = $this->input->post('email'); // Menambahkan ini
			$this->load->view('login', $data);
		} else {
			$email = $this->input->post('email', TRUE); // TRUE for XSS cleaning
			$password = $this->input->post('password', TRUE);

			// Ambil data pengguna berdasarkan email
			$query = $this->db->get_where('users', ['email' => $email]);
			$user = $query->row();

			if ($user && $user->password === md5($password)) { // Verifikasi password dengan MD5
				// Set session data
				$this->session->set_userdata([
					'username' => $user->username,
					'email'    => $user->email,
					'id'       => $user->id,
					'role'     => $user->role
				]);

				// Catat log ke database (Success)
				$this->log_login($user->id, $user->email, 'Success');

				// Redirect to home
				redirect('home');
			} else {
				// Simpan email ke flashdata
				$this->session->set_flashdata('email', $email);

				// Ambil ID pengguna berdasarkan email untuk catatan log
				$user_id = $this->get_user_id_by_email($email);

				// Catat log ke database (Fail)
				$this->log_login($user_id, $email, 'Fail');

				// Redirect back to login with error
				$this->session->set_flashdata('error', 'Invalid Email or Password');
				redirect('login');
			}
		}
	}

	private function log_login($user_id, $email, $status)
	{
		// Ambil IP address dan browser
		$ip_address = $this->input->ip_address();
		$browser = $this->input->user_agent();

		// Set the default timezone to Asia/Jakarta
		date_default_timezone_set('Asia/Jakarta');

		// Masukkan data ke dalam database
		$this->db->insert('login_logs', [
			'user_id' => $user_id,
			'email' => $email,
			'login_time' => date('Y-m-d H:i:s'),
			'ip_address' => $ip_address,
			'browser' => $browser,
			'status' => $status
		]);
	}

	private function get_user_id_by_email($email)
	{
		// Ambil user_id berdasarkan email dari tabel users
		$query = $this->db->get_where('users', ['email' => $email]);
		$user = $query->row();

		if ($user) {
			return $user->id;
		} else {
			return null; // atau nilai default jika email tidak ditemukan
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('success', 'You have successfully logged out.');
		redirect('login');
	}

	public function login_history()
	{
		$data['title'] = 'Log Tracking';

		// Ambil semua data log dari tabel login_logs dan gabungkan dengan tabel users
		$this->db->select('login_logs.*, users.username');
		$this->db->from('login_logs');
		$this->db->join('users', 'login_logs.user_id = users.id', 'left'); // Gabungkan dengan tabel users
		$this->db->order_by('login_time', 'desc'); // Urutkan berdasarkan waktu login terbaru
		$query = $this->db->get();
		$login_history = $query->result();

		// Ambil semua data log dari tabel view document dan gabungkan dengan tabel users
		$this->db->select('document_views.*, document.name AS doc_name, users.username');
		$this->db->from('document_views');
		$this->db->join('document', 'document_views.document_id = document.id', 'left'); // Gabungkan dengan tabel document
		$this->db->join('users', 'document_views.user_id = users.id', 'left'); // Gabungkan dengan tabel users
		$this->db->order_by('document_views.view_time', 'desc'); // Urutkan berdasarkan waktu login terbaru
		$query = $this->db->get();
		$view_document = $query->result();

		// Ambil semua data log dari tabel download document dan gabungkan dengan tabel users
		$this->db->select('download_views.*, download_views.download_time AS donwnloadtime , document.name AS doc_name, users.username');
		$this->db->from('download_views');
		$this->db->join('document', 'download_views.document_id = document.id', 'left'); // Gabungkan dengan tabel document
		$this->db->join('users', 'download_views.user_id = users.id', 'left'); // Gabungkan dengan tabel users
		$this->db->order_by('download_views.download_time', 'desc'); // Urutkan berdasarkan waktu login terbaru
		$query = $this->db->get();
		$download_document = $query->result();

		// Kirim data ke view
		$data['login_history'] = $login_history;
		$data['view_document'] = $view_document;
		$data['download_document'] = $download_document;

		// notif
		$data['logs'] = $this->get_upload_logs();
		$data['read_logs'] = $this->get_user_read_logs();

		// Load view dengan data yang sudah disiapkan
		$this->load->view('template/header', $data);
		$this->load->view('history_log/index', $data);
		$this->load->view('template/footer');
	}

	// Method untuk menandai notifikasi sebagai sudah dibaca
	public function readnotif()
	{
		$log_id = $this->input->post('log_id');
		$user_id = $this->session->userdata('id'); // Ambil user ID dari session

		// Update status is_read hanya untuk notifikasi milik user yang sedang login
		$data = array(
			'log_id' => $log_id,
			'user_id' => $user_id
		);

		$this->db->insert('user_read_logs', $data);

		echo json_encode(['status' => 'success']);
	}

	// Method untuk mengambil semua log
	public function get_upload_logs()
	{
		$this->db->select('upload_log.*, users.username, document.name as document_name');
		$this->db->from('upload_log');
		$this->db->join('users', 'upload_log.user_id = users.id');
		$this->db->join('document', 'upload_log.document_id = document.id');
		$this->db->order_by('upload_time', 'DESC');
		$this->db->limit(10);
		$query = $this->db->get();
		return $query->result();
	}

	// Method untuk mengambil log yang sudah dibaca oleh pengguna yang sedang login
	public function get_user_read_logs()
	{
		$user_id = $this->session->userdata('id');
		$this->db->select('log_id');
		$this->db->from('user_read_logs');
		$this->db->where('user_id', $user_id);
		$query = $this->db->get();
		return array_column($query->result_array(), 'log_id');
	}
}
