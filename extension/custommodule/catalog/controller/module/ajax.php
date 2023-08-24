<?php

namespace Opencart\Catalog\Controller\Extension\Custommodule\Module;

class Ajax extends \Opencart\System\Engine\Controller
{
	public function index(): void
    {
        $this->load->model('extension/custommodule/module/testmodule');
        $this->model_extension_custommodule_module_testmodule->addVisit();

//        $this->response->addHeader('Content-Type: application/json');
//        $this->response->setOutput(json_encode(['resp' => 'ok!']));
    }
}
