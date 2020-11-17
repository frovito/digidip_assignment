<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ModerationMail;
use App\Job;

use Redirect, Response;

class JobsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::where('status','Published')->get();
        return view('pages.jobs')->with("jobs",$jobs);
    }
    
    public function moderate($id)
    {
        // Accept or decline proposal
        
        $job = Job::find($id);
        $job->status = "Published";
        $job->save();
        return redirect('jobs');
        //return view('pages.jobs')->with("jobs",$jobs);
    }
    
    
    public function spam($id)
    {
        // Accept or decline proposal
        
        $job = Job::find($id);
        $job->status = "Spam";
        $job->save();
        return redirect('jobs');
        //return view('pages.jobs')->with("jobs",$jobs);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.jobs_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'email' => 'required|email'
        ]);

        $exists = Job::where('email',$data['email'])->get();
        if($exists->count() == 0){
            // Email
            $data['status'] = "Moderate";
        }

        $success = Job::create($data);
        
        $data['id'] = $success->id;
        Mail::to('fer.rovito@gmail.com')->send(new ModerationMail($data));

        return redirect('jobs');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
