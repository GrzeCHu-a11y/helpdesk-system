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
            'Sprzęt' => $data["SPRZĘT"],
            'Internet' => $data["INTERNET"],
            'Aplikacja' => $data["APLIKACJA"],
            'Bezpieczeństwo' => $data["BEZPIECZEŃSTWO"],
            'Użytkownik' => $data["UŻYTKOWNIK"],
        ];

        if (isset($issueTypes)) {
            return $issueTypes;
        }
    }
}
