<?php
class catalog_model extends CI_Model
{

    function show_catalog()
    {
        return $this->db->get('mahasiswa');
    }

    function edit_data($where, $table)
    {
        return $this->db->get_where($table, $where);
    }
    function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $query = $this->db->update($table, $data);
        if ($query) {
            redirect('mahasiswa/index');
        } else {
            echo "Tidak Berhasil";
        }
    }
    function insert_data($data)
    {
        $this->db->insert('katalog_produk', $data);
    }
}
