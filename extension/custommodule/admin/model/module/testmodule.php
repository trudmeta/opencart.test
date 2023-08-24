<?php

namespace Opencart\Admin\Model\Extension\Custommodule\Module;

class Testmodule extends \Opencart\System\Engine\Model
{
    private $table = 'main_page_visits';

    public function install(): void
    {
        $this->db->query("CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . $this->table ."` (
		  `id` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
		) ENGINE=InnoDB DEFAULT CHARSET=utf8");
    }

    public function getVisits($data): array
    {
        $sql = "SELECT * FROM `" . DB_PREFIX . $this->table ."`";

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }
        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalVisits(): int {
        $sql = "SELECT COUNT(*) AS `total` FROM `" . DB_PREFIX . $this->table ."`";
        $query = $this->db->query($sql);

        return (int)$query->row['total'];
    }

    public function uninstall(): void
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . $this->table ."`");
    }
}
