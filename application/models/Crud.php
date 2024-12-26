<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

    // Check if the user exists in the database
    public function userLoginAuth($email, $password) {
        $this->db->where('email', $email);
        $this->db->where('status', '1');
        $query = $this->db->get('login');

        // Check if user exists
        if ($query->num_rows() > 0) {
            $user = $query->row_array();
            // If user exists and password matches (using password_verify)
            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

	/** ------------------------------User Management---------------------------- */
    // Get user management data
	public function get_user_management_data()
	{
		$query = $this->db->select('*')->from('login')->get();
		return $query->result_array();
	}

    // Add new user
	public function insert_user($data)
	{
		$this->db->insert('login', $data);
		return $this->db->affected_rows();
	}

    // Update user
	public function edit_user($data)
	{
		$this->db->where('id', $data["id"]);
		$this->db->update('login', $data);
		return $this->db->affected_rows();
	}

    // Delete user
	public function delete_user($userId)
	{
		$this->db->where('id', $userId);
		$this->db->delete('login');

		$this->db->where('user_id', $userId);
    	$query = $this->db->get('user_permissions');

		// If userId exists, delete the user from user_permissions table
		if ($query->num_rows() > 0) {
			$this->db->where('user_id', $userId);
			$this->db->delete('user_permissions');
		}

        return true;
	}
    
	// Get user permissions 
	public function get_user_permissions($userId) {
        $this->db->where('user_id', $userId);
        return $this->db->get('user_permissions')->result();
    }

	// Get user permissions of a particular user id
	public function get_user_login_permissions($userId) {
		$this->db->where('user_id', $userId);
		return $this->db->get('user_permissions')->result_array();
	}

	// Update user permissions of a particular user
    public function update_user_permissions($userId, $permissions) {
        // Remove old permissions
        $this->db->where('user_id', $userId);
   		$this->db->delete('user_permissions');

        // Insert new permissions
        foreach ($permissions as $menu => $perm) {
			$data = array(
				'user_id' => $userId,
				'permission' => $menu,
				'add' => isset($perm['add']) ? 1 : 0,
				'view' => isset($perm['view']) ? 1 : 0,
				'edit' => isset($perm['edit']) ? 1 : 0,
				'delete' => isset($perm['delete']) ? 1 : 0
			);
			$this->db->insert('user_permissions', $data);
		}

        return true;
    }

	/** ------------------------------Mobile Management---------------------------- */
	// Get mobile management data
	public function get_mobile_management_data()
	{
		$query = $this->db->select('*')->from('mobile_management')->get();
		return $query->result_array();
	}

    // Add new mobile
	public function insert_mobile($data)
	{
		$this->db->insert('mobile_management', $data);
		return $this->db->affected_rows();
	}

    // Update mobile
	public function edit_mobile($data)
	{
		$this->db->where('id', $data["id"]);
		$this->db->update('mobile_management', $data);
		return $this->db->affected_rows();
	}

	/** --------------------------Delete Common Function---------------------------- */
    // Delete common function
	public function deleteCommonFunction($userId, $tableName)
	{
		$this->db->where('id', $userId);
		$this->db->delete($tableName);
        return true;
	}

	/** --------------------------Social Media Accounts in Mobile---------------------------- */
	// Fetch social media accounts
	public function fetch_social_media_accounts($table) {
		$this->db->where('availability', 1);
		$query = $this->db->get($table);
		$output = '<option value="">Select Account</option>';
		foreach ($query->result() as $row) {
			$output .= '<option value="' . $row->account_id . '">' . $row->account_id . '</option>';
		}
		return $output;
	}
	
	// Get all saved social media accounts
	public function get_saved_social_media_accounts($mobileId) {
		if (!empty($mobileId)) {
            $this->db->select('platform, app_series, account');
            $this->db->from('social_media_accounts');
            $this->db->where('mobile_id', $mobileId);
            $query = $this->db->get();

            // If records are found, return them
            if ($query->num_rows() > 0) {
                return $query->result_array();
            } else {
                return [];
            }
        } else {
            return [];
        }
	}

	// Save the social media account in the mobile
	public function save_social_media_account($data) {
		if($data['platform'] == 'facebook') {
			$this->db->where('account_id', $data['account']);
			$this->db->update('fb_account_management', ['availability' => 0]);
		}

		$this->db->insert('social_media_accounts', $data);

        return true;
	}

	// Update the social media account in the mobile
	public function update_social_media_account($data, $accountId) {
		if($accountId != $data['account']) {
			$this->db->where('account_id', $accountId);
			$this->db->update('fb_account_management', ['availability' => 1]);
		}

		if($data['platform'] == 'facebook') {
			$this->db->where('account_id', $data['account']);
			$this->db->update('fb_account_management', ['availability' => 0]);
		}
		$this->db->where('account', $accountId);
		$this->db->update('social_media_accounts', $data);

        return true;
	}

	// Delete the social media account from the mobile
	public function delete_social_media_account($accountId, $platform) {
		$this->db->where('account', $accountId);
		$this->db->where('platform', $platform);
		$this->db->delete('social_media_accounts');

		if($platform == 'facebook') {
			$this->db->where('account_id', $accountId);
			$this->db->update('fb_account_management', ['availability' => 1]);
		}

        return true;
	}

	/** ------------------------------Facebook Management---------------------------- */
	// Get facebook management data
	public function get_facebook_account_data()
	{
		$query = $this->db->select('*')->from('fb_account_management')->get();
		return $query->result_array();
	}

    // Add new facebook
	public function insert_fb_account($data)
	{
		$this->db->insert('fb_account_management', $data);
		return $this->db->affected_rows();
	}

    // Update facebook
	public function edit_fb_account($data)
	{
		$this->db->where('id', $data["id"]);
		$this->db->update('fb_account_management', $data);
		return $this->db->affected_rows();
	}

	// Get all acounts count
	public function get_all_accounts_count() {
		$query = $this->db->query("
			SELECT 
				SUM(CASE WHEN platform = 'facebook' THEN 1 ELSE 0 END) AS facebook_count,
				SUM(CASE WHEN platform = 'instagram' THEN 1 ELSE 0 END) AS instagram_count,
				SUM(CASE WHEN platform = 'twitter' THEN 1 ELSE 0 END) AS twitter_count,
				SUM(CASE WHEN platform = 'youtube' THEN 1 ELSE 0 END) AS youtube_count,
				SUM(CASE WHEN platform = 'tiktok' THEN 1 ELSE 0 END) AS tiktok_count,
				SUM(CASE WHEN platform = 'whatsApp' THEN 1 ELSE 0 END) AS whatsapp_count
			FROM social_media_accounts
		");
		
		return $query->row_array();
	}

	/** ------------------------------Facebook Group Management---------------------------- */
	// Get facebook group data
	public function get_facebook_group_data()
	{
		$query = $this->db->select('*')->from('fb_group_management')->get();
		return $query->result_array();
	}

    // Add new facebook
	public function insert_facebook_group($data)
	{
		$this->db->insert('fb_group_management', $data);
		return $this->db->affected_rows();
	}

    // Update facebook
	public function edit_facebook_group($data)
	{
		$this->db->where('id', $data["id"]);
		$this->db->update('fb_group_management', $data);
		return $this->db->affected_rows();
	}

	// Fetch all social media accounts
	public function fetch_all_facebook_account_details($search) {
		$query = $this->db->select('name, id')
                          ->from('fb_account_management');

		if (!empty($search)) {
            $this->db->like('id', $search);
            $this->db->or_like('name', $search);
        }

        $query = $this->db->get();
        return $query->result();
	}

	/** ------------------------------Facebook Page Management---------------------------- */
	// Get facebook page data
	public function get_facebook_page_data()
	{
		$query = $this->db->select('*')->from('fb_page_management')->get();
		return $query->result_array();
	}

    // Add new facebook page
	public function insert_facebook_page($data)
	{
		$this->db->insert('fb_page_management', $data);
		return $this->db->affected_rows();
	}

    // Update facebook page
	public function edit_facebook_page($data)
	{
		$this->db->where('id', $data["id"]);
		$this->db->update('fb_page_management', $data);
		return $this->db->affected_rows();
	}

	/** ------------------------------Facebook Profile Management---------------------------- */
	// Get facebook profile data
	public function get_facebook_profile_data()
	{
		$this->db->select('fpm.*, fam.id, fam.name, fam.account_id, fam.gender, fam.religion, fam.cast, fam.location, fam.city, fam.state');

		$this->db->from('fb_account_management AS fam');

		// Join with fb_profile_management table
		$this->db->join('fb_profile_management AS fpm', 'fpm.fb_id = fam.id', 'left');

		$query = $this->db->get();
		return $query->result_array();
	}

	// Add and update profile details
	public function add_update_fb_profile_details($data)
	{
		// Check if the account_id already exists
        $this->db->where('fb_id', $data['fb_id']);
        $query = $this->db->get('fb_profile_management');

        if ($query->num_rows() > 0) {
            // If the account_id exists, update the existing record
            $this->db->where('account_id', $data['account_id']);
            $this->db->update('fb_profile_management', 
				[
					$data['field'] => $data['value'], 
					$data['date_field'] => date('Y-m-d H:i:s')
				]
			);
			return true;
        } else {
            // If the account_id doesn't exist, insert a new record
            $this->db->insert('fb_profile_management',
				[
					'fb_id' => $data['fb_id'],
					'account_id' => $data['account_id'],
					$data['field'] => $data['value'],
					$data['date_field'] => date('Y-m-d H:i:s'),
				]
			);
			return true;
        }
	}

	/** ------------------------------Facebook Task Management---------------------------- */
    // Get facebook task data
	public function get_facebook_task_data()
	{
		$query = $this->db->select('*')->from('fb_task_management')->get();
		return $query->result_array();
	}

	// Save facebook task
	public function save_facebook_task($data)
	{
		$this->db->insert('fb_task_management', $data);
		return $this->db->affected_rows();
	}

    // Update facebook task
	public function edit_facebook_task($data)
	{
		$this->db->where('id', $data["id"]);
		$this->db->update('fb_page_management', $data);
		return $this->db->affected_rows();
	}

	// Check posting file if exists
	public function get_posting_file_if_exists($userId) {
		$query = $this->db->select('file')
					->from('fb_task_management')
					->where('id', $userId)->get();
		if ($query->num_rows() > 0) {
            return $query->row()->file;
        } else {
            return null;
        }
	} 

	/** ----------------------------------Settings-------------------------------- */
	// Get settings data
	public function get_settings_data($setting)
	{
		$this->db->where('setting', $setting);
        $this->db->select('value')->from('settings');
		$query = $this->db->get();
		return $query->row();
	}

	// Add update settings
	public function add_update_settings($data) {
		// Check if the account_id already exists
        $this->db->where('setting', $data['setting']);
        $query = $this->db->get('settings');

        if ($query->num_rows() > 0) {
            // If the setting already exists, update the the setting value
            $this->db->where('setting', $data['setting']);
            $this->db->update('settings', $data);
			return $this->db->affected_rows();
        } else {
            // If the setting doesn't exist, insert setting
			$this->db->insert('settings', $data);
			return $this->db->affected_rows();
        }
	}

}