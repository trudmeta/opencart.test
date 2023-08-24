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
            $this->config->get($this->moduleSetting . '_status') && $this->customer->isLogged())
        {
            return $this->load->view($this->extension, [
                'text' => $this->firstUpper($this->config->get($this->moduleSetting . '_text'))
            ]) . $output;
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

    private function firstUpper(string $str): string
    {
        return mb_convert_case($str, MB_CASE_TITLE, 'UTF-8');
    }
}
