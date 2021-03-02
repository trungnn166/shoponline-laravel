<?php
namespace App\Service;

interface BaseService {
    public function create($data);
    public function destroy($id);
    public function update($id);
    public function getData($params);
    public function changeStatus($id);
    public function findByUrl($url);
    public function getByStatus($status);
}