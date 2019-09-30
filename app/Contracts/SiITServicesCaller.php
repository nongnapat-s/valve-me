<?php

namespace App\Contracts;

interface SiITServicesCaller
{
    public function authenticate($orgId, $password);

    public function getAdmission($an);

    public function getPatient($hn);

    public function getUser($orgId);
}
