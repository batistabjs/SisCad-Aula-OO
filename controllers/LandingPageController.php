<?php
// controllers/LandingPageController.php

class LandingPageController {
    public function index() {
        // A landing page geralmente não usa o cabeçalho padrão do sistema (menu) 
        // para ter um visual mais limpo e focado em conversão.
        include "views/landing-page.php";
    }
}
