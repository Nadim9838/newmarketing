<?php defined('BASEPATH') or exit('No direct script access allowed');
date_default_timezone_set('Asia/Kolkata');

class Home extends CI_Controller {

    // Call constructer function
    public function __construct() {
        parent::__construct();
        $this->load->model('Crud');
    }

    // First time this function call
    public function index()
	{
		redirect(base_url() . 'home/login');
	}

    // Login page
    public function login()
	{
		$this->load->view('outer_header');
		$this->load->view('login');
	}

    // Login authentication
    public function userLoginAuth()	{
		// Set validation rules
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed!! Please try again.</div>');
            $this->load->view('outer_header');
            $this->load->view('login');
        } else {
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			
			// Authenticate the user
            $userData = $this->Crud->userLoginAuth($email, $password);
			if($userData) {
				$this->session->set_userdata('login', $userData);
				// Set user permissions on session
				$permissions = $this->Crud->get_user_login_permissions($userData['id']);
				$this->session->set_userdata('permissions', $permissions);
				redirect(base_url() . 'home/dashboard', 'refresh');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid email or password. Please try again.</div>');
				$this->load->view('outer_header');
				$this->load->view('login');
			}
		}
	}

	// Logout function
	public function logout()
	{
		$this->session->unset_userdata('permissions');
		$this->session->unset_userdata('login');
		$this->session->sess_destroy();
		redirect(base_url() . 'home/login', 'refresh');
	}

	// Dashboard page
	public function dashboard()
	{
		if ($this->session->has_userdata('login')) {
			$this->load->view('header');
			$this->load->view('dashboard');
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	/** ------------------------------User Management---------------------------- */
	// User Management
	public function user_management()
	{
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_user_management_data();
			$this->load->view('header');
			$this->load->view('user_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Add or update the users
	public function add_update_user() {
		if ($this->session->has_userdata('login')) {
			// Set validation rules
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">All fields are required!! Please try again.</div>');
				redirect(base_url() . 'home/user_management', 'refresh');
			} else {
				$data['name'] = $this->input->post('name');
				$data['email'] = $this->input->post('email');
				$data['mobile'] = $this->input->post('mobile');
				$password = $this->input->post('password');
				$data['password'] = password_hash($password, PASSWORD_DEFAULT);
				if($this->input->post('status') === '1' || $this->input->post('status') === '0') {
					$data['status'] = $this->input->post('status');
				}
				
				if ($this->input->post('sav-typ') == 'edit') {
					$data['id'] = $this->input->post('id');
					$result = $this->Crud->edit_user($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success
						text-center">User Updated Successfully.</div>');
						redirect(base_url() . 'home/user_management', 'refresh');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger
						text-center">User updation failed. Please try again.</div>');
						redirect(base_url() . 'home/user_management', 'refresh');
					}
				} else {
					$result = $this->Crud->insert_user($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User Added Successfully.</div>');
						redirect(base_url() . 'home/user_management', 'refresh');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">User Can\'t Add.</div>');
						redirect(base_url() . 'home/user_management', 'refresh');
					}
				}
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Delete the user 
	public function delete_user() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$result = $this->Crud->delete_user($userId);
			if($result) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">User Deleted Successfully.</div>');
				echo 1;
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">User Can\'t Delete.</div>');
				echo 0;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// No user permissions then goto this page
	public function no_user_permissions()
	{
		if ($this->session->has_userdata('login')) {
			$this->load->view('no_user_permissions');
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Get user permissions
    public function get_user_permissions() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$data['permissions'] = $this->Crud->get_user_permissions($userId);
			echo json_encode($data['permissions']);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
    }

	// Set user permissions
	public function set_user_permissions() {
		if ($this->session->has_userdata('login')) {
			$user_id = $this->input->post('user_id');
			$permissions = $this->input->post('permissions');

			if ($this->Crud->update_user_permissions($user_id, $permissions)) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Permissions  Updated Successfully.</div>');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Failed to update permissions.</div>');
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
    }

  /** --------------------------------- SMS Panel --------------------------------- */

	// Send bulk SMS
	public function send_sms()
	{
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_facebook_account_data();
			$this->load->view('header');
			$this->load->view('send_sms', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// SMS reports
	public function sms_reports() {
		$this->load->vieW('header');
		$this->load->view('send_reports');
	}

	public function sms_settings() {
		$this->load->view('header');
		$this->load->view('sms_settings');
	}
	// User Management
	public function mobile_management()
	{
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_mobile_management_data();
			$page['allAccounts'] = $this->Crud->get_all_accounts_count();
			$this->load->view('header');
			$this->load->view('mobile_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Add or update the mobiles
	public function add_update_mobile() {
		if ($this->session->has_userdata('login')) {
			// Set validation rules
			$this->form_validation->set_rules('company_model', 'Company Model', 'required');
			$this->form_validation->set_rules('android_version', 'Android Version', 'required');
			$this->form_validation->set_rules('imei_number', 'IMEI Number', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">All fields are required!! Please try again.</div>');
				redirect(base_url() . 'home/mobile_management', 'refresh');
			} else {
				$data['company_model'] = $this->input->post('company_model');
				$data['android_version'] = $this->input->post('android_version');
				$data['imei_number'] = $this->input->post('imei_number');
				if($this->input->post('status') === '1' || $this->input->post('status') === '0') {
					$data['status'] = $this->input->post('status');
				}
				
				if ($this->input->post('sav-typ') == 'edit') {
					$data['id'] = $this->input->post('id');
					$result = $this->Crud->edit_mobile($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success
						text-center">Mobile Updated Successfully.</div>');
						redirect(base_url() . 'home/mobile_management', 'refresh');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger
						text-center">Mobile updation failed. Please try again.</div>');
						redirect(base_url() . 'home/mobile_management', 'refresh');
					}
				} else {
					$result = $this->Crud->insert_mobile($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Mobile Added Successfully.</div>');
						redirect(base_url() . 'home/mobile_management', 'refresh');
						
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile Can\'t Add.</div>');
						redirect(base_url() . 'home/mobile_management', 'refresh');
					}
				}
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Delete the user 
	public function delete_mobile() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$table = 'mobile_management';
			$result = $this->Crud->deleteCommonFunction($userId, $table);
			if($result) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Mobile Deleted Successfully.</div>');
				echo 1;
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Mobile Can\'t Delete.</div>');
				echo 0;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}
		
	/** --------------------------Social Media Accounts in Mobile---------------------------- */
	// Fetch social media accounts
	public function fetch_social_media_accounts()
	{
		if ($this->session->has_userdata('login')) {
			if ($this->input->post('social_app')) {
				$socialApp = $this->input->post('social_app');
				$tableName = '';
				if($socialApp == 'facebook1' || $socialApp == 'facebook2') {
					$tableName = 'fb_account_management';
				} elseif($socialApp == 'instagram1' || $socialApp == 'instagram2') {
					$tableName = 'instagram_management';
				} elseif($socialApp == 'twitter1' || $socialApp == 'twitter2') {
					$tableName = 'twitter_management';
				} elseif($socialApp == 'youtube1' || $socialApp == 'youtube2') {
					$tableName = 'youtube_management';
				} elseif($socialApp == 'tiktok1' || $socialApp == 'tiktok2') {
					$tableName = 'tiktok_management';
				} elseif($socialApp == 'whatsapp1' || $socialApp == 'whatsapp2') {
					$tableName = 'whatsapp_management';
				}

				echo $this->Crud->fetch_social_media_accounts($tableName);
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Get saved social media accounts from mobile
	public function get_saved_social_media_accounts() {
		if ($this->session->has_userdata('login')) {
			$mobileId = $this->input->post('mobile_id');
			$savedAccounts = $this->Crud->get_saved_social_media_accounts($mobileId);
			echo json_encode(['saved_accounts' => $savedAccounts]);
		} else {
			redirect(base_url(). 'home/login', 'refresh');
		}
	}

	// Save the social media accounts in the mobile 
	public function save_social_media_account() {
		$data['mobile_id'] = $this->input->post('mobile_id');
		$data['platform'] = $this->input->post('platform');
		$data['app_series'] = $this->input->post('app_series');
		$data['account'] = $this->input->post('account_id');

		if ($data['mobile_id'] && $data['platform'] && $data['app_series'] && $data['account']) {
			$saved = $this->Crud->save_social_media_account($data);
			if ($saved) {
				echo $saved;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	}

	// Update the social media accounts in the mobile 
	public function update_social_media_account() {
		$accountId = $this->input->post('id');
		$data['mobile_id'] = $this->input->post('mobile_id');
		$data['platform'] = $this->input->post('platform');
		$data['app_series'] = $this->input->post('app_series');
		$data['account'] = $this->input->post('account_id');

		if ($data['mobile_id'] && $data['platform'] && $data['app_series'] && $data['account']) {
			$updated = $this->Crud->update_social_media_account($data, $accountId);
			if ($updated) {
				echo $updated;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	}

	// Delete the social media accounts from mobile 
	public function delete_social_media_account() {
		$accountId = $this->input->post('id');
		$platform = $this->input->post('platform');

		if ($accountId && $platform) {
			$deleted = $this->Crud->delete_social_media_account($accountId, $platform);
			if ($deleted) {
				echo $deleted;
			} else {
				echo false;
			}
		} else {
			echo false;
		}
	}

	/** ------------------------------Facebook Management---------------------------- */
	

	// Add or update the facebook accounts
	public function add_update_fb_account() {
		if ($this->session->has_userdata('login')) {
			// Set validation rules
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('profile_link', 'Profile Link', 'required');
			$this->form_validation->set_rules('account_id', 'Facebook Id', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('gender', 'Gender', 'required');
			$this->form_validation->set_rules('religion', 'Religion', 'required');
			$this->form_validation->set_rules('cast', 'cast', 'required');
			$this->form_validation->set_rules('dob', 'DOB', 'required');
			$this->form_validation->set_rules('age', 'Age', 'required');
			$this->form_validation->set_rules('location', 'Location', 'required');
			$this->form_validation->set_rules('city', 'city', 'required');
			$this->form_validation->set_rules('state', 'State', 'required');
			$this->form_validation->set_rules('friends', 'Friends', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">All fields are required!! Please try again.</div>');
				redirect(base_url() . 'home/fb_account_management', 'refresh');
			} else {
				$data['name'] = $this->input->post('name');
				$data['profile_link'] = $this->input->post('profile_link');
				$data['account_id'] = $this->input->post('account_id');
				$data['password'] = $this->input->post('password');
				$data['mobile'] = $this->input->post('mobile');
				$data['email'] = $this->input->post('email');
				$data['gender'] = $this->input->post('gender');
				$data['religion'] = $this->input->post('religion');
				$data['cast'] = $this->input->post('cast');
				$data['dob'] = $this->input->post('dob');
				$data['age'] = $this->input->post('age');
				$data['location'] = $this->input->post('location');
				$data['city'] = $this->input->post('city');
				$data['state'] = $this->input->post('state');
				$data['friends'] = $this->input->post('friends');
				if($this->input->post('status') === '1' || $this->input->post('status') === '0') {
					$data['status'] = $this->input->post('status');
				}
				
				if ($this->input->post('sav-typ') == 'edit') {
					$data['id'] = $this->input->post('id');
					$result = $this->Crud->edit_fb_account($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success
						text-center">Facebook Account Updated Successfully.</div>');
						redirect(base_url() . 'home/fb_account_management', 'refresh');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger
						text-center">Facebook Account updation failed. Please try again.</div>');
						redirect(base_url() . 'home/fb_account_management', 'refresh');
					}
				} else {
					$result = $this->Crud->insert_fb_account($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Account Added Successfully.</div>');
						redirect(base_url() . 'home/fb_account_management', 'refresh');
						
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Account Can\'t Add.</div>');
						redirect(base_url() . 'home/fb_account_management', 'refresh');
					}
				}
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Delete the facebook account 
	public function delete_fb_account() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$table = 'fb_account_management';
			$result = $this->Crud->deleteCommonFunction($userId, $table);
			if($result) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Account Deleted Successfully.</div>');
				echo 1;
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Account Can\'t Delete.</div>');
				echo 0;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	/** ------------------------------Facebook Group Management---------------------------- */
	// Facebook Group Management
	public function fb_group_management() {
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_facebook_group_data();
			$this->load->view('header');
			$this->load->view('fb_group_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Add or update the facebook group details
	public function add_update_facebook_group() {
		if ($this->session->has_userdata('login')) {
			// Set validation rules
			$this->form_validation->set_rules('fb_id', 'Profile ID', 'required');
			$this->form_validation->set_rules('profile_name', 'Profile Name', 'required');
			$this->form_validation->set_rules('group_name', 'Group Name', 'required');
			$this->form_validation->set_rules('group_link', 'Group Link', 'required');
			$this->form_validation->set_rules('group_category', 'Group Category', 'required');
			$this->form_validation->set_rules('group_location', 'Group Location', 'required');
			$this->form_validation->set_rules('group_members', 'Group Member', 'required');
			$this->form_validation->set_rules('group_permissions', 'Group Permission', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">All fields are required!! Please try again.</div>');
				redirect(base_url() . 'home/fb_group_management', 'refresh');
			} else {
				$fbId = $this->input->post('fb_id');
				$data['fb_id'] = str_replace("FB00", "", $fbId);
				$data['profile_name'] = $this->input->post('profile_name');
				$data['group_name'] = $this->input->post('group_name');
				$data['group_link'] = $this->input->post('group_link');
				$data['group_category'] = $this->input->post('group_category');
				$data['group_location'] = $this->input->post('group_location');
				$data['group_members'] = $this->input->post('group_members');
				$data['group_permissions'] = $this->input->post('group_permissions');
				if($this->input->post('status') === '1' || $this->input->post('status') === '0') {
					$data['status'] = $this->input->post('status');
				}
				
				if ($this->input->post('sav-typ') == 'edit') {
					$data['id'] = $this->input->post('id');
					$result = $this->Crud->edit_facebook_group($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success
						text-center">Facebook Group Updated Successfully.</div>');
						redirect(base_url() . 'home/fb_group_management', 'refresh');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger
						text-center">Facebook Group updation failed. Please try again.</div>');
						redirect(base_url() . 'home/fb_group_management', 'refresh');
					}
				} else {
					$result = $this->Crud->insert_facebook_group($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Group Added Successfully.</div>');
						redirect(base_url() . 'home/fb_group_management', 'refresh');
						
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Group Can\'t Add.</div>');
						redirect(base_url() . 'home/fb_group_management', 'refresh');
					}
				}
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Delete facebook group 
	public function delete_facebook_group() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$table = 'fb_group_management';
			$result = $this->Crud->deleteCommonFunction($userId, $table);
			if($result) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Group Deleted Successfully.</div>');
				echo 1;
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Group Can\'t Delete.</div>');
				echo 0;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}
	
	// Fetch all social media accounts
	public function fetch_all_facebook_account_details() {
		$search = $this->input->get('search');
        $allAccounts = $this->Crud->fetch_all_facebook_account_details($search);
        $response = array();
        foreach ($allAccounts as $account) {
            $response[] = array(
                'account_id' => 'FB00'.$account->id,
                'name' => $account->name,
            );
        }

        echo json_encode($response);
    }
	
	/** ------------------------------Facebook Page Management---------------------------- */
	// Facebook Page Management
	public function fb_page_management()
	{
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_facebook_page_data();
			$this->load->view('header');
			$this->load->view('fb_page_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Add or update the facebook page details
	public function add_update_facebook_page() {
		if ($this->session->has_userdata('login')) {
			// Set validation rules
			$this->form_validation->set_rules('fb_id', 'Profile ID', 'required');
			$this->form_validation->set_rules('profile_name', 'Profile Name', 'required');
			$this->form_validation->set_rules('page_name', 'Page Name', 'required');
			$this->form_validation->set_rules('page_link', 'Page Link', 'required');
			$this->form_validation->set_rules('page_category', 'Page Category', 'required');
			$this->form_validation->set_rules('page_location', 'Page Location', 'required');
			$this->form_validation->set_rules('page_followers', 'Page Member', 'required');
			$this->form_validation->set_rules('page_permissions', 'Page Permission', 'required');
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">All fields are required!! Please try again.</div>');
				redirect(base_url() . 'home/fb_page_management', 'refresh');
			} else {
				$fbId = $this->input->post('fb_id');
				$data['fb_id'] = str_replace("FB00", "", $fbId);
				$data['profile_name'] = $this->input->post('profile_name');
				$data['page_name'] = $this->input->post('page_name');
				$data['page_link'] = $this->input->post('page_link');
				$data['page_category'] = $this->input->post('page_category');
				$data['page_location'] = $this->input->post('page_location');
				$data['page_followers'] = $this->input->post('page_followers');
				$data['page_permissions'] = $this->input->post('page_permissions');
				if($this->input->post('status') === '1' || $this->input->post('status') === '0') {
					$data['status'] = $this->input->post('status');
				}

				if ($this->input->post('sav-typ') == 'edit') {
					$data['id'] = $this->input->post('id');
					$result = $this->Crud->edit_facebook_page($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success
						text-center">Facebook Page Updated Successfully.</div>');
						redirect(base_url() . 'home/fb_page_management', 'refresh');
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger
						text-center">Facebook Page updation failed. Please try again.</div>');
						redirect(base_url() . 'home/fb_page_management', 'refresh');
					}
				} else {
					$result = $this->Crud->insert_facebook_page($data);
					if($result) {
						$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Page Added Successfully.</div>');
						redirect(base_url() . 'home/fb_page_management', 'refresh');
						
					} else {
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Page Can\'t Add.</div>');
						redirect(base_url() . 'home/fb_page_management', 'refresh');
					}
				}
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Delete facebook page 
	public function delete_facebook_page() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$table = 'fb_page_management';
			$result = $this->Crud->deleteCommonFunction($userId, $table);
			if($result) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Page Deleted Successfully.</div>');
				echo 1;
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Page Can\'t Delete.</div>');
				echo 0;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}
	
	/** ------------------------------Facebook Profile Management---------------------------- */
	// Facebook Profile Management
	public function fb_profile_management()
	{
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_facebook_profile_data();
			$this->load->view('header');
			$this->load->view('fb_profile_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Add or update the facebook profile details
	public function add_update_fb_profile_details() {
		if ($this->session->has_userdata('login')) {
			$fbId = $this->input->post('fb_id');
			$data['fb_id'] = str_replace("FB00", "", $fbId);
			$data['account_id'] = $this->input->post('account_id');
			$data['field'] = $this->input->post('field');
			$data['date_field'] = $this->input->post('date_field');
			$data['value'] = $this->input->post('value');
			$result = $this->Crud->add_update_fb_profile_details($data);
			if($result) {
				return $result;
			} else {
				return $result;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	/** ------------------------------Facebook Task Management---------------------------- */
	// Facebook Task Management
	public function fb_task_management()
	{
		if ($this->session->has_userdata('login')) {
			$page['result'] = $this->Crud->get_facebook_task_data();
			$this->load->view('header');
			$this->load->view('fb_task_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Add facebook task page
	public function add_facebook_task() {
		if ($this->session->has_userdata('login')) {
			$page['fbAllAccounts'] = $this->Crud->get_facebook_account_data();
			$page['fbAllGroups'] = $this->Crud->get_facebook_group_data();
			$page['fbAllPages'] = $this->Crud->get_facebook_page_data();
			$this->load->view('header');
			$this->load->view('add_facebook_task', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Save facebook tasks
	public function save_facebook_task() {
		if ($this->session->has_userdata('login')) {
			$data['task'] = $this->input->post('work');
			// Isert data according to the task
			if(isset($data['task']) && $data['task'] == "posting") {
				$data['content'] = $this->input->post('content');
				$data['task_schedule'] = $this->input->post('posting_schedule');
				$accounts = $this->input->post('accounts');
				$groups = $this->input->post('groups');
				$pages = $this->input->post('pages');
				$wall = $this->input->post('posting_wall');
				$story = $this->input->post('posting_story');


				// File store if it's exists
				if (!empty($fileName = $_FILES['posting_file']['name'])) {
					// Set file path and restrictions
					$config['upload_path'] = 'assets/postingFiles'; // file uploads in this folder
					$config['allowed_types'] = 'jpg|jpeg|png|gif|bmp|webp|mp4|avi|mov|wmv|mkv|flv|webm';
					$config['max_size'] = 1048576; // 1 Gb maximum file size define
					$newFileName = time() . '_' .$fileName;
					$config['file_name'] = $newFileName;

					// Load upload library
					$this->load->library('upload', $config);
					
					// Save posting files
					if ($this->upload->do_upload('posting_file')) {
						$uploadedData = $this->upload->data();
						// Store file name in the database
						$data['file'] = $uploadedData['file_name'];
					} else {
						$error = $this->upload->display_errors();
						$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">'.$error.'</div>');
						redirect(base_url() . 'home/add_facebook_task', 'refresh');
					}
				}
				
				// Insert all facebook accounts with comma separated
				if(isset($accounts)) {
					$data['accounts'] = implode(',', $accounts);
				}
				
				// Insert all facebook groups with comma separated
				if(isset($groups)) {
					$data['groups'] = implode(',', $groups);
				}

				// Insert all facebook pages with comma separated
				if(isset($pages)) {
					$data['pages'] = implode(',', $pages);
				}
				
				// Insert wall value if checkboxes checked
				if($wall == 'on') {
					$data['wall'] = 1;
				} else {
					$data['wall'] = 0;
				}

				// Insert story value if checkboxes checked
				if($story == 'on') {
					$data['story'] = 1;
				} else {
					$data['story'] = 0;
				}
			} elseif(isset($data['task']) && $data['task'] == "video_promoting") {
				$data['link'] = $this->input->post('video_link');
				$data['view_timing'] = $this->input->post('video_view_timing');
				$data['like_qty'] = $this->input->post('video_like_qty');
				$data['share_qty'] = $this->input->post('video_share_qty');
				$data['comment_qty'] = $this->input->post('video_comment_qty');
				$data['task_schedule'] = $this->input->post('video_schedule');
				$accounts = $this->input->post('accounts');
				$groups = $this->input->post('groups');
				$pages = $this->input->post('pages');

				// Insert all facebook accounts with comma separated
				if(isset($accounts)) {
					$data['accounts'] = implode(',', $accounts);
				}

				// Insert all facebook groups with comma separated
				if(isset($groups)) {
					$data['groups'] = implode(',', $groups);
				}

				// Insert all facebook pages with comma separated
				if(isset($pages)) {
					$data['pages'] = implode(',', $pages);
				}
			} elseif(isset($data['task']) && $data['task'] == "reel_promoting") {
				$data['link'] = $this->input->post('reel_link');
				$data['view_timing'] = $this->input->post('reel_view_timing');
				$data['like_qty'] = $this->input->post('reel_like_qty');
				$data['share_qty'] = $this->input->post('reel_share_qty');
				$data['comment_qty'] = $this->input->post('reel_comment_qty');
				$data['task_schedule'] = $this->input->post('reel_schedule');
				$accounts = $this->input->post('accounts');
				$groups = $this->input->post('groups');
				$pages = $this->input->post('pages');

				// Insert all facebook accounts with comma separated
				if(isset($accounts)) {
					$data['accounts'] = implode(',', $accounts);
				}

				// Insert all facebook groups with comma separated
				if(isset($groups)) {
					$data['groups'] = implode(',', $groups);
				}

				// Insert all facebook pages with comma separated
				if(isset($pages)) {
					$data['pages'] = implode(',', $pages);
				}
			} elseif(isset($data['task']) && $data['task'] == "post_promoting") {
				$data['link'] = $this->input->post('post_link');
				$data['like_qty'] = $this->input->post('post_like_qty');
				$data['share_qty'] = $this->input->post('post_share_qty');
				$data['comment_qty'] = $this->input->post('post_comment_qty');
				$data['task_schedule'] = $this->input->post('post_schedule');
				$accounts = $this->input->post('accounts');
				$groups = $this->input->post('groups');
				$pages = $this->input->post('pages');

				// Insert all facebook accounts with comma separated
				if(isset($accounts)) {
					$data['accounts'] = implode(',', $accounts);
				}

				// Insert all facebook groups with comma separated
				if(isset($groups)) {
					$data['groups'] = implode(',', $groups);
				}

				// Insert all facebook pages with comma separated
				if(isset($pages)) {
					$data['pages'] = implode(',', $pages);
				}
			} elseif(isset($data['task']) && $data['task'] == "direct_message") {
				$data['message'] = $this->input->post('message');
				$data['message_qty'] = $this->input->post('message_qty');
				$data['task_schedule'] = $this->input->post('message_schedule');
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please Select Valid Work.</div>');
				redirect(base_url() . 'home/add_facebook_task', 'refresh');
			}

			$this->Crud->save_facebook_task($data);
			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Task Added Successfully.</div>');
			redirect(base_url() . 'home/add_facebook_task', 'refresh');
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Delete facebook task 
	public function delete_fb_task() {
		if ($this->session->has_userdata('login')) {
			$userId = $this->uri->segment(3);
			$table = 'fb_task_management';

			// Get posting file if exists
			$fileExist = $this->Crud->get_posting_file_if_exists($userId);
			if ($fileExist) {
				$filePath = 'assets/postingFiles/' . $fileExist;
				if (file_exists($filePath)) {
					// Delete the file from the folder
					unlink($filePath);
				}
			}
			
			$result = $this->Crud->deleteCommonFunction($userId, $table);
			if($result) {
				$this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Facebook Task Deleted Successfully.</div>');
				echo 1;
			} else {
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Facebook Task Can\'t Delete.</div>');
				echo 0;
			}
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	/** ------------------------------Other Social Media Management---------------------------- */
	// When click on other social management then show work in progress
	public function other_management($value)
	{
		if ($this->session->has_userdata('login')) {
			$this->load->view('header');
			$page['value'] = $value;
			$this->load->view('other_management', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

		
	/** ------------------------------All Repors---------------------------- */
	// Report of mobiles
	public function report_fb_mobiles() {
		if ($this->session->has_userdata('login')) {
			$page['fbAllMobiles'] = $this->Crud->get_mobile_management_data();
			$this->load->view('header');
			$this->load->view('report_fb_mobiles', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Report of facebook accounts
	public function report_fb_accounts() {
		if ($this->session->has_userdata('login')) {
			$page['fbAllAccounts'] = $this->Crud->get_facebook_account_data();
			$this->load->view('header');
			$this->load->view('report_fb_accounts', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Report of facebook groups
	public function report_fb_groups() {
		if ($this->session->has_userdata('login')) {
			$page['fbAllGroups'] = $this->Crud->get_facebook_group_data();
			$this->load->view('header');
			$this->load->view('report_fb_groups', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Report of facebook pages
	public function report_fb_pages() {
		if ($this->session->has_userdata('login')) {
			$page['fbAllPages'] = $this->Crud->get_facebook_page_data();
			$this->load->view('header');
			$this->load->view('report_fb_pages', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// Report of facebook tasks
	public function report_fb_tasks() {
		if ($this->session->has_userdata('login')) {
			$page['fbAllTasks'] = $this->Crud->get_facebook_task_data();
			$this->load->view('header');
			$this->load->view('report_fb_tasks', $page);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	/** ----------------------------------Settings-------------------------------- */
	// settings
	public function settings() {
		if ($this->session->has_userdata('login')) {
			$autoDeleteTime = $this->Crud->get_settings_data('auto_delete_report');
			$data['autoReportDeleteTime'] = $autoDeleteTime->value;
			$homeScrollTime = $this->Crud->get_settings_data('home_scroll_time_limit');
			$data['homeScrollTime'] = $homeScrollTime->value;
			$this->load->view('header');
			$this->load->view('settings', $data);
		} else {
			redirect(base_url() . 'home/login', 'refresh');
		}
	}

	// save setting
	public function add_update_settings() {
		$data['setting'] = $this->input->post('setting');
		$data['value'] = $this->input->post('value');
		$result = $this->Crud->add_update_settings($data);

		if($result) {
			echo $result;
		} else {
			return false;
		}
	}
}