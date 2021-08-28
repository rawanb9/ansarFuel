<?php

namespace App\Http\Controllers;

use App\Models\BloodType;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class BloodTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('blood-types.index', ['bloodTypes' => BloodType::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('blood-types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();
        BloodType::create([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('blood-type.index')->with('success', 'Blood Type Created Successfully');

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param BloodType $bloodType
     * @return Application|Factory|View
     */
    public function edit(BloodType $bloodType): View|Factory|Application
    {
        return view('blood-types.edit', ['bloodType' => $bloodType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param BloodType $bloodType
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, BloodType $bloodType): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();
        $bloodType->update([
            'name' => $request->input('name'),
        ]);
        return redirect()->route('blood-type.index')
            ->with('success', 'Blood Type Updated Successfully');
    }


    /**
     * @return Factory|View|Application
     */
    public function assignIndex(): Factory|View|Application
    {
        return view('blood-types.self-assign',
            ['bloodTypes' => BloodType::all(), 'myBloodType' => Auth::user()->blood_type_id]);
    }

    public function assign(Request $request)
    {
        Validator::make($request->all(), [
            'blood_type' => ['required', 'digits_between:1,10', 'gt:0', 'exists:blood_types,id'],
        ])->validate();

        $user = Auth::user();
        $user->blood_type_id = $request->input('blood_type');
        $user->save();

        return redirect()->route('profile.show')->with('success', "Your Blood Type Has Been Updated.");
    }
}
