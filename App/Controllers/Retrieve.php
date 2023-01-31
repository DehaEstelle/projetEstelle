<?php

require_once("../App/Controllers/SalleController.php");
require_once("../App/Controllers/ServiceController.php");
require_once("../App/Controllers/RegisterController.php");
require_once("../App/Controllers/validators/EventValidator.php");

class Retrieve {
    public function home() {
        require("../App/Views/users/login.php");
    }

    public function index() {
        require("../App/Views/users/usersPage.php");
    }

    public function addUsers() {
        require("../App/Views/admin/usersPage.php");
    }

    public function showAdmin() {
        require("../App/Views/admin/admin.php");
    }

    public function addService() {
        $stmt = new ServiceController();
        $arr = $stmt->showService();
        require("../App/Views/admin/servicePage.php");
    }

    public function addSalle() {
        $stmt = new SalleController();
        $arr = $stmt->showSalle();
        require("../App/Views/admin/sallePage.php");
    }

    public function addPlanning() {
        require("../App/Views/users/planningPage.php");
    }

    public function addEvent() {
        $controleur = new RegisterController();
        $stmt = $controleur->selectSalleUser();
        $service = $controleur->selectServiceUser();
        require("../App/Views/users/addEvent.php");
    }

    public function detailPlanning() {
        require("../App/Views/users/detailPlanning.php");
    }

    public function modify() {
        require("../App/Views/admin/modify_users.php");
    }

} 