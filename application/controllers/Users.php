<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Users Management';

        // Mengambil data log upload dan baca
        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        // Mengambil data pengguna dan perannya
        $this->db->select('users.id, users.username, users.role');
        $this->db->where('users.role', 2);
        $data['users'] = $this->db->get('users')->result();

        $this->load->view('template/header', $data);
        $this->load->view('users/index', $data);
        $this->load->view('template/footer');
    }

    public function permissions($user_id)
    {
        $data['title'] = 'User Permissions';

        // Mengambil data log upload dan baca
        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        // Mengambil data izin pengguna, pastikan 'id' termasuk dalam hasil query
        $this->db->select('user_document_permissions.*, user_document_permissions.user_id, user_document_permissions.document_id, user_document_permissions.status, document.name as document_title');
        $this->db->from('user_document_permissions');
        $this->db->join('document', 'document.id = user_document_permissions.document_id', 'left');
        $this->db->where('user_document_permissions.user_id', $user_id);
        $data['permissions'] = $this->db->get()->result();


        // Mengambil informasi pengguna
        $data['user'] = $this->db->get_where('users', array('id' => $user_id))->row();

        $this->load->view('template/header', $data);
        $this->load->view('users/permissions', $data);
        $this->load->view('template/footer');
    }

    public function view_add_permission()
    {
        $data['title'] = 'Add Permissions';

        // Mengambil data log upload dan baca
        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        // Mengambil daftar pengguna dari tabel users dengan role 2
        $this->db->where('role', 2);
        $data['users'] = $this->db->get('users')->result();

        // Mengambil daftar dokumen
        $data['document'] = $this->db->get('document')->result();

        $this->load->view('template/header', $data);
        $this->load->view('users/form', $data);
        $this->load->view('template/footer');
    }

    public function process_add_permission()
    {
        $user_id = $this->input->post('user_id');
        $document_id = $this->input->post('document_id');

        // Validasi user_id
        $user_exists = $this->db->where('id', $user_id)->get('users')->num_rows();

        if ($user_exists > 0) {
            // Simpan izin baru ke dalam tabel user_document_permissions
            $data = array(
                'user_id' => $user_id,
                'document_id' => $document_id,
                'status' => 'open' // Default status 'open'
                // Tambahkan field lain yang perlu disimpan
            );

            // Lakukan penyimpanan ke database
            $this->db->insert('user_document_permissions', $data);

            // Redirect ke halaman permissions setelah proses selesai
            redirect('users/permissions/' . $user_id);
        } else {
            // Tampilkan pesan error atau langkah lain sesuai kebutuhan aplikasi
            echo "User ID not found or invalid.";
        }
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
