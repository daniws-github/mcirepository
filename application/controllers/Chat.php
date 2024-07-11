<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chat extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'MCI Assistant';

        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        $this->load->view('chatbot/index', $data);
    }

    public function chatbot()
    {
        $data['title'] = 'MCI Chatbot';

        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        $this->load->view('chatbot/chatbot', $data);
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
