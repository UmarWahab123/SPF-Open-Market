<?php

namespace Modules\Product\Services;
use \Modules\Product\Repositories\CategoryRepository;

class CategoryService{

    protected $categoryRepository;

    public function __construct(CategoryRepository  $categoryRepository)
    {
        $this->categoryRepository= $categoryRepository;
    }

    public function getModel()
    {
        return $this->categoryRepository->getModel();
    }

    public function category()
    {
        return $this->categoryRepository->category();
    }

    public function subcategory($id)
    {
        return $this->categoryRepository->subcategory($id);
    }

    public function allSubCategory()
    {
        return $this->categoryRepository->allSubCategory();
    }

    public function getAllSubSubCategoryID($id){
        return $this->categoryRepository->getAllSubSubCategoryID($id);
    }

    public function save($data)
    {
        return $this->categoryRepository->save($data);
    }

    public function update($data,$id)
    {
        return $this->categoryRepository->update($data, $id);
    }

    public function getAll()
    {
        return $this->categoryRepository->getAll();
    }
    public function getData(){
        return $this->categoryRepository->getData();
    }
    public function getActiveAll(){
        return $this->categoryRepository->getActiveAll();
    }

    public function getCategoryByTop(){
        return $this->categoryRepository->getCategoryByTop();
    }


    public function deleteById($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function showById($id)
    {
        return $this->categoryRepository->show($id);
    }

    public function editById($id){
        return $this->categoryRepository->edit($id);
    }
    public function checkParentId($id){
        return $this->categoryRepository->checkParentId($id);
    }

    public function findBySlug($slug)
    {
        return $this->categoryRepository->findBySlug($slug);
    }

    public function csvUploadCategory($data)
    {
        return $this->categoryRepository->csvUploadCategory($data);
    }

    public function csvDownloadCategory()
    {
        return $this->categoryRepository->csvDownloadCategory();
    }

    public function firstCategory(){
        return $this->categoryRepository->firstCategory();
    }
    public function statusUpdate($data, $id){
        return $this->categoryRepository->statusUpdate($data, $id);
    }

}
