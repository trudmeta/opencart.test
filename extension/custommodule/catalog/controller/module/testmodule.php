<?php

namespace Opencart\Catalog\Controller\Extension\Custommodule\Module;

class Testmodule extends \Opencart\System\Engine\Controller
{
    private $extension = 'extension/custommodule/module/testmodule';
    private $moduleSetting = 'module_testmodule';

    /**
     * Display text on home page
     * @param $event
     * @param $data
     * @param $output
     * @return string|null
     */
	public function showText($event, $data, $output): ?string
    {
        if ((!isset($this->request->get['route']) || $this->request->get['route'] == 'common/home') &&
            $this->config->get($this->moduleSetting . '_status'))
        {
            return $this->load->view($this->extension) . $output;
        }

        return null;
    }

    /**
     * Save in database main page visits
     */
	public function mainPageVisits($event, $data, $output): ?string
    {
        if ((!isset($this->request->get['route']) || $this->request->get['route'] == 'common/home') && $this->config->get($this->moduleSetting . '_status')) {
            return $this->load->view($this->extension.'_ajax') . $output;
        }

        return null;
    }
}
