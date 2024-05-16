<?php

declare(strict_types=1);

require_once("controllers/RequestController.php");
require_once("controllers/View.Controller.php");

class RoutingController
{
    const PAGES_ARRAY = ["home", "login"];
    const HOME_PAGE = "home";
    private ViewController $view;
    private RequestController $request;

    public function __construct()
    {
        $this->view = new ViewController();
        $this->request = new RequestController();
    }

    public function run(): void
    {
        $currRoute = $this->request->getParams();
        $currPage = $this->determineRoute($currRoute);
        $this->view->render($currPage);
    }


    public function determineRoute(string $currRoute = self::HOME_PAGE): string
    {
        if (in_array($currRoute, self::PAGES_ARRAY, true)) {
            return $currRoute;
        }
        return self::HOME_PAGE;
    }
}
