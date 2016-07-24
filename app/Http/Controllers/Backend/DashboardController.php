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
use App\Group;
use App\Destination;
use Input;
use Mockery\CountValidator\Exception;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Backend
 */
class DashboardController extends Controller {

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
	public function __construct(UserContract $users, RoleRepositoryContract $roles, PermissionRepositoryContract $permissions) {
		$this->users = $users;
		$this->roles = $roles;
		$this->permissions = $permissions;
	}
	public function index()
	{
		return view('backend.dashboard');
	}

	public function users()
	{
		return view('backend.users')
			->withUsers($this->users->getUsersPaginated(config('access.users.default_per_page'), 1));


	}

	/**
	 * @param $id
	 * @param EditUserRequest $request
	 * @return mixed
	 */
	public function edit_user($id) {
		$user = $this->users->findOrThrowException($id, true);
		$user_groups = explode('|', $user->group_names);
		$group = Group::getAllWithUserGroup($user_groups);

		$user_dests = explode('|', $user->dest_id);
		$destination = Destination::getAllWithUserDestination($user_dests);

		$sfUsers = explode(',', $user->access_5000);
		$sfPermission = Group::getAllSFPermissionWtihUser($sfUsers);

		$prUsers = explode(',', $user->access_5045);
		$prPermission = Group::getAllPRPermissionWtihUser($prUsers);

		return view('backend.edit-user', ['user' => $user, 'group'=>$group, 'destination'=>$destination, 'sfPermission'=>$sfPermission, 'prPermission'=>$prPermission]);
	}

	public function update_user() {
		$formData = Input::all();

		try{
			$this->users->updateUser($formData['id'],
				$this->prepareData($formData)
			);
		}catch(Exception $e) {
			return response()->json(['error'=>$e->getMessage()]);
		}
		return response()->json(['success'=>'ok']);

		//print_r($formData);
	}

	private function prepareData($data) {
		$result = [];
		unset($data['id']);
		foreach($data as $key=>$row) {

			if (!is_array($row) && strlen($row)==0){
				continue;
			}

			if($key =='auto_filer' || $key =='auto_search'|| $key =='access_5000' || $key =='access_5045') {
				$result[$key]= implode(',',$data[$key]);
			} else if($key =='group_names' || $key =='dest_id') {
				$result[$key]= implode('|',$data[$key]);
			}else{
				$result[$key] = $row;
			}

		}
		return $result;

	}
}