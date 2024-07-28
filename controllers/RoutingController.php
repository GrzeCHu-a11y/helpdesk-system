<?php

declare(strict_types=1);

namespace Controllers;

use Controllers\RequestController;
use Controllers\ViewController;
use Controllers\TicketsController;

class RoutingController
{
    const PAGES_ARRAY = ["home", "login", "dashboard", "register", "tickets", "worktime", "team", "experimental"];
    const SUB_PAGES_ARRAY = ["ticket"];
    const HOME_PAGE = "home";
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
        $currPage = $this->determineRoute($currRoute);

        if ($currPage === 'ticket' && isset($_GET['ajax']) && $_GET['ajax'] == '1') {
            $this->handleAjaxRequest();
        } else {

            switch ($currPage) {
                case 'login':
                    $currPage = "login";
                    $controller = new LoginController();
                    $this->view->render($currPage, []);
                    break;
                case 'register':
                    $currPage = "register";
                    $controller = new RegisterController();
                    $this->view->render($currPage, []);
                    break;
                case 'dashboard':
                    $currPage = "dashboard";
                    $controller = new DashboardController();
                    $this->view->render($currPage, []);
                    break;
                case 'tickets':
                    $currPage = "tickets";
                    $controller = new TicketsController();
                    $dataController = new DataController();

                    // search and download data
                    if ($_SERVER["REQUEST_METHOD"] === 'POST' && !empty($_POST["search"])) {
                        $data = $dataController->search("tickets", "name", $_POST["search"]);
                        $this->view->render($currPage, $data);
                    } else {
                        $data = $dataController->downloadTicketsData();
                        $this->view->render($currPage, $data);
                    }


                    break;
                case 'ticket':
                    $currPage = "ticket";
                    $controller = new TicketsController();
                    $this->view->render($currPage, []);
                    break;
                case 'team':
                    $currPage = "team";
                    $controller = new DataController();
                    $data = $controller->downloadUsersData();
                    $this->view->render($currPage, $data);
                    break;
                case 'worktime':
                    $currPage = "worktime";
                    $controller = new WorktimeController();
                    $dataController = new DataController();
                    $data = $dataController->downloadWorktimeData();
                    $this->view->render($currPage, $data);
                    break;

                default:
                    $currPage = "home";
                    $this->view->render($currPage, []);
                    break;
            }
        }
    }

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

    public function determineRoute(string $currRoute = self::HOME_PAGE): string
    {
        if (in_array($currRoute, array_merge(self::PAGES_ARRAY, self::SUB_PAGES_ARRAY))) {
            return $currRoute;
        }
        return self::HOME_PAGE;
    }
}
