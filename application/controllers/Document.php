<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Document extends CI_Controller
{

    public function index()
    {
        $data['title'] = 'Uploads Document';

        $query = $this->db->get('type'); // Mengambil data dari tabel types
        $type = $query->result();
        $data['type'] = $type; // Menambahkan data type ke array data yang akan dikirim ke view

        $query = $this->db->get('product'); // Mengambil data dari tabel product
        $product = $query->result();
        $data['product'] = $product; // Menambahkan data product ke array data yang akan dikirim ke view

        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        $this->load->view('template/header', $data);
        $this->load->view('document/index', $data); // Mengirim data kategori ke view
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

    public function uploads()
    {
        // Atur timezone ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        $type_id            = $this->input->post('type_id', true);
        $product_id         = $this->input->post('product_id', true);
        $user_id            = $this->input->post('user_id', true);
        $name               = $this->input->post('name', true);
        $description        = $this->input->post('description', true);
        $summary            = $this->input->post('summary', true);
        $keyword            = $this->input->post('keyword', true);
        $file               = $_FILES['file']['name'];
        $thumbnail          = $_FILES['thumbnail']['name'];

        // Upload file
        if ($file != '') {
            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('file')) {
                $this->session->set_flashdata('error', 'File upload failed');
                redirect('document');
            } else {
                $file = $this->upload->data('file_name');
                $this->session->set_flashdata('success', 'File uploaded successfully');
            }
        }

        // Upload thumbnail
        if ($thumbnail != '') {
            $config['upload_path']   = './uploads/thumbnail';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('thumbnail')) {
                $this->session->set_flashdata('error', 'Thumbnail upload failed');
                redirect('document');
            } else {
                $thumbnail = $this->upload->data('file_name');
                $this->session->set_flashdata('success', 'Thumbnail uploaded successfully');
            }
        }

        $data = [
            'type_id'       => $type_id,
            'product_id'    => $product_id,
            'user_id'       => $user_id,
            'name'          => $name,
            'description'   => $description,
            'summary'       => $summary,
            'file'          => $file,
            'thumbnail'     => $thumbnail,
            'keyword'       => $keyword,
            'upload_date'   => date('Y-m-d H:i:s'),
        ];

        $this->db->insert('document', $data);
        $document_id = $this->db->insert_id();  // Ambil ID dokumen yang baru saja diunggah

        // Ambil username dari session ID
        $session_user_id = $this->session->userdata('id');  // Menggunakan 'id' dari session
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('id', $session_user_id);
        $query = $this->db->get();
        $user = $query->row();

        // Simpan log ke dalam tabel upload_log
        $log_data = [
            'user_id'       => $user_id,
            'document_id'   => $document_id,
            'upload_time'   => date('Y-m-d H:i:s'),  // Menggunakan waktu Asia/Jakarta
            'message'       => $user->username . ' telah menambah dokumen baru, ' . $name,
            'is_read'       => false
        ];
        $this->db->insert('upload_log', $log_data);

        $this->session->set_flashdata('success', 'Document and thumbnail uploaded successfully');
        redirect('home');
    }

    public function view($id)
    {
        $data['title'] = "Detail Document";

        $this->db->select('document.*, type.name as type_name');
        $this->db->from('document');
        $this->db->join('type', 'type.id = document.type_id');
        $this->db->where('document.id', $id);
        $document = $this->db->get()->row();

        if ($document) {
            $filename = pathinfo($document->file, PATHINFO_FILENAME);
            $filename = preg_replace('/[_\-]+/', ' ', $filename); // Replace underscores and dashes with spaces
            $filename = preg_replace('/\d{2,4}/', '', $filename); // Remove consecutive digits
            $filename = ucwords($filename); // Capitalize each word
            $document->file_name = $filename;

            // Update or insert into user_views
            $user_id = $this->session->userdata('id'); // Assume user_id is stored in session
            $this->updateUserViews($user_id, $id);

            // Log document view
            $this->log_document_view($user_id, $id);
        }

        $data['document'] = $document;
        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        $this->load->view('template/header', $data);
        $this->load->view('document/detail', $data);
        $this->load->view('template/footer');
    }

    public function download_document($id)
    {
        $data['title'] = "Detail Document";

        $this->db->select('document.*, type.name as type_name');
        $this->db->from('document');
        $this->db->join('type', 'type.id = document.type_id');
        $this->db->where('document.id', $id);
        $document = $this->db->get()->row();

        if ($document) {
            $filename = pathinfo($document->file, PATHINFO_FILENAME);
            $filename = preg_replace('/[_\-]+/', ' ', $filename); // Replace underscores and dashes with spaces
            $filename = preg_replace('/\d{2,4}/', '', $filename); // Remove consecutive digits
            $filename = ucwords($filename); // Capitalize each word
            $document->file_name = $filename;

            // Update or insert into user_views
            $user_id = $this->session->userdata('id'); // Assume user_id is stored in session
            $this->updateUserViews($user_id, $id);

            // Log document view
            $this->log_document_view($user_id, $id);
        }

        $data['document'] = $document;
        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        $this->load->view('template/header', $data);
        $this->load->view('document/detail', $data);
        $this->load->view('template/footer');
    }

    private function log_document_view($user_id, $document_id)
    {
        // Get IP address and browser info
        $ip_address = $this->input->ip_address();
        $browser = $this->input->user_agent();

        // Insert data into database
        $this->db->insert('document_views', [
            'user_id' => $user_id,
            'document_id' => $document_id,
            'ip_address' => $ip_address
        ]);
    }

    public function log_download_view()
    {
        $input = json_decode($this->input->raw_input_stream, true);

        if (isset($input['user_id']) && isset($input['document_id']) && isset($input['ip_address'])) {
            // Insert data into database
            $this->db->insert('download_views', [
                'user_id' => $input['user_id'],
                'document_id' => $input['document_id'],
                'ip_address' => $input['ip_address']
            ]);

            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid data.']);
        }
    }

    public function log()
    {
        // Set zona waktu ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Ambil data POST dari AJAX request
        $userId = $this->input->post('user_id');
        $documentId = $this->input->post('document_id');
        $ipAddress = $this->input->ip_address(); // Ambil alamat IP pengguna

        // Simpan log download ke database
        $data = array(
            'user_id' => $userId,
            'document_id' => $documentId,
            'ip_address' => $ipAddress,
            'download_time' => date('Y-m-d H:i:s')
        );
        $this->db->insert('download_views', $data);

        // Kirim respons sukses ke AJAX
        echo json_encode(['success' => true]);
    }


    private function updateUserViews($user_id, $document_id)
    {
        $last_viewed = date('Y-m-d H:i:s'); // Get current datetime

        $this->db->where('user_id', $user_id);
        $this->db->where('document_id', $document_id);
        $query = $this->db->get('user_views');

        if ($query->num_rows() > 0) {
            // Update existing record
            $this->db->where('user_id', $user_id);
            $this->db->where('document_id', $document_id);
            $this->db->update('user_views', ['last_viewed' => $last_viewed]);
        } else {
            // Insert new record
            $this->db->insert('user_views', [
                'user_id' => $user_id,
                'document_id' => $document_id,
                'last_viewed' => $last_viewed
            ]);
        }
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

    public function update($id)
    {
        $data['title'] = "Update Document";

        $query = $this->db->get('type'); // Mengambil data dari tabel types
        $type = $query->result();
        $data['type'] = $type; // Menambahkan data type ke array data yang akan dikirim ke view

        $query = $this->db->get('product'); // Mengambil data dari tabel product
        $product = $query->result();
        $data['product'] = $product; // Menambahkan data product ke array data yang akan dikirim ke view

        $this->db->select('document.*, type.name AS type_name, product.name AS product_name');
        $this->db->from('document');
        $this->db->join('type', 'type.id = document.type_id');
        $this->db->join('product', 'product.id = document.product_id');
        $this->db->where('document.id', $id);
        $document = $this->db->get()->row();

        if ($document) {
            $filename = pathinfo($document->file, PATHINFO_FILENAME);
            $filename = preg_replace('/[_\-]+/', ' ', $filename); // Mengganti semua underscore dan dash dengan spasi
            $filename = preg_replace('/\d{2,4}/', '', $filename); // Menghapus angka yang muncul berurutan
            $filename = ucwords($filename); // Kapitalisasi setiap kata
            $document->file_name = $filename;

            // Menambahkan tipe dokumen
            $document->file_type = pathinfo($document->file, PATHINFO_EXTENSION);

            $filePath = './uploads/' . $document->file;
            if (file_exists($filePath)) {
                $document->file_size = $this->formatSizeUnits(filesize($filePath));
            } else {
                $document->file_size = '-';
            }
        }

        $data['document'] = $document;
        $data['logs'] = $this->get_upload_logs();
        $data['read_logs'] = $this->get_user_read_logs();

        $this->load->view('template/header', $data);
        $this->load->view('document/update', $data);
        $this->load->view('template/footer');
    }

    public function update_process()
    {
        $document_id = $this->input->post('document_id', true);
        $type_id     = $this->input->post('type_id', true);
        $product_id  = $this->input->post('product_id', true);
        $user_id     = $this->input->post('user_id', true);
        $name        = $this->input->post('name', true);
        $description = $this->input->post('description', true);
        $summary     = $this->input->post('summary', true);
        $keyword     = $this->input->post('keyword', true);

        // Mengatur zona waktu ke Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Mengambil file dan thumbnail saat ini dari database
        $document = $this->db->get_where('document', ['id' => $document_id])->row();

        // Load library upload
        $this->load->library('upload');

        // Periksa apakah ada file baru yang diunggah
        if (!empty($_FILES['file']['name'])) {
            $config['upload_path']   = './uploads';
            $config['allowed_types'] = 'pdf';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('file')) {
                $this->session->set_flashdata('error', 'File upload failed');
                redirect('document');
            } else {
                // Hapus file lama jika ada
                if (file_exists('./uploads/' . $document->file)) {
                    unlink('./uploads/' . $document->file);
                }
                $file = $this->upload->data('file_name');
                $this->session->set_flashdata('success', 'File uploaded successfully');
            }
        } else {
            $file = $document->file; // Tetap menggunakan file yang lama jika tidak ada file baru
        }

        // Periksa apakah ada thumbnail baru yang diunggah
        if (!empty($_FILES['thumbnail']['name'])) {
            $config['upload_path']   = './uploads/thumbnail';
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('thumbnail')) {
                $this->session->set_flashdata('error', 'Thumbnail upload failed');
                redirect('document');
            } else {
                // Hapus thumbnail lama jika ada
                if (file_exists('./uploads/thumbnail/' . $document->thumbnail)) {
                    unlink('./uploads/thumbnail/' . $document->thumbnail);
                }
                $thumbnail = $this->upload->data('file_name');
                $this->session->set_flashdata('success', 'Thumbnail uploaded successfully');
            }
        } else {
            $thumbnail = $document->thumbnail; // Tetap menggunakan thumbnail yang lama jika tidak ada thumbnail baru
        }

        // Membuat array data yang diperbarui
        $data = [
            'type_id'       => $type_id,
            'product_id'    => $product_id,
            'user_id'       => $user_id,
            'name'          => $name,
            'description'   => $description,
            'summary'       => $summary,
            'file'          => $file,
            'thumbnail'     => $thumbnail,
            'keyword'       => $keyword,
        ];

        // Memperbarui data di database
        $this->db->where('id', $document_id);
        $this->db->update('document', $data);

        // Insert ke tabel upload_log
        $session_user_id = $this->session->userdata('id'); // Menggunakan 'id' dari session
        $this->db->select('username');
        $this->db->from('users');
        $this->db->where('id', $session_user_id);
        $query = $this->db->get();
        $user = $query->row();

        // Simpan log ke dalam tabel upload_log
        $log_data = [
            'user_id'       => $user_id,
            'document_id'   => $document_id,
            'upload_time'   => date('Y-m-d H:i:s'), // Menggunakan waktu Asia/Jakarta
            'message'       => $user->username . ' telah memperbarui dokumen, ' . $name,
            'is_read'       => false
        ];
        $this->db->insert('upload_log', $log_data);

        // Mengatur pesan sukses dan mengarahkan kembali ke halaman home
        $this->session->set_flashdata('success', 'Document updated successfully');
        redirect('home');
    }


    public function remove($id)
    {
        // Mengambil data file berdasarkan document id
        $this->db->select('file, thumbnail');
        $this->db->from('document');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $document = $query->row();

        if ($document) {
            // Hapus file utama
            $filePath = './uploads/' . $document->file;
            if (file_exists($filePath)) {
                unlink($filePath); // Menghapus file dari server
            }

            // Hapus thumbnail jika ada
            if (!empty($document->thumbnail)) {
                $thumbnailPath = './uploads/thumbnail/' . $document->thumbnail;
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath); // Menghapus thumbnail dari server
                }
            }

            // Menghapus data dari database
            $this->db->where('id', $id);
            $this->db->delete('document');

            $this->session->set_flashdata('success', 'Document deleted successfully');
        } else {
            $this->session->set_flashdata('error', 'Document not found');
        }

        redirect('home');
    }


    public function get_documents()
    {
        // Ambil semua jenis type
        $query = $this->db->get('type');
        $types = $query->result();

        // Ambil user_id dari session
        $user_id = $this->session->userdata('id');

        // Query untuk mengambil dokumen terbaru yang dilihat oleh user berdasarkan type
        $this->db->select('document.*, type.id as type_id, type.name as type_name, product.id as product_id, product.name as product_name, users.username as upload_name, user_views.last_viewed');
        $this->db->from('document');
        $this->db->join('type', 'type.id = document.type_id', 'left');
        $this->db->join('product', 'product.id = document.product_id', 'left');
        $this->db->join('users', 'users.id = document.user_id', 'left');
        $this->db->join('user_views', 'user_views.document_id = document.id AND user_views.user_id = ' . $user_id, 'left');
        $this->db->order_by('user_views.last_viewed', 'DESC'); // Urutkan berdasarkan last_viewed secara descending
        $documents = $this->db->get()->result();

        // Proses pengolahan filename untuk setiap dokumen
        foreach ($documents as &$doc) {
            $filename = pathinfo($doc->file, PATHINFO_FILENAME);
            $filename = preg_replace('/[_\-]+/', ' ', $filename); // Mengganti semua underscore dan dash dengan spasi
            $filename = preg_replace('/\d{2,4}/', '', $filename); // Menghapus angka yang muncul berurutan
            $filename = ucwords($filename); // Kapitalisasi setiap kata

            // Simpan filename yang telah diolah ke dalam objek dokumen
            $doc->filename_processed = $filename;
        }

        // Siapkan data untuk dikirim sebagai JSON
        $data = array(
            'types' => $types,
            'documents' => $documents
        );

        // Kirim data dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($data);
    }


    // public function search_documents()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $type_id = $this->input->post('type_id', true);

    //     // Escape dan sesuaikan format keyword
    //     $keyword = $this->db->escape_like_str($keyword);
    //     $keyword = str_replace(['_', '-'], ' ', $keyword);

    //     // Query untuk mendapatkan dokumen berdasarkan keyword dan jenis dokumen
    //     $sql = "SELECT document.id as document_id, document.description, document.summary, document.thumbnail, document.upload_date, document.name as document_name, file, type.name as work_type
    //     FROM document
    //     JOIN type ON type.id = document.type_id
    //     WHERE 1=1"; // Kondisi awal

    //     // Tambahkan kondisi untuk pencarian berdasarkan keyword
    //     if (!empty($keyword)) {
    //         $sql .= " AND (REPLACE(REPLACE(document.name, '_', ' '), '-', ' ') LIKE '%$keyword%' 
    //          OR REPLACE(REPLACE(file, '_', ' '), '-', ' ') LIKE '%$keyword%')";
    //     }

    //     // Tambahkan kondisi untuk jenis dokumen tertentu jika dipilih
    //     if ($type_id != 'all') {
    //         $type_id = $this->db->escape_str($type_id);
    //         $sql .= " AND type.id = '$type_id'";
    //     }

    //     // Eksekusi query dan ambil hasilnya
    //     $query = $this->db->query($sql);

    //     // Format hasil query ke dalam array dokumen yang akan di-encode ke JSON
    //     $documents = [];
    //     foreach ($query->result() as $row) {
    //         $filename = pathinfo($row->file, PATHINFO_FILENAME);
    //         $filename = preg_replace('/[_\-]+/', ' ', $filename);
    //         $filename = preg_replace('/\d{2,4}/', '', $filename);
    //         $filename = ucwords($filename);
    //         $documents[] = [
    //             'document_id' => $row->document_id,
    //             'name' => $row->document_name,
    //             'label' => $filename,
    //             'value' => $row->document_id,
    //             'description' => $row->description,
    //             'summary' => $row->summary,
    //             'thumbnail' => $row->thumbnail,
    //             'upload_date' => $row->upload_date,
    //             'work_type' => $row->work_type
    //         ];
    //     }

    //     // Encode array dokumen ke dalam format JSON dan kirimkan sebagai respons
    //     echo json_encode($documents);
    // }

    public function search_documents()
    {
        $keyword = $this->input->post('keyword', true);
        $type_id = $this->input->post('type_id', true);

        // Escape dan sesuaikan format keyword
        $keyword = $this->db->escape_like_str($keyword);
        $keyword = str_replace(['_', '-'], ' ', $keyword);

        // Ambil user_id dan role dari session
        $user_id = $this->session->userdata('id');
        $role = $this->session->userdata('role');

        // Query untuk mendapatkan dokumen berdasarkan keyword dan jenis dokumen
        $sql = "SELECT 
                document.id as document_id, 
                document.description, 
                document.summary, 
                document.thumbnail, 
                document.upload_date, 
                document.name as document_name, 
                file, 
                type.name as work_type
            FROM 
                document
            JOIN 
                type ON type.id = document.type_id";

        // Tambahkan join untuk memeriksa izin pengguna pada dokumen jika role adalah user (2)
        if ($role == 2) {
            $sql .= " INNER JOIN user_document_permissions 
                  ON user_document_permissions.document_id = document.id 
                  AND user_document_permissions.user_id = $user_id";
        }

        $sql .= " WHERE 1=1"; // Kondisi awal

        // Tambahkan kondisi untuk pencarian berdasarkan keyword
        if (!empty($keyword)) {
            $sql .= " AND (REPLACE(REPLACE(document.name, '_', ' '), '-', ' ') LIKE '%$keyword%' 
                 OR REPLACE(REPLACE(file, '_', ' '), '-', ' ') LIKE '%$keyword%')";
        }

        // Tambahkan kondisi untuk jenis dokumen tertentu jika dipilih
        if ($type_id != 'all') {
            $type_id = $this->db->escape_str($type_id);
            $sql .= " AND type.id = '$type_id'";
        }

        // Eksekusi query dan ambil hasilnya
        $query = $this->db->query($sql);

        // Format hasil query ke dalam array dokumen yang akan di-encode ke JSON
        $documents = [];
        foreach ($query->result() as $row) {
            $filename = pathinfo($row->file, PATHINFO_FILENAME);
            $filename = preg_replace('/[_\-]+/', ' ', $filename);
            $filename = preg_replace('/\d{2,4}/', '', $filename);
            $filename = ucwords($filename);
            $documents[] = [
                'document_id' => $row->document_id,
                'name' => $row->document_name,
                'label' => $filename,
                'value' => $row->document_id,
                'description' => $row->description,
                'summary' => $row->summary,
                'thumbnail' => $row->thumbnail,
                'upload_date' => $row->upload_date,
                'work_type' => $row->work_type
            ];
        }

        // Encode array dokumen ke dalam format JSON dan kirimkan sebagai respons
        echo json_encode($documents);
    }
}
