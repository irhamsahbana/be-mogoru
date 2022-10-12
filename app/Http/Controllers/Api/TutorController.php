<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Validation\Rule;

use App\Libs\Response;

use App\Http\Repositories\Tutor;
use App\Http\Services\TutorService;

class TutorController extends Controller
{
    public function index()
    {
        //
    }

    public function upsert(Request $request)
    {
        $response = new Response();
        $fields = $request->all();

        $this->filterByAccessControl('tutor-create');

        $rules = [
            'id' => 'required|uuid',
            'name' => 'required|string',
            'city_id' => ['required', 'uuid',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('group_by', 'cities');
                }),
            ],
            'address' => 'required|string',
            'phone' => 'required|string|min:4',
            'email' => 'required|email:rfc,dns',
            'bio' => 'required|string',
            'social_medias' => 'nullable|array',
            'course_ids' => ['required', 'array', 'min:1'],
            'course_ids.*' => ['uuid',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('group_by', 'courses');
                }),
            ],
            'course_level_ids' =>  ['required', 'array','min:1'],
            'course_level_ids.*' => ['uuid',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('group_by', 'course_levels');
                }),
            ],
            'schedules' => 'required|array|min:1',
            'fee' => 'required|numeric',
        ];

        $validator = Validator::make($fields, $rules);

        if ($validator->fails()) {
            return $response->json(
                null,
                $validator->errors(),
                HttpResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        $repository = new Tutor();
        $service = new TutorService($repository);
        $data = $service->upsert((object) $fields);

        return $response->json($data, 'ok');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
