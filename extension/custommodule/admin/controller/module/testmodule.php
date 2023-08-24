<?php

namespace Opencart\Admin\Controller\Extension\Custommodule\Module;

class Testmodule extends \Opencart\System\Engine\Controller
{
    private $extension = 'extension/custommodule/module/testmodule';
    private $moduleSetting = 'module_testmodule';

    public function index(): void
    {
        $this->load->language($this->extension);

        $this->document->setTitle($this->language->get('heading_title'));

        $data['breadcrumbs'] = [];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'])
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module')
        ];

        $data['breadcrumbs'][] = [
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link($this->extension, 'user_token=' . $this->session->data['user_token'])
        ];

        $data['save'] = $this->url->link($this->extension . '.save', 'user_token=' . $this->session->data['user_token']);
        $data['back'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=module');

        $data[$this->moduleSetting . '_status'] = $this->config->get($this->moduleSetting . '_status');


        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view($this->extension, $data));
    }

    public function save(): void
    {
        $this->load->language($this->extension);

        $json = [];

        if (!$this->user->hasPermission('modify', $this->extension)) {
            $json['error']['warning'] = $this->language->get('error_permission');
        }

        if (!$json) {
            $this->load->model('setting/setting');

            $this->model_setting_setting->editSetting($this->moduleSetting, $this->request->post);

            $json['success'] = $this->language->get('text_success');
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function install(): void
    {
        $this->load->model('setting/event');

        $this->model_setting_event->addEvent([
            'code'		 => 'custommodule',
            'description'=> 'custom test module',
            'trigger'	 => 'catalog/view/extension/opencart/module/featured/after',
            'action'	 => $this->extension . '.showText',
            'status'	 => 1,
            'sort_order' => 0
        ]);
    }

    public function uninstall(): void
    {
        $this->load->model('setting/event');

        $this->model_setting_event->deleteEventByCode('custommodule');
    }
}
