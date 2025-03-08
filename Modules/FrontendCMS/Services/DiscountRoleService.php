<?php

namespace Modules\FrontendCMS\Services;
use \Modules\FrontendCMS\Repositories\DiscountRoleRepository;

class DiscountRoleService{

    protected $discountRoleRepository;
    public function __construct(DiscountRoleRepository $discountRoleRepository)
    {
        $this->discountRoleRepository = $discountRoleRepository;
    }
    public function save($data)
    {
        return $this->discountRoleRepository->save($data);
    }
    public function update($data)
    {
        return $this->discountRoleRepository->update($data);
    }
    public function getAll($id = null)
    {
        return $this->discountRoleRepository->getAll($id);
    }
    public function getAllActive()
    {
        return $this->pricingPlanRepository->getAllActive();
    }
    public function deleteById($id)
    {
        return $this->discountRoleRepository->delete($id);
    }
    public function showById($id)
    {
        return $this->discountRoleRepository->show($id);
    }
    public function editById($id){
        return $this->discountRoleRepository->edit($id);
    }
    public function statusUpdate($data, $id){
        return $this->discountRoleRepository->statusUpdate($data, $id);
    }
}
