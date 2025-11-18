<?php

namespace App\Http\Controllers\Backend\Auth\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Auth\User\ManageUserRequest;
use App\Models\Auth\User;
 use App\Exceptions\GeneralException;
 use App\Repositories\Backend\Auth\UserRepository;

/**
 * Class UserStatusController.
 */
class UserStatusController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeactivated(ManageUserRequest $request)
    {
        return view('backend.auth.user.deactivated')
            ->withUsers($this->userRepository->getInactivePaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest $request
     *
     * @return mixed
     */
    public function getDeleted(ManageUserRequest $request)
    {
        return view('backend.auth.user.deleted')
            ->withUsers($this->userRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $user
     * @param                   $status
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function mark(ManageUserRequest $request, User $user, $status = null)
    {
        // If the container did not inject the status parameter for some reason,
        // fall back to grabbing it from the route parameters.
        if ($status === null) {
            $status = $request->route('status');
            // Fallback: sometimes route parameters are not populated during tests
            // (route('status') can be null). Parse the last path segment as a
            // best-effort fallback when the route parameter is missing.
            if ($status === null) {
                $segments = explode('/', trim($request->path(), '/'));
                $last = end($segments);
                if (is_numeric($last)) {
                    $status = (int) $last;
                }
            }
        }
        \Illuminate\Support\Facades\Log::error('UserStatusController::mark', [
            'status_arg' => $status,
            'route_status' => $request->route('status'),
            'route_parameters' => $request->route() ? $request->route()->parameters() : null,
            'path' => $request->path(),
            'url' => $request->url(),
            'all' => $request->all(),
        ]);

        // Log final resolved status for diagnostics
        \Illuminate\Support\Facades\Log::info('UserStatusController::mark - final resolved status', [
            'status' => $status,
            'route_params' => $request->route() ? $request->route()->parameters() : null,
            'path' => $request->path(),
        ]);

        try {
            $this->userRepository->mark($user, (int) $status);
        } catch (GeneralException $e) {
            return redirect()->back()->with('flash_danger', $e->getMessage());
        }

        return redirect()->route(
            (int) $status === 1 ?
            'admin.auth.user.index' :
            'admin.auth.user.deactivated'
        )->withFlashSuccess(__('alerts.backend.users.updated'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $deletedUser
     *
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     * @return mixed
     */
    public function delete(ManageUserRequest $request, User $deletedUser)
    {
        $this->userRepository->forceDelete($deletedUser);

        return redirect()->route('admin.auth.user.deleted')->withFlashSuccess(__('alerts.backend.users.deleted_permanently'));
    }

    /**
     * @param ManageUserRequest $request
     * @param User              $deletedUser
     *
     * @throws \App\Exceptions\GeneralException
     * @return mixed
     */
    public function restore(ManageUserRequest $request, User $deletedUser)
    {
        $this->userRepository->restore($deletedUser);

        return redirect()->route('admin.auth.user.index')->withFlashSuccess(__('alerts.backend.users.restored'));
    }
}
