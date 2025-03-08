<?php
namespace Modules\FrontendCMS\Repositories;

use App\Traits\ImageStore;
use App\Models\MediaManager;
use Modules\Product\Entities\Brand;
use Modules\Product\Entities\Category;
use Modules\Seller\Entities\SellerProduct;
use Modules\FrontendCMS\Entities\HomePageSection;
use Modules\FrontendCMS\Entities\HomepageCustomBrand;
use Modules\FrontendCMS\Entities\HomepageCustomProduct;
use Modules\FrontendCMS\Entities\HomePageCustomSection;
use Modules\FrontendCMS\Entities\HomepageCustomCategory;
use Illuminate\Support\Facades\File;

class WidgetRepository {
    use ImageStore;

    public function getAll(){

        if(app('theme')->folder_path == 'amazy'){
            $sections =  HomePageSection::where('theme', 'LIKE', '%amazy%')->get();
        }else{
            $sections =  HomePageSection::where('theme', 'LIKE', '%default%')->get();
        }
        return $sections;
        
    }

    public function getBySectionName($data){
        return HomePageSection::where('section_name',$data['value'])->first();
    }
    public function getProducts(){
        return SellerProduct::with('product')->where('status',1)->activeSeller()->get();
    }
    public function getCategories(){
        return Category::where('status',1)->get();
    }
    public function getBrands(){
        return Brand::where('status',1)->get();
    }

