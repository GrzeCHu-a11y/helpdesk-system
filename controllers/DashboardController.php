<?php

declare(strict_types=1);

namespace Controllers;

class DashboardController
{
    private DataController $dataController;

    public function __construct()
    {
        $this->dataController = new DataController();
    }

    public function issuesChartManagement(): array
    {
        $data = $this->dataController->countTicketTypes();

        $issueTypes = [
            'Inne' => $data["INNE"],
            'Sprzęt' => $data["SPRZET"],
            'Internet' => $data["INTERNET"],
        ];

        if (isset($issueTypes)) {
            return $issueTypes;
        }
    }
}
