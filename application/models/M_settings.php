<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_settings extends CI_Model
{
    private $table = 'settings';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get all settings
     * @return array
     */
    public function get_all_settings()
    {
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Get settings with pagination
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function get_settings_paginated($limit = 10, $offset = 0)
    {
        $this->db->limit($limit, $offset);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Count total settings
     * @return int
     */
    public function count_all_settings()
    {
        return $this->db->count_all($this->table);
    }

    /**
     * Get settings by search
     * @param string $search
     * @return array
     */
    public function search_settings($search)
    {
        $this->db->like('name', $search);
        $this->db->or_like('company', $search);
        $this->db->or_like('description', $search);
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get($this->table);
        return $query->result();
    }

    /**
     * Insert new setting
     * @param array $data
     * @return bool
     */
    public function insert_setting($data)
    {
        // Add timestamp if not exists
        if (!isset($data['created_at'])) {
            $data['created_at'] = date('Y-m-d H:i:s');
        }
        if (!isset($data['updated_at'])) {
            $data['updated_at'] = date('Y-m-d H:i:s');
        }

        return $this->db->insert($this->table, $data);
    }

    /**
     * Get setting by ID
     * @param int $id
     * @return object|null
     */
    public function get_setting_by_id($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Get setting by key/name
     * @param string $key
     * @return object|null
     */
    public function get_setting_by_key($key)
    {
        $this->db->where('name', $key);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Update setting by ID
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update_setting($id, $data)
    {
        // Add updated timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Update setting by key
     * @param string $key
     * @param array $data
     * @return bool
     */
    public function update_setting_by_key($key, $data)
    {
        // Add updated timestamp
        $data['updated_at'] = date('Y-m-d H:i:s');

        $this->db->where('name', $key);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete setting by ID
     * @param int $id
     * @return bool
     */
    public function delete_setting($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Check if setting exists
     * @param int $id
     * @return bool
     */
    public function setting_exists($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Check if setting key exists
     * @param string $key
     * @param int $exclude_id
     * @return bool
     */
    public function setting_key_exists($key, $exclude_id = null)
    {
        $this->db->where('name', $key);
        if ($exclude_id) {
            $this->db->where('id !=', $exclude_id);
        }
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Get system configuration as key-value pairs
     * @return array
     */
    public function get_config_array()
    {
        $this->db->select('name, value, company, address, telepon, email, logo, description');
        $query = $this->db->get($this->table);
        $result = $query->result();

        $config = array();
        foreach ($result as $row) {
            // Use name as key if available, otherwise use other fields
            if (!empty($row->name)) {
                $config[$row->name] = $row;
            }
        }

        return $config;
    }

    /**
     * Get main system settings (first record or by specific criteria)
     * @return object|null
     */
    public function get_main_settings()
    {
        $this->db->order_by('id', 'ASC');
        $this->db->limit(1);
        $query = $this->db->get($this->table);
        return $query->row();
    }

    /**
     * Batch update settings
     * @param array $batch_data
     * @return bool
     */
    public function batch_update_settings($batch_data)
    {
        $this->db->trans_start();

        foreach ($batch_data as $data) {
            if (isset($data['id'])) {
                $id = $data['id'];
                unset($data['id']);
                $data['updated_at'] = date('Y-m-d H:i:s');
                $this->db->where('id', $id);
                $this->db->update($this->table, $data);
            }
        }

        $this->db->trans_complete();
        return $this->db->trans_status();
    }
}