    public function update($data){
        // dd($data);
        // File::delete(public_path('images/reviews/1730899245_chart_3.png1730899245_chart_3.png'));


        //   $video = $data['filter_category_video'];
        //   dd($video);
        
          
    
        $homepagesection = HomePageSection::findOrFail($data['id']);

        // Check if a new video file is provided
            if (isset($data['filter_category_video'])) {
                $video = $data['filter_category_video'];
                $videoPath = 'images/reviews';
                $videoName = time() . '_' . str_replace(' ', '_', $video->getClientOriginalName());
                $video->move(public_path($videoPath), $videoName);

                // Delete previous video if it exists
                $videopath = $homepagesection->field_1;
                if (File::exists(public_path('images/reviews/' . $videopath))) {
                    File::delete(public_path('images/reviews/' . $videopath));
                }

                // Update video path in database
                $homepagesection->field_1 = $videoName;
            }

            // Check if a new image file is provided
            if (isset($data['review_image'])) {
                $file = $data['review_image'];
                $filePath = 'images/reviews';
                $fileName = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->move(public_path($filePath), $fileName);

                // Delete previous image if it exists
                $imagepath = $homepagesection->field_2;
                if (File::exists(public_path('images/reviews/' . $imagepath))) {
                    File::delete(public_path('images/reviews/' . $imagepath));
                }

                // Update image path in database
                $homepagesection->field_2 = $fileName;
            }

            // Save only if one of the fields was updated
            $homepagesection->save();




    


         $homepagesection->update([
                'heading' => $data['heading_text_area'],
                'paragraph' => $data['paragraph_text_area']
         ]);

         $homepagesection->update([
            'heading1' => $data['heading_input_1'],
            'heading2' => $data['heading_input_2']
     ]);
         
         $homepagesection->update([
                'paragraph1' => $data['paragraph_text_area1'],
                'paragraph2' => $data['paragraph_text_area2'],
                'heading3' => $data['heading_input_3'],
                'paragraph3' => $data['paragraph_text_area3']
         ]);
        
         $homepagesection->update([
            'heading4' => $data['heading_input_4']
     ]);

     
    //  if ($data['form_for'] == 'top_rating') {
          // Check if a file is uploaded
          



        
        $data['type'] = isset($data['type'])?$data['type']:1;
        $homepagesection->fill($data)->save();
        if($data['form_for'] == 'best_deals' || $data['form_for'] == 'top_picks' || $data['form_for'] == 'more_products' || $data['form_for'] == 'top_ratin' || $data['form_for'] == 'people_choices' || $data['form_for'] == 'max_sale'){
        // if($data['form_for'] == 'best_deals' || $data['form_for'] == 'top_picks' || $data['form_for'] == 'more_products' || $data['form_for'] == 'top_rating' || $data['form_for'] == 'people_choices' || $data['form_for'] == 'max_sale'){
            if (@$data['product_list']) {
                foreach($homepagesection->products as $product){
                    foreach($data['product_list'] as $key => $item){
                        if($product->seller_product_id != $item){
                            $product->delete();
                        }
                    }
                }
                foreach($data['product_list'] as $key => $item){
                    HomepageCustomProduct::where('section_id',$data['id'])->updateOrCreate([
                        'section_id' => $data['id'],
                        'seller_product_id' => $data['product_list'][$key]
                    ]);
                }
            }
        }elseif($data['form_for'] == 'top_brands'){
            if (@$data['brand_list']) {
                foreach($homepagesection->brands as $brand){
                    foreach($data['brand_list'] as $key => $item){
                        if($brand->brand_id != $item){
                            $brand->delete();
                        }
                    }
                }
                foreach($data['brand_list'] as $key => $item){
                    HomepageCustomBrand::where('section_id',$data['id'])->updateOrCreate([
                        'section_id' => $data['id'],
                        'brand_id' => $data['brand_list'][$key]
                    ]);
                }
            }
        }elseif($data['form_for'] == 'feature_categories'){
            if (@$data['category_list']) {
                foreach($homepagesection->categories as $category){
                    foreach($data['category_list'] as $key => $item){
                        if($category->category_id != $item){
                            $category->delete();
                        }
                    }
                }
                foreach($data['category_list'] as $key => $item){
                    HomepageCustomCategory::where('section_id',$data['id'])->updateOrCreate([
                        'section_id' => $data['id'],
                        'category_id' => $data['category_list'][$key]
                    ]);
                }
            }
        }elseif($data['form_for'] == 'filter_category_1' || $data['form_for'] == 'filter_category_2' || $data['form_for'] == 'filter_category_3'){
            $section = HomePageCustomSection::where('section_id', $data['id'])->first();
            if(isset($data['banner_image'])){
                ImageStore::deleteImage($section->field_2);
                $image = ImageStore::saveImage($data['banner_image']);
            }elseif(isset($data['filter_category_image'])){
                $host = activeFileStorage();
                $media_img = MediaManager::find($data['filter_category_image']);
                if($media_img){
                    if($media_img->storage == 'local'){
                        $file = asset_path($media_img->file_name);
                    }else{
                        $file = $media_img->file_name;
                    }
                    $image = ImageStore::saveImage($file);

                    if ($host == 'Dropbox') {
                        $data['meta_image'] = $image['images_source'];
                        $data['meta_file_dropbox'] = $image['file_dropbox'];
                    }else{
                        $data['meta_image'] = $image;
                    }
                    $data['meta_image_id'] = $media_img->id;
                }
            }else{
                $image = $section->field_2;
            }
            $section->update([
                'field_1' => $data['category'],
                'field_2' => $image
            ]);
        }elseif($data['form_for'] == 'discount_banner'){
            $section = HomePageCustomSection::where('section_id', $data['id'])->first();
            if(isset($data['banner_image_1'])){
                ImageStore::deleteImage($section->field_1);
                $image_1 = ImageStore::saveImage($data['banner_image_1']);
            }else{
                $image_1 = $section->field_1;
            }
            if(isset($data['banner_image_2'])){
                ImageStore::deleteImage($section->field_2);
                $image_2 = ImageStore::saveImage($data['banner_image_2']);
            }else{
                $image_2 = $section->field_2;
            }
            if(isset($data['banner_image_3'])){
                ImageStore::deleteImage($section->field_3);
                $image_3 = ImageStore::saveImage($data['banner_image_3']);
            }else{
                $image_3 = $section->field_3;
            }
            $section->update([
                'field_1' => $image_1,
                'field_2' => $image_2,
                'field_3' => $image_3,
                'field_4' => $data['section_1_link'],
                'field_5' => $data['section_2_link'],
                'field_6' => $data['section_3_link'],
            ]);
        }
        return true;

    }

}
