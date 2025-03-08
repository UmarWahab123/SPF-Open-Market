<?php

namespace Modules\FrontendCMS\Repositories;
use Modules\FrontendCMS\Entities\DiscountRole;
class DiscountRoleRepository {

    protected $discountRole;
    public function __construct(DiscountRole $discountRole){
        $this->discountRole = $discountRole;
    }
    public function getAll($id = null)
    {
        if ($id) {
            return $this->discountRole::where('pricing_plan_id', $id)->get();
        }else{
            return $this->discountRole::all();
        } 
    }
    public function getAllActive()
    {
        return $this->discountRole::where('status',1)->get();
    }
    public function save($data)
    {
        $discountRole = DiscountRole::create([
            'pricing_plan_id' => $data['pricing_plan_id'],
            'start_price' => $data['start_price'],
            'end_price' => $data['end_price'],
            'discount' => isset($data['discount']) ? $data['discount'] : null,
            'status' => $data['status'],
        ]);
    
        return $discountRole;
    }
    
    public function update($data)
    {
        $discountRole = DiscountRole::findOrFail($data['id']);

        return $discountRole->update([
            'pricing_plan_id' => $data['pricing_plan_id'],
            'start_price' => $data['start_price'],
            'end_price' => $data['end_price'],
            'discount' => isset($data['discount']) ? $data['discount'] : null,
            'status' => $data['status'],
        ]);

    }
    
    public function delete($id){
        $discountRole = $this->discountRole->findOrFail($id);
        $discountRole->delete();
        return $discountRole;
    }
    public function show($id){
        $discountRole = $this->discountRole->findOrFail($id);
        return $discountRole;
    }
    public function edit($id){
        $discountRole = $this->discountRole->findOrFail($id);
        return $discountRole;
    }
    public function statusUpdate($data, $id){
        return $this->discountRole::where('id',$id)->update([
            'status' => $data['status']
        ]);
    }
}
