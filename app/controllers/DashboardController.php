<?php
// /app/controllers/DashboardController.php

class DashboardController {
    public function index() {
        // RUTA FINAL CORREGIDA: Usa DOCUMENT_ROOT y el nombre de tu carpeta de proyecto
        require_once $_SERVER['DOCUMENT_ROOT'] . '/MOONLIGHT/public/views/dashboard.php';
    }
}