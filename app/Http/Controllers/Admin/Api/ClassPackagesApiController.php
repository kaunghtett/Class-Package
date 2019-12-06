<?php

namespace App\Http\Controllers\Admin\Api;

use App\ClassPackage;
use App\Http\Controllers\Controller;
use App\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Traits\ResponserTrait;
use App\Http\Resources\ClassPackageCollection;
use App\Http\Resources\ClassPackageResource;
use App\Http\Resources\PromocodeResource;
use App\Order;
use App\User;
use stdClass;

// use App\Repositories\ClassPackage\ClassPackageRepository;

class ClassPackagesApiController extends Controller
{
    use ResponserTrait;
    
    public function getAllLists() {
        $classpackges = ClassPackage::paginate(10);

        return new ClassPackageCollection($classpackges);
        // $data = new stdClass();
        // $data->total_item = $classpackges->count();
        // $data->mem_tier = "newbie";
        // $data->total_expired_class = 0;
        // $data->total_page = $classpackges->lastPage();
        // $data->pack_lists = $classpackges;
        // return $this->respondCollection('success',new ClassPackageResource($data));
    }
    
    public function promocodeGenerate(Request $request) {
        
        $token = $request->user()->token();
        $user_id = User::where('id',$token->user_id)->first();
        if($user_id) {
            $classpackge = ClassPackage::where('pack_id',$request->header('pack-id'))->first();
            if($classpackge) {
                $promocode = $this->promocodeStore($classpackge,$token->user_id);
                return $this->respondCollection('promocode here', new PromocodeResource($promocode));
                // return $promocode;
            }else {
                return $this->errorResponse('packages not found');
            }
        }else {
            return $this->respondErrorToken('Token Wrong or User Does not Exit');
        }
        
        
    }
    
    public function orderSubmit(Request $request) {
        $user = $request->user()->token();
        $user_id = User::where('id',$user->user_id)->first();
        if($user_id) {
            $promocode = Promocode::where('promocode',$request->promocode)->first();
            if($promocode) {
                $this->orderStore($request,$user_id->id,true);
                return $this->respondSuccessMsgOnly("Order with Promocode have been Successfully Created");
            } else {
                $this->orderStore($request,$user_id->id,false);
                return $this->respondSuccessMsgOnly("Order without promocode have been successfully created");
            }
        
         }else {
             return $this->respondErrorToken("Token or user doesn't exist");
         }
    }


    public function classpackageGenerate() {
        $package = factory(ClassPackage::class,6)->create();
        return $this->respondSuccessMsgOnly("Successfully Created Packages");
    }
    
    private function orderStore($request,$id,$promocode = false) {
        $classpackge = new ClassPackage();

        $order = new Order();
        $order->promocode = ($promocode == true) ? $request->promocode : null;
        $order->user_id = $id;
        $order->class_package_id = $classpackge->CheckPackage($request->header('pack-id'));
        $order->pack_id = ($order->class_package_id != null) ? $request->header('pack-id') : "no-data";
        $order->actual_price = $request->actual_price;
        $order->save();

    }

    private function promocodeStore($classpackge,$userID) {
        
        $promocode_generate = new Promocode();
        $promocode_generate->class_package_id = $classpackge->id;
        $promocode_generate->user_id = $userID;
        $promocode_generate->pack_id = $classpackge->pack_id;
        $promocode_generate->promocode = Str::random(9);
        $promocode_generate->save();
        return $promocode_generate;
    }
    
}
