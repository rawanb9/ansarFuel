<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use function PHPUnit\Framework\isEmpty;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(): Factory|View|Application
    {
        return view('certificate.index', ['certificates' => Certificate::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('certificate.create');
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
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();
        Certificate::create([
            'name' => $request->input('name'),
            'is_visible' => $request->input('is_visible', 0),
        ]);
        return redirect()->route('certificate.index')->with('success', 'Certificate Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Certificate $certificate
     * @return Application|Factory|View
     */
    public function show(Certificate $certificate): View|Factory|Application
    {
        $users = $certificate->users;
        return view('certificate.show', ['certificate' => $certificate, 'users' => $users, 'count' => sizeof($users)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Certificate $certificate
     * @return Application|Factory|View
     */
    public function edit(Certificate $certificate): View|Factory|Application
    {
        return view('certificate.edit', ['certificate' => $certificate]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Certificate $certificate
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Certificate $certificate): RedirectResponse
    {
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'is_visible' => ['sometimes', 'boolean'],
        ])->validate();
        if(sizeof($certificate->users)>0 && $certificate->is_visible != $request->input('is_visible',0)){
            return redirect()->route('certificate.index')->with('error', 'Cannot Update Certificate Visibility since It Has Users');
        }
        $certificate->update([
            'name' => $request->input('name'),
            'is_visible' => $request->input('is_visible', 0),
        ]);
        return redirect()->route('certificate.index')->with('success', 'Certificate Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Certificate $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Certificate $certificate)
    {
        //
    }

    /**
     * @return Factory|View|Application
     */
    public function assignIndex(): Factory|View|Application
    {
        $certificates = Auth::user()->certificates()->pluck('certificates.id')->toArray();
        return view('certificate.self-assign',
            ['certificates' => Certificate::all()->where('is_visible', '=', true), 'myCertificates' => $certificates]);
    }

    public function assign(Request $request)
    {
        Validator::make($request->all(), [
            'certificates.*' => ['sometimes', 'digits_between:1,10', 'gt:0', 'exists:certificates,id'],
        ])->validate();

        $user = Auth::user();
        $certificates = $user->certificates();
        $certificates->detach($certificates->pluck('certificates.id')->toArray());
        $certificates->attach($request->input('certificates', []));
        $message = sizeof($request->input('certificates', [])) < 1 ?
            "All Certificates Where Removed." :
            "Your Certificates Has Been Updated.";
        return redirect()->route('certificate.assignIndex')->with('success', $message);
    }
}
