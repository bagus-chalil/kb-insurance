<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class CSRFController extends ResourceController
{
    public function getToken()
    {
        return $this->respond(['csrfToken' => csrf_hash()]);
    }
}
