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
            $issueDataJson = json_encode(array_values($issueTypes));
            $issueLabelsJson = json_encode(array_keys($issueTypes));

            return ["values" => $issueDataJson, "labels" => $issueLabelsJson];
        }
    }

    public function ticketPriorityChartManagment(): array
    {
        $data = $this->dataController->countTicketPriority();

        $ticketsPriority = [
            'Niski' => $data["NISKI"],
            'Średni' => $data["ŚREDNI"],
            'Wysoki' => $data["WYSOKI"],
        ];

        if (isset($ticketsPriority)) {
            $ticketsPriorityDataJson = json_encode(array_values($ticketsPriority));
            $ticketsPriorityLabelsJson = json_encode(array_keys($ticketsPriority));

            return ["values" => $ticketsPriorityDataJson, "labels" => $ticketsPriorityLabelsJson];
        }
    }
}
