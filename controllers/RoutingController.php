<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Controllers\ViewController;
use Controllers\TicketsController;
use PagesConfig\PagesSetup;

class RoutingController
{

    private ViewController $view;
    private RequestController $request;
    private TicketsController $ticketController;

    public function __construct()
    {
        $this->view = new ViewController();
        $this->request = new RequestController();
        $this->ticketController = new TicketsController();
    }

    public function run(): void
    {
        $currRoute = $this->request->getParams();

        if ($currRoute === 'ticket' && isset($_GET['ajax']) && $_GET['ajax'] == '1') {
            $this->handleAjaxRequest();
        } else {
            if (array_key_exists($currRoute, PagesSetup::$pagesArray)) {
                call_user_func([$this, PagesSetup::$pagesArray[$currRoute]]);
            } else {
                $currRoute = "home";
                $this->view->render($currRoute, []);
            }
        }
    }

    // Functions for routing
    private function login(): void
    {
        $currPage = "login";
        $Logincontroller = new LoginController();
        $this->view->render($currPage, []);
    }

    private function register(): void
    {
        $currPage = "register";
        $Registercontroller = new RegisterController();
        $this->view->render($currPage, []);
    }

    private function dashboard(): void
    {
        $currPage = "dashboard";
        $dashboardController = new DashboardController();
        $dataController = new DataController();

        $numOfAllTickets = $dataController->countAllTickets();
        $numOfClosedTickets =  $dataController->countClosedTickets();

        $ticketPriorityData = $dashboardController->ticketPriorityChartManagment();
        $ticketIssuesData = $dashboardController->issuesChartManagement();

        $this->view->render(
            $currPage,
            [
                "ticketPriorityData" => $ticketPriorityData,
                "ticketIssuesData" => $ticketIssuesData,
                "numOfAllTickets" => $numOfAllTickets,
                "numOfClosedTickets" => $numOfClosedTickets,
            ]
        );
    }

    private function tickets(): void
    {
        $currPage = "tickets";
        $ticketsController = new TicketsController();
        $dataController = new DataController();

        // search and download data
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST["search"])) {
            $tickets = $dataController->search("tickets", "name", $_POST["search"]);
            $this->view->render($currPage, $tickets);
        } else {
            $tickets = $dataController->downloadTicketsData();
            $this->view->render($currPage, $tickets);
        }
    }

    private function ticket(): void
    {
        $currPage = "ticket";
        $ticketsController = new TicketsController();
        $this->view->render($currPage, []);
    }

    private function team(): void
    {
        $currPage = "team";
        $dataController = new DataController();
        if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST["search"])) {
            $data = $dataController->search("users", "username", $_POST["search"]);
            $this->view->render($currPage, $data);
        } else {
            $data = $dataController->downloadUsersData();
            $this->view->render($currPage, $data);
        }
    }

    private function worktime(): void
    {
        $currPage = "worktime";
        $worktimeController = new WorktimeController();
        $dataController = new DataController();
        $data = $dataController->downloadWorktimeData();
        $this->view->render($currPage, $data);
    }
    // Functions for routing


    private function handleAjaxRequest(): void
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id > 0) {
            try {
                $messages = $this->ticketController->downloadTicketMessages($id);
                header('Content-Type: application/json');
                echo json_encode($messages);
            } catch (\Exception $e) {
                header('Content-Type: application/json');
                echo json_encode(['error' => 'An error occurred while fetching messages.']);
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Invalid ticket ID']);
        }
        exit();
    }
}
