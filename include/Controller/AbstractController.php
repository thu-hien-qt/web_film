<?php

namespace App\Controller;

abstract class AbstractController
{
    public function checkPermission() {
        return true;
    }
}