<?php namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\User\UserContract;
use App\Repositories\Backend\Role\RoleRepositoryContract;
use App\Repositories\Frontend\Auth\AuthenticationContract;
use App\Http\Requests\Backend\Access\User\CreateUserRequest;
use App\Http\Requests\Backend\Access\User\StoreUserRequest;
use App\Http\Requests\Backend\Access\User\EditUserRequest;
use App\Http\Requests\Backend\Access\User\MarkUserRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserRequest;
use App\Http\Requests\Backend\Access\User\DeleteUserRequest;
use App\Http\Requests\Backend\Access\User\RestoreUserRequest;
use App\Http\Requests\Backend\Access\User\ChangeUserPasswordRequest;
use App\Http\Requests\Backend\Access\User\UpdateUserPasswordRequest;
use App\Repositories\Backend\Permission\PermissionRepositoryContract;
use App\Http\Requests\Backend\Access\User\PermanentlyDeleteUserRequest;
use App\Http\Requests\Backend\Access\User\ResendConfirmationEmailRequest;
use App\Brand;
use Input;
use Validator;
use Redirect;
use Request;
use Session;
use Mockery\CountValidator\Exception;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class BrandController extends Controller
{

    /**
     * @var UserContract
     */
    protected $users;

    /**
     * @var RoleRepositoryContract
     */
    protected $roles;

    /**
     * @var PermissionRepositoryContract
     */
    protected $permissions;

    /**
     * @param UserContract $users
     * @param RoleRepositoryContract $roles
     * @param PermissionRepositoryContract $permissions
     */
    public function __construct(UserContract $users, RoleRepositoryContract $roles, PermissionRepositoryContract $permissions)
    {
        $this->users = $users;
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    public function index($id)
    {
        $brand = Brand::where('user_id', $id)->first();

        return view('backend.brand',['brand'=>$brand, 'user_id'=>$id]);
    }
    public function save()
    {

        // getting all of the post data
        $file = array('image' => Input::file('brand_image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('/admin/brands/'.Input::get('user_id'))->withInput()->withErrors($validator);
        }
        else {
            Brand::where('user_id', Input::get('user_id'))->delete();
            // checking file is valid.
            if (Input::file('brand_image')->isValid()) {
                $destinationPath = 'brand'; // upload path
                $extension = Input::file('brand_image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                Input::file('brand_image')->move($destinationPath, $fileName); // uploading file to given path
                $brand = new Brand(['user_id'=>Input::get('user_id'), 'path'=>$destinationPath.'/'.$fileName, 'name'=>$fileName, 'hashtag'=>Input::get('hashtag')]);
                $brand->save();
                //Brand::save(['user_id'=>Input::get('user_id'), 'path'=>$destinationPath, 'name'=>$fileName, 'hashtag'=>Input::get('hashtag')]);
                // sending back with message
                Session::flash('success', 'Upload successfully');
                return Redirect::to('/admin/brands/'.Input::get('user_id'));
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('/admin/brands/'.Input::get('user_id'));
            }
        }
    }

    public function delete($user_id, $id) {
        $brand = Brand::find($id);
        if ($brand){
            $brand->delete();
            Session::flash('success', 'Delete successfully');
            return Redirect::to('/admin/brands/'.$user_id);
        } else{
            Session::flash('error', 'Can\'t delete');
            return Redirect::to('/admin/brands/'.$user_id);
        }

    }


}