<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model(array('Model'));

        // Cek jika role bukan '1' dan juga bukan '2'
        if ($this->session->userdata('role') != '1' && $this->session->userdata('role') != '2') {
            redirect('login');
        }
    }

    // public function index()
    // {
    //     // Ambil semua jenis type
    //     $query = $this->db->get('type');
    //     $types = $query->result();

    //     // Ambil user_id dan role dari session
    //     $user_id = $this->session->userdata('id');
    //     $role = $this->session->userdata('role');

    //     $documents_by_type = [];

    //     // Loop through each type to get up to 6 latest documents for each type
    //     foreach ($types as $type) {
    //         $this->db->select('document.*, type.id as type_id, type.name as type_name, product.id as product_id, product.name as product_name, users.username as upload_name, user_views.last_viewed');
    //         $this->db->from('document');
    //         $this->db->join('type', 'type.id = document.type_id', 'left');
    //         $this->db->join('product', 'product.id = document.product_id', 'left');
    //         $this->db->join('users', 'users.id = document.user_id', 'left');
    //         $this->db->join('user_views', 'user_views.document_id = document.id AND user_views.user_id = ' . $user_id, 'left');

    //         if ($role == 2) {
    //             // Jika role adalah user (2), tambahkan join untuk memeriksa izin pengguna pada dokumen
    //             $this->db->join('user_document_permissions', 'user_document_permissions.document_id = document.id AND user_document_permissions.user_id = ' . $user_id . ' AND user_document_permissions.status = "open"', 'inner');
    //         }

    //         $this->db->where('document.type_id', $type->id);
    //         $this->db->order_by('user_views.last_viewed', 'DESC'); // Urutkan berdasarkan last_viewed secara descending
    //         $this->db->limit(6); // Tambahkan limit
    //         $documents_by_type[$type->id] = $this->db->get()->result();
    //     }

    //     // Siapkan data untuk dikirim ke view
    //     $data['title'] = 'Homepage';
    //     $data['types'] = $types;
    //     $data['documents_by_type'] = $documents_by_type;

    //     $data['logs'] = $this->get_upload_logs();
    //     $data['read_logs'] = $this->get_user_read_logs();

    //     // Load view dengan data yang sudah disiapkan
    //     $this->load->view('template/header', $data);
    //     $this->load->view('home', $data);
    //     $this->load->view('template/footer');
    // }

    public function index()
    {
        // Ambil semua jenis type
        $query = $this->db->get('type');
        $types = $query->result();

        // Ambil user_id dan role dari session
        $user_id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        $documents_by_type = [];

        // Loop through each type to get up to 5 latest documents for each type
        foreach ($types as $type) {
            $this->db->select('document.*, type.id as type_id, type.name as type_name, product.id as product_id, product.name as product_name, users.username as upload_name, user_views.last_viewed');
            $this->db->from('document');
            $this->db->join('type', 'type.id = document.type_id', 'left');
            $this->db->join('product', 'product.id = document.product_id', 'left');
            $this->db->join('users', 'users.id = document.user_id', 'left');
            $this->db->join('user_views', 'user_views.document_id = document.id AND user_views.user_id = ' . $user_id, 'left');

            if ($role == 2) {
                // Jika role adalah user (2), tambahkan join untuk memeriksa izin pengguna pada dokumen
                $this->db->join('user_document_permissions', 'user_document_permissions.document_id = document.id AND user_document_permissions.user_id = ' . $user_id . ' AND user_document_permissions.status = "open"', 'inner');
            }

            $this->db->where('document.type_id', $type->id);
            $this->db->order_by('user_views.last_viewed', 'DESC'); // Urutkan berdasarkan last_viewed secara descending
            $documents_by_type[$type->id] = $this->db->get()->result();

            // Batasi jumlah dokumen yang dikirim ke view
            if (count($documents_by_type[$type->id]) > 6) {
                $documents_by_type[$type->id] = array_slice($documents_by_type[$type->id], 0, 6);
            }
        }

        // Siapkan data untuk dikirim ke view
        $data['title'] = 'Homepage';
        $data['types'] = $types;
        $data['documents_by_type'] = $documents_by_type;

        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        // Load view dengan data yang sudah disiapkan
        $this->load->view('template/header', $data);
        $this->load->view('home', $data);
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
        $this->db->limit(5);
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

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' bytes';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' byte';
        } else {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
