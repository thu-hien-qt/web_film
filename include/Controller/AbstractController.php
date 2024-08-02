<?php

namespace Controller;

abstract class AbstractController
{
    public function checkPermission() {
        return true;
    }
}