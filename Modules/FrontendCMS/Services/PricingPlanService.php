<?php

namespace Modules\FrontendCMS\Services;
use \Modules\FrontendCMS\Repositories\PricingPlanRepository;

class PricingPlanService{

    protected $pricingPlanRepository;
    public function __construct(PricingPlanRepository $pricingPlanRepository)
    {
        $this->pricingPlanRepository = $pricingPlanRepository;
    }
    public function save($data)
    {
        return $this->pricingPlanRepository->save($data);
    }
    public function update($data)
    {
        return $this->pricingPlanRepository->update($data);
    }
    public function getAll()
    {
        return $this->pricingPlanRepository->getAll();
    }
    public function getAllActive()
    {
        return $this->pricingPlanRepository->getAllActive();
    }
    public function deleteById($id)
    {
        return $this->pricingPlanRepository->delete($id);
    }
    public function showById($id)
    {
        return $this->pricingPlanRepository->show($id);
    }
    public function editById($id){
        return $this->pricingPlanRepository->edit($id);
    }
    public function statusUpdate($data, $id){
        return $this->pricingPlanRepository->statusUpdate($data, $id);
    }
}
