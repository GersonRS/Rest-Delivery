<?php

namespace Delivery\Http\Controllers;

use Illuminate\Http\Request;

use Delivery\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Delivery\Http\Requests\PhotoCreateRequest;
use Delivery\Http\Requests\PhotoUpdateRequest;
use Delivery\Repositories\PhotoRepository;
use Delivery\Validators\PhotoValidator;


class PhotosController extends Controller
{

    /**
     * @var PhotoRepository
     */
    protected $repository;

    /**
     * @var PhotoValidator
     */
    protected $validator;

    public function __construct(PhotoRepository $repository, PhotoValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $photos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $photos,
            ]);
        }

        return view('photos.index', compact('photos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PhotoCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PhotoCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $photo = $this->repository->create($request->all());

            $response = [
                'message' => 'Photo created.',
                'data'    => $photo->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $photo = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $photo,
            ]);
        }

        return view('photos.show', compact('photo'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $photo = $this->repository->find($id);

        return view('photos.edit', compact('photo'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PhotoUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(PhotoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $photo = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Photo updated.',
                'data'    => $photo->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Photo deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Photo deleted.');
    }
}
