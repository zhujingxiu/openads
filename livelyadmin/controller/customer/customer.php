<?php
class ControllerCustomerCustomer extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('customer/customer');

        $this->getList();
    }

    public function add() {
        $this->load->language('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('customer/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('customer/customer/add')) {
            $result = $this->model_customer_customer->addCustomer($this->request->post);

            $this->session->data['success'] = sprintf($this->language->get('text_customer_success'),$result['username'],$result['password']);

            $url = '';
            if (isset($this->request->get['filter_username'])) {
                $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_in_charge'])) {
                $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
            }
            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_ip'])) {
                $url .= '&filter_ip=' . $this->request->get['filter_ip'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function edit() {
        $this->load->language('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('customer/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm('customer/customer/edit')) {
            $result = $this->model_customer_customer->editCustomer($this->request->get['customer_id'], $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';
            if (isset($this->request->get['filter_username'])) {
                $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_in_charge'])) {
                $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_ip'])) {
                $url .= '&filter_ip=' . $this->request->get['filter_ip'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getForm();
    }

    public function delete() {
        $this->load->language('customer/customer');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('customer/customer');

        if (isset($this->request->post['selected']) && $this->validateDelete('customer/customer/delete')) {
            foreach ($this->request->post['selected'] as $customer_id) {
                $this->model_customer_customer->deleteCustomer($customer_id);
            }

            $this->session->data['success'] = $this->language->get('text_success');

            $url = '';
            if (isset($this->request->get['filter_username'])) {
                $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
            }
            if (isset($this->request->get['filter_name'])) {
                $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_in_charge'])) {
                $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
            }

            if (isset($this->request->get['filter_email'])) {
                $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
            }

            if (isset($this->request->get['filter_customer_group_id'])) {
                $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
            }

            if (isset($this->request->get['filter_status'])) {
                $url .= '&filter_status=' . $this->request->get['filter_status'];
            }

            if (isset($this->request->get['filter_ip'])) {
                $url .= '&filter_ip=' . $this->request->get['filter_ip'];
            }

            if (isset($this->request->get['filter_date_added'])) {
                $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
            }

            if (isset($this->request->get['sort'])) {
                $url .= '&sort=' . $this->request->get['sort'];
            }

            if (isset($this->request->get['order'])) {
                $url .= '&order=' . $this->request->get['order'];
            }

            if (isset($this->request->get['page'])) {
                $url .= '&page=' . $this->request->get['page'];
            }

            $this->response->redirect($this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }

        $this->getList();
    }
           
    protected function getList() {
        if (isset($this->request->get['filter_username'])) {
            $filter_username = $this->request->get['filter_username'];
        } else {
            $filter_username = null;
        }
        if (isset($this->request->get['filter_name'])) {
            $filter_name = $this->request->get['filter_name'];
        } else {
            $filter_name = null;
        }

        if (isset($this->request->get['filter_in_charge'])) {
            $filter_in_charge = $this->request->get['filter_in_charge'];
        } else {
            $filter_in_charge = null;
        }

        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $filter_customer_group_id = $this->request->get['filter_customer_group_id'];
        } else {
            $filter_customer_group_id = null;
        }

        if (isset($this->request->get['filter_status'])) {
            $filter_status = $this->request->get['filter_status'];
        } else {
            $filter_status = null;
        }

        if (isset($this->request->get['filter_ip'])) {
            $filter_ip = $this->request->get['filter_ip'];
        } else {
            $filter_ip = null;
        }

        if (isset($this->request->get['filter_date_added'])) {
            $filter_date_added = $this->request->get['filter_date_added'];
        } else {
            $filter_date_added = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'c.date_added';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'DESC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';
        if (isset($this->request->get['filter_username'])) {
            $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_in_charge'])) {
            $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_ip'])) {
            $url .= '&filter_ip=' . $this->request->get['filter_ip'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        $data['add'] = $this->url->link('customer/customer/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        $data['delete'] = $this->url->link('customer/customer/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

        $data['customers'] = array();

        $filter_data = array(
            'filter_username'       => $filter_username,
            'filter_name'              => $filter_name,
            'filter_email'             => $filter_email,
            'filter_customer_group_id' => $filter_customer_group_id,
            'filter_status'            => $filter_status,
            'filter_date_added'        => $filter_date_added,
            'filter_ip'                => $filter_ip,
            'filter_in_charge'         => $filter_in_charge,
            'sort'                     => $sort,
            'order'                    => $order,
            'start'                    => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit'                    => $this->config->get('config_limit_admin')
        );

        $customer_total = $this->model_customer_customer->getTotalCustomers($filter_data);

        $results = $this->model_customer_customer->getCustomers($filter_data);

        foreach ($results as $result) {
            $ads = $this->model_customer_customer->getTotalAdvertises($result['customer_id']);
            $data['customers'][] = array(
                'customer_id'    => $result['customer_id'],
                'username'    => $result['username'],
                'name'           => $result['name'],
                'email'          => $result['email'],
                'customer_group' => $result['customer_group'],
                'status'         => ($result['status'] ? $this->language->get('text_enabled') : $this->language->get('text_disabled')),
                'ip'             => $result['ip'],
                'in_charge'      => $result['in_charge'],
                'charger'        => $result['charger'],
                'company'        => $result['company'],
                'operator'       => $result['operator'],
                'advertise'      => $ads,
                'date_added'     => date('Y-m-d', strtotime($result['date_added'])).'<br>'.date('H:i:s',strtotime($result['date_added'])),
                'edit'           => $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $result['customer_id'] . $url, 'SSL')
            );
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_list'] = $this->language->get('text_list');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_default'] = $this->language->get('text_default');
        $data['text_login'] = $this->language->get('text_login');
        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_confirm'] = $this->language->get('text_confirm');

        $data['column_username'] = $this->language->get('column_username');
        $data['column_name'] = $this->language->get('column_name');
        $data['column_in_charge'] = $this->language->get('column_in_charge');
        $data['column_email'] = $this->language->get('column_email');
        $data['column_customer_group'] = $this->language->get('column_customer_group');
        $data['column_status'] = $this->language->get('column_status');
        $data['column_ip'] = $this->language->get('column_ip');
        $data['column_company'] = $this->language->get('column_company');
        $data['column_author_id'] = $this->language->get('column_author_id');
        $data['column_operator'] = $this->language->get('column_operator');
        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_advertise'] = $this->language->get('column_advertise');
        $data['column_action'] = $this->language->get('column_action');

        $data['entry_username'] = $this->language->get('entry_username');
        $data['entry_name'] = $this->language->get('entry_name');
        $data['entry_in_charge'] = $this->language->get('entry_in_charge');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_ip'] = $this->language->get('entry_ip');
        $data['entry_date_added'] = $this->language->get('entry_date_added');

        $data['button_add'] = $this->language->get('button_add');
        $data['button_edit'] = $this->language->get('button_edit');
        $data['button_delete'] = $this->language->get('button_delete');
        $data['button_filter'] = $this->language->get('button_filter');

        $data['token'] = $this->session->data['token'];

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $url = '';
        if (isset($this->request->get['filter_username'])) {
            $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_in_charge'])) {
            $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_ip'])) {
            $url .= '&filter_ip=' . $this->request->get['filter_ip'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if ($order == 'ASC') {
            $url .= '&order=DESC';
        } else {
            $url .= '&order=ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_username'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.username' . $url, 'SSL');
        $data['sort_name'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=name' . $url, 'SSL');
        $data['sort_company'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.company' . $url, 'SSL');
        $data['sort_author_id'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.author_id' . $url, 'SSL');
        $data['sort_in_charge'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.in_charge' . $url, 'SSL');
        $data['sort_email'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.email' . $url, 'SSL');
        $data['sort_customer_group'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=customer_group' . $url, 'SSL');
        $data['sort_status'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.status' . $url, 'SSL');
        $data['sort_ip'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.ip' . $url, 'SSL');
        $data['sort_operator'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.user_id' . $url, 'SSL');
        $data['sort_date_added'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . '&sort=c.date_added' . $url, 'SSL');

        $url = '';
        if (isset($this->request->get['filter_username'])) {
            $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_in_charge'])) {
            $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_ip'])) {
            $url .= '&filter_ip=' . $this->request->get['filter_ip'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        $pagination = new Pagination();
        $pagination->total = $customer_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($customer_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($customer_total - $this->config->get('config_limit_admin'))) ? $customer_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $customer_total, ceil($customer_total / $this->config->get('config_limit_admin')));

        $data['filter_username'] = $filter_username;
        $data['filter_name'] = $filter_name;
        $data['filter_in_charge'] = $filter_in_charge;
        $data['filter_email'] = $filter_email;
        $data['filter_customer_group_id'] = $filter_customer_group_id;
        $data['filter_status'] = $filter_status;
        $data['filter_ip'] = $filter_ip;
        $data['filter_date_added'] = $filter_date_added;

        $this->load->model('customer/customer_group');

        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

        $this->load->model('user/user');

        //$data['users'] = $this->model_user_user->getUsers(array('filter_status'=>1));
        $data['managers'] = $this->model_user_user->getUsers(array('roles'=>$this->config->get('ad_group_manager')));
        
        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('customer/customer_list.tpl', $data));
    }

    protected function getForm() {
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_form'] = !isset($this->request->get['customer_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');     
        $data['text_select'] = $this->language->get('text_select');
        $data['text_none'] = $this->language->get('text_none');
        $data['text_loading'] = $this->language->get('text_loading');
        $data['text_random'] = $this->language->get('text_random');

        $data['entry_customer_group'] = $this->language->get('entry_customer_group');
        $data['entry_username'] = $this->language->get('entry_username');
        $data['entry_nickname'] = $this->language->get('entry_nickname');
        $data['entry_firstname'] = $this->language->get('entry_firstname');
        $data['entry_lastname'] = $this->language->get('entry_lastname');
        $data['entry_email'] = $this->language->get('entry_email');
        $data['entry_password'] = $this->language->get('entry_password');
        $data['entry_confirm'] = $this->language->get('entry_confirm');
        $data['entry_status'] = $this->language->get('entry_status');
        $data['entry_in_charge'] = $this->language->get('entry_in_charge');
        $data['entry_company'] = $this->language->get('entry_company');
        $data['entry_contact'] = $this->language->get('entry_contact');
        $data['entry_author_id'] = $this->language->get('entry_author_id');
        $data['entry_default'] = $this->language->get('entry_default');
        $data['entry_comment'] = $this->language->get('entry_comment');
        $data['entry_description'] = $this->language->get('entry_description');

        $data['button_cancel'] = $this->language->get('button_cancel');
        $data['button_history_add'] = $this->language->get('button_history_add');
        $data['button_remove'] = $this->language->get('button_remove');
        $data['button_save'] = $this->language->get('button_save');

        $data['tab_general'] = $this->language->get('tab_general');
        $data['tab_history'] = $this->language->get('tab_history');

        $data['token'] = $this->session->data['token'];

        if (isset($this->request->get['customer_id'])) {
            $data['customer_id'] = $this->request->get['customer_id'];
        } else {
            $data['customer_id'] = 0;
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->error['username'])) {
            $data['error_username'] = $this->error['username'];
        } else {
            $data['error_username'] = '';
        }

        if (isset($this->error['password'])) {
            $data['error_password'] = $this->error['password'];
        } else {
            $data['error_password'] = '';
        }

        $url = '';
        if (isset($this->request->get['filter_username'])) {
            $url .= '&filter_username=' . urlencode(html_entity_decode($this->request->get['filter_username'], ENT_QUOTES, 'UTF-8'));
        }
        if (isset($this->request->get['filter_name'])) {
            $url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . urlencode(html_entity_decode($this->request->get['filter_email'], ENT_QUOTES, 'UTF-8'));
        }

        if (isset($this->request->get['filter_customer_group_id'])) {
            $url .= '&filter_customer_group_id=' . $this->request->get['filter_customer_group_id'];
        }

        if (isset($this->request->get['filter_status'])) {
            $url .= '&filter_status=' . $this->request->get['filter_status'];
        }

        if (isset($this->request->get['filter_in_charge'])) {
            $url .= '&filter_in_charge=' . $this->request->get['filter_in_charge'];
        }

        if (isset($this->request->get['filter_date_added'])) {
            $url .= '&filter_date_added=' . $this->request->get['filter_date_added'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, 'SSL')
        );

        if (!isset($this->request->get['customer_id'])) {
            $data['action'] = $this->url->link('customer/customer/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
        } else {
            $data['action'] = $this->url->link('customer/customer/edit', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . $url, 'SSL');
        }

        $data['cancel'] = $this->url->link('customer/customer', 'token=' . $this->session->data['token'] . $url, 'SSL');

        if (isset($this->request->get['customer_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
            $customer_info = $this->model_customer_customer->getCustomer($this->request->get['customer_id']);
        }

        $this->load->model('customer/customer_group');

        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();

        if (isset($this->request->post['customer_group_id'])) {
            $data['customer_group_id'] = $this->request->post['customer_group_id'];
        } elseif (!empty($customer_info['customer_group_id'])) {
            $data['customer_group_id'] = $customer_info['customer_group_id'];
        } else {
            $data['customer_group_id'] = $this->config->get('config_customer_group_id');
        }

        if (isset($this->request->post['nickname'])) {
            $data['nickname'] = $this->request->post['nickname'];
        } elseif (!empty($customer_info['nickname'])) {
            $data['nickname'] = $customer_info['nickname'];
        } else {
            $data['nickname'] = '';
        }

        if (isset($this->request->post['firstname'])) {
            $data['firstname'] = $this->request->post['firstname'];
        } elseif (!empty($customer_info['firstname'])) {
            $data['firstname'] = $customer_info['firstname'];
        } else {
            $data['firstname'] = '';
        }

        if (isset($this->request->post['lastname'])) {
            $data['lastname'] = $this->request->post['lastname'];
        } elseif (!empty($customer_info['lastname'])) {
            $data['lastname'] = $customer_info['lastname'];
        } else {
            $data['lastname'] = '';
        }

        if (isset($this->request->post['email'])) {
            $data['email'] = $this->request->post['email'];
        } elseif (!empty($customer_info['email'])) {
            $data['email'] = $customer_info['email'];
        } else {
            $data['email'] = '';
        }

        if (isset($this->request->post['author_id'])) {
            $data['author_id'] = $this->request->post['author_id'];
        } elseif (!empty($customer_info['author_id'])) {
            $data['author_id'] = $customer_info['author_id'];
        } else {
            $data['author_id'] = '';
        }
        $auto_num = $this->model_customer_customer->getMaxAutoNum(date('ymd'));
        if (isset($this->request->post['precode'])) {
            $data['precode'] = $this->request->post['precode'];
        } elseif (!empty($customer_info['precode'])) {
            $data['precode'] = $customer_info['precode'];
        } else {
            $data['precode'] = date('ymd');
        }
        if (isset($this->request->post['auto_num'])) {
            $data['auto_num'] = $this->request->post['auto_num'];
        } elseif (!empty($customer_info['auto_num'])) {
            $data['auto_num'] = $customer_info['auto_num'];
        } else {
            $data['auto_num'] = $auto_num;
        }
        if (isset($this->request->post['username'])) {
            $data['username'] = $this->request->post['username'];
        } elseif (!empty($customer_info['username'])) {
            $data['username'] = $customer_info['username'];
        } else {
            $data['username'] = date('ymd').'XX';
        } 

        if (isset($this->request->post['status'])) {
            $data['status'] = $this->request->post['status'];
        } elseif (!empty($customer_info['status'])) {
            $data['status'] = $customer_info['status'];
        } else {
            $data['status'] = true;
        }

        if (isset($this->request->post['in_charge'])) {
            $data['in_charge'] = $this->request->post['in_charge'];
        } elseif (!empty($customer_info['in_charge'])) {
            $data['in_charge'] = $customer_info['in_charge'];
        } else {
            $data['in_charge'] = $this->user->getId();
        }

        if (isset($this->request->post['password'])) {
            $data['password'] = $this->request->post['password'];
        } else {
            $data['password'] = '';
        }

        if (isset($this->request->post['confirm'])) {
            $data['confirm'] = $this->request->post['confirm'];
        } else {
            $data['confirm'] = '';
        }

        if (isset($this->request->post['company'])) {
            $data['company'] = $this->request->post['company'];
        } elseif (!empty($customer_info['company'])) {
            $data['company'] = $customer_info['company'];
        } else {
            $data['company'] = '';
        }

        if (isset($this->request->post['contact'])) {
            $data['contact'] = $this->request->post['contact'];
        } elseif (!empty($customer_info['contact'])) {
            $data['contact'] = $customer_info['contact'];
        } else {
            $data['contact'] = '';
        }

        $this->load->model('user/user');

        //$data['users'] = $this->model_user_user->getUsers(array('filter_status'=>1));
        $data['managers'] = $this->model_user_user->getUsers(array('roles'=>$this->config->get('ad_group_manager')));

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('customer/customer_form.tpl', $data));
    }

    protected function validateForm($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if ((utf8_strlen($this->request->post['username']) < 1) || (utf8_strlen(trim($this->request->post['username'])) > 32)) {
            $this->error['username'] = $this->language->get('error_username');
        }
        if(utf8_strlen($this->request->post['password'])){
            if ((utf8_strlen($this->request->post['password']) < 1) || (utf8_strlen(trim($this->request->post['password'])) > 32)) {
                $this->error['password'] = $this->language->get('error_password');
            }
        }

        if ($this->error && !isset($this->error['warning'])) {
            $this->error['warning'] = $this->language->get('error_warning');
        }

        return !$this->error;
    }

    protected function validateDelete($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    protected function validateHistory($route) {
        if (!$this->user->hasPermission($route)) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        if (!isset($this->request->post['comment']) || utf8_strlen($this->request->post['comment']) < 1) {
            $this->error['warning'] = $this->language->get('error_comment');
        }

        return !$this->error;
    }

    public function history() {
        $this->load->language('customer/customer');

        $this->load->model('customer/customer');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateHistory('customer/customer/history')) {
            $this->model_customer_customer->addHistory($this->request->get['customer_id'], $this->request->post['comment']);

            $data['success'] = $this->language->get('text_success');
        } else {
            $data['success'] = '';
        }

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['text_no_results'] = $this->language->get('text_no_results');

        $data['column_date_added'] = $this->language->get('column_date_added');
        $data['column_comment'] = $this->language->get('column_comment');

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $data['histories'] = array();

        $results = $this->model_customer_customer->getHistories($this->request->get['customer_id'], ($page - 1) * 10, 10);

        foreach ($results as $result) {
            $data['histories'][] = array(
                'comment'     => $result['comment'],
                'date_added'  => date('Y-m-d H:i:s', strtotime($result['date_added']))
            );
        }

        $history_total = $this->model_customer_customer->getTotalHistories($this->request->get['customer_id']);

        $pagination = new Pagination();
        $pagination->total = $history_total;
        $pagination->page = $page;
        $pagination->limit = 10;
        $pagination->url = $this->url->link('customer/customer/history', 'token=' . $this->session->data['token'] . '&customer_id=' . $this->request->get['customer_id'] . '&page={page}', 'SSL');

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($history_total) ? (($page - 1) * 10) + 1 : 0, ((($page - 1) * 10) > ($history_total - 10)) ? $history_total : ((($page - 1) * 10) + 10), $history_total, ceil($history_total / 10));

        $this->response->setOutput($this->load->view('customer/customer_history.tpl', $data));
    }

    public function autocomplete() {
        $json = array();

        if ( isset($this->request->get['filter_name']) || isset($this->request->get['filter_email']) || isset($this->request->get['filter_username'])) {
            if (isset($this->request->get['filter_name'])) {
                $filter_name = trim($this->request->get['filter_name']);
            } else {
                $filter_name = '';
            }

            if (isset($this->request->get['filter_email'])) {
                $filter_email = trim($this->request->get['filter_email']);
            } else {
                $filter_email = '';
            }
            if (isset($this->request->get['filter_username'])) {
                $filter_username = trim($this->request->get['filter_username']);
            } else {
                $filter_username = '';
            }
            $this->load->model('customer/customer');

            $filter_data = array(
                'filter_name'  => $filter_name,
                'filter_email' => $filter_email,
                'filter_username' => $filter_username,
                'start'        => 0,
                'limit'        => 20
            );

            $results = $this->model_customer_customer->getCustomers($filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'customer_id'       => $result['customer_id'],
                    'username'          => $result['username'],
                    'customer_group_id' => $result['customer_group_id'],
                    'name'              => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
                    'customer_group'    => $result['customer_group'],
                    'nickname'          => $result['nickname'],
                    'firstname'         => $result['firstname'],
                    'lastname'          => $result['lastname'],
                    'fullname'          => strip_tags(html_entity_decode($result['fullname'], ENT_QUOTES, 'UTF-8')),
                    'email'             => $result['email'],
                );
            }
        }

        $sort_order = array();

        foreach ($json as $key => $value) {
            $sort_order[$key] = $value['name'];
        }

        array_multisort($sort_order, SORT_ASC, $json);

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function login() {
        $json = array();

        if (isset($this->request->get['customer_id'])) {
            $customer_id = $this->request->get['customer_id'];
        } else {
            $customer_id = 0;
        }

        $this->load->model('customer/customer');

        $customer_info = $this->model_customer_customer->getCustomer($customer_id);

        if ($customer_info) {
            $token = md5(mt_rand());

            $this->model_customer_customer->editToken($customer_id, $token);
            
            $this->response->redirect(HTTP_CATALOG . 'index.php?route=account/login&token=' . $token);
        } else {
            $this->load->language('error/not_found');

            $this->document->setTitle($this->language->get('heading_title'));

            $data['heading_title'] = $this->language->get('heading_title');

            $data['text_not_found'] = $this->language->get('text_not_found');

            $data['breadcrumbs'] = array();

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('heading_title'),
                'href' => $this->url->link('error/not_found', 'token=' . $this->session->data['token'], 'SSL')
            );

            $data['header'] = $this->load->controller('common/header');
            $data['column_left'] = $this->load->controller('common/column_left');
            $data['footer'] = $this->load->controller('common/footer');

            $this->response->setOutput($this->load->view('error/not_found.tpl', $data));
        }
    }

}