<?php
namespace App\Service;

interface BaseService {
    public function create($data);
    public function delete($id);
}