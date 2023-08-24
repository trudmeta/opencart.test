<?php

namespace Opencart\Catalog\Model\Extension\Custommodule\Module;

class Testmodule extends \Opencart\System\Engine\Model
{
	public function addVisit(): void
    {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "main_page_visits` (`created_at`) VALUES (CURRENT_TIMESTAMP)");
	}
}
