<?php

namespace App\Http\Controllers\Backend;

use App\Exceptions\GeneralException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Meeting;
use App\Models\Auth\User;
use App\Models\Host;
use App\Models\Status;
use App\Repositories\Backend\MeetingRepository;
use App\Http\Requests\Backend\Meeting\ManageMeetingRequest;
use App\Http\Requests\Backend\Meeting\StoreMeetingRequest;
use App\Http\Requests\Backend\Meeting\UpdateMeetingRequest;

use App\Events\Backend\Meeting\MeetingCreated;
use App\Events\Backend\Meeting\MeetingUpdated;
use App\Events\Backend\Meeting\MeetingDeleted;

use DataTables;
use Illuminate\Http\Request as HttpRequest;

class MeetingController extends Controller
{
    /**
     * @var MeetingRepository
     */
    protected $meetingRepository;

    /**
     * MeetingController constructor.
     *
     * @param MeetingRepository $meetingRepository
     */
    public function __construct(MeetingRepository $meetingRepository)
    {
        $this->meetingRepository = $meetingRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ManageMeetingRequest $request
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(ManageMeetingRequest $request)
    {
        if ($request->ajax()) {
            if ($request->has('draw')) {

                $query = Meeting::selectRaw(
                    'meetings.*,' .
                    'CONCAT(u.first_name, " ", u.last_name) as requested_by_name,' .
                    'h.name as host_name,' .
                    's.name as status_name'
                )
                    ->leftJoin('users as u', 'meetings.requested_by', '=', 'u.id')
                    ->leftJoin('hosts as h', 'meetings.hosts_id', '=', 'h.id')
                    ->leftJoin('statuses as s', 'meetings.statuses_id', '=', 's.id');

                return DataTables::of($query)
                    ->editColumn('request_number', function ($row) {
                        return '<span class="sortable"><a href="' . route('admin.meetings.show', $row) . '">' . $row->request_number . "</a></span>";
                    })
                    ->addColumn('requested_by', function ($row) {
                        return $row->requested_by_name ?? '';
                    })
                    ->addColumn('date_requested', function ($row) {
                        return $row->date_requested ?? '';
                    })
                    ->addColumn('topic', function ($row) {
                        return $row->topic ?? '';
                    })
                    ->addColumn('date_scheduled', function ($row) {
                        return $row->date_scheduled ?? '';
                    })
                    ->addColumn('time_start', function ($row) {
                        return $row->time_start ?? '';
                    })
                    ->addColumn('time_end', function ($row) {
                        return $row->time_end ?? '';
                    })
                    ->addColumn('hosts', function ($row) {
                        return $row->host_name ?? '';
                    })
                    ->addColumn('status', function ($row) {
                        return $row->status_name ?? '';
                    })
                    ->addColumn('action', function ($row) {
                        return (auth()->user()->can('View Meeting') ? $row->getShowButtonAttribute() : '') . 
                        (auth()->user()->can('Update Meeting') ? $row->getEditButtonAttribute() : '') . 
                        (auth()->user()->can('Delete Meeting') ? $row->getDeleteButtonAttribute() : '');
                    })
                    ->rawColumns(['request_number','action'])
                    ->make(true);
            }
        }

        return view('backend.meeting.index')
            ->withmeetings($this->meetingRepository->getActivePaginated(25, 'id', 'asc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param ManageMeetingRequest    $request
     *
     * @return mixed
     */
    public function create(ManageMeetingRequest $request)
    {
        $nextRequestNumber = Meeting::generateRequestNumber();

        $now = now();
        $defaultDateRequested = $now->toDateString();
        $defaultDateScheduled = $now->toDateString();
        $defaultTimeStart = $now->format('H:i');
        $defaultTimeEnd = $now->copy()->addHour()->format('H:i');
        // Load selects here (controller-level)
        $users = User::orderBy('first_name')->orderBy('last_name')->get()->pluck('full_name', 'id')->toArray();
        $hosts = Host::orderBy('name')->pluck('name', 'id')->toArray();
        $statuses = Status::where('status_type', 'meeting')->orderBy('name')->pluck('name', 'id')->toArray();

        return view('backend.meeting.create', compact(
            'nextRequestNumber',
            'defaultDateRequested',
            'defaultDateScheduled',
            'defaultTimeStart',
            'defaultTimeEnd',
            'users',
            'hosts',
            'statuses'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMeetingRequest $request
     *
     * @return mixed
     * @throws \Throwable
     */
    public function store(StoreMeetingRequest $request)
    {
        try {
            $input = $request->all();
            $sendEmail = isset($input['send_email']) && $input['send_email'];
            // Remove send_email from payload so it is not inserted into meetings table
            if (array_key_exists('send_email', $input)) {
                unset($input['send_email']);
            }

            $meeting = $this->meetingRepository->create($input);

            // Send email to requester if requested and email is available
            if ($sendEmail) {
                // Try to resolve requester email
                $user = User::find($meeting->requested_by);
                if ($user && $user->email) {
                    try {
                        \Mail::to($user->email)->send(new \App\Mail\MeetingCreatedMail($meeting));
                    } catch (\Exception $e) {
                        // swallow email exceptions but log
                        logger()->error('Failed to send meeting created email: ' . $e->getMessage());
                    }
                }
            }

            // Fire create event (MeetingCreated)
            event(new MeetingCreated($meeting));

            return redirect()->route('admin.meetings.index')
                ->withFlashSuccess(__('backend_meetings.alerts.created'));
        } catch (\App\Exceptions\GeneralException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param ManageMeetingRequest  $request
     * @param Meeting               $meeting
     *
     * @return mixed
     */
    public function show(ManageMeetingRequest $request, Meeting $meeting)
    {
        return view('backend.meeting.show')->withMeeting($meeting);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param ManageMeetingRequest $request
     * @param Meeting              $meeting
     *
     * @return mixed
     */
    public function edit(ManageMeetingRequest $request, Meeting $meeting)
    {
        $users = User::orderBy('first_name')->orderBy('last_name')->get()->pluck('full_name', 'id')->toArray();
        $hosts = Host::orderBy('name')->pluck('name', 'id')->toArray();
        $statuses = Status::where('status_type', 'meeting')->orderBy('name')->pluck('name', 'id')->toArray();

        return view('backend.meeting.edit', compact('meeting', 'users', 'hosts', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateMeetingRequest  $request
     * @param Meeting               $meeting
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function update(UpdateMeetingRequest $request, Meeting $meeting)
    {
        try {
            $input = $request->all();
            $sendEmail = isset($input['send_email']) && $input['send_email'];
            if (array_key_exists('send_email', $input)) {
                unset($input['send_email']);
            }

            $updated = $this->meetingRepository->update($meeting, $input);

            // Send email to requester if requested and email is available
            if ($sendEmail) {
                $user = User::find($updated->requested_by);
                if ($user && $user->email) {
                    try {
                        \Mail::to($user->email)->send(new \App\Mail\MeetingCreatedMail($updated));
                    } catch (\Exception $e) {
                        logger()->error('Failed to send meeting updated email: ' . $e->getMessage());
                    }
                }
            }

            // Fire update event (MeetingUpdated)
            event(new MeetingUpdated($updated));

            return redirect()->route('admin.meetings.index')
                ->withFlashSuccess(__('backend_meetings.alerts.updated'));
        } catch (\App\Exceptions\GeneralException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors([$e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ManageMeetingRequest $request
     * @param Meeting              $meeting
     *
     * @return mixed
     * @throws \Exception
     */
    public function destroy(ManageMeetingRequest $request, Meeting $meeting)
    {
        $toDelete = $meeting;
        $this->meetingRepository->deleteById($meeting->id);

        // Fire delete event (MeetingDeleted)
        event(new MeetingDeleted($toDelete));

        return redirect()->route('admin.meetings.deleted')
            ->withFlashSuccess(__('backend_meetings.alerts.deleted'));
    }

    /**
     * Permanently remove the specified resource from storage.
     *
     * @param ManageMeetingRequest $request
     * @param Meeting              $deletedMeeting
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     * @throws \Throwable
     */
    public function delete(ManageMeetingRequest $request, $deletedMeeting)
    {
        // $this->meetingRepository->forceDelete($deletedMeeting);
        $deletedMeeting->forceDelete();

        return redirect()->route('admin.meetings.index')
            ->withFlashSuccess(__('backend_meetings.alerts.deleted_permanently'));
    }

    /**
     * @param ManageMeetingRequest $request
     * @param Meeting              $deletedMeeting
     *
     * @return mixed
     * @throws \App\Exceptions\GeneralException
     */
    public function restore(ManageMeetingRequest $request, Meeting $deletedMeeting)
    {
        $this->meetingRepository->restore($deletedMeeting);

        return redirect()->route('admin.meetings.index')
            ->withFlashSuccess(__('backend_meetings.alerts.restored'));
    }

    /**
     * Display a listing of deleted items of the resource.
     *
     * @param ManageMeetingRequest $request
     *
     * @return mixed
     */
    public function deleted(ManageMeetingRequest $request)
    {
        return view('backend.meeting.deleted')
            ->withmeetings($this->meetingRepository->getDeletedPaginated(25, 'id', 'asc'));
    }

    /**
     * Return meetings as calendar events (JSON) for FullCalendar.
     * Expects optional `start` and `end` query params (YYYY-MM-DD).
     *
     * @param HttpRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function events(HttpRequest $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');

        $query = Meeting::selectRaw(
            'meetings.id, meetings.request_number, meetings.topic, meetings.date_scheduled, meetings.time_start, meetings.time_end, CONCAT(u.first_name, " ", u.last_name) as requested_by_name, h.name as host_name'
        )
            ->leftJoin('users as u', 'meetings.requested_by', '=', 'u.id')
            ->leftJoin('hosts as h', 'meetings.hosts_id', '=', 'h.id');

        if ($start && $end) {
            $query->whereBetween('date_scheduled', [$start, $end]);
        }

        $meetings = $query->get();

        $events = $meetings->map(function ($m) {
            $date = $m->date_scheduled;
            $startTime = $m->time_start ?? '09:00';
            $endTime = $m->time_end ?? null;

            $start = $date . 'T' . $startTime;
            if ($endTime) {
                $end = $date . 'T' . $endTime;
            } else {
                // default 1 hour
                $end = date('Y-m-d\TH:i', strtotime($date . ' ' . $startTime . ' +1 hour'));
            }

            return [
                'id' => $m->id,
                'title' => ($m->request_number ? $m->request_number . ' - ' : '') . ($m->topic ?? 'Meeting'),
                'start' => $start,
                'end' => $end,
                'url' => route('admin.meetings.show', $m->id),
                'extendedProps' => [
                    'host' => $m->host_name,
                    'requested_by' => $m->requested_by_name,
                ],
            ];
        })->values();

        return response()->json($events);
    }
}