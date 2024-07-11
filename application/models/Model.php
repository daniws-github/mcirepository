<?php

class Model extends CI_Model
{

    public function get($table)
    {
        return $this->db->get($table);
    }

    public function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update($table, $data, $where)
    {
        $this->db->update($table, $data, $where);
    }

    public function delete($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function get_login()
    {
        $email        = set_value('email');
        $password        = set_value('password');

        $result = $this->db->where('email', $email)
            ->where('password', md5($password))
            ->limit(1)
            ->get('users');
        if ($result->num_rows() > 0) {
            return $result->row();
        } else {
            return FALSE;
        }
    }
}
