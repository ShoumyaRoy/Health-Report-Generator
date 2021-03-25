<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Report;
use PDF;
use View;

class Controller extends BaseController
{
public function index(Request $request) {
	// $company_name = \DB::table('reports')->value('CName','Logo')->toArray();
	$posts = Report::all()->toArray();
	$CNameArray = array();
	$LogoArray = array();
// $posts->each(function($post) // foreach($posts as $post) { }
// {
    // dd($posts[0]['CName']);
// });
	// dd($posts);
	foreach ($posts as $comp) {
		// print_r($comp['CName']);
		array_push($CNameArray, $comp['CName']);
		array_push($LogoArray, $comp['Logo']);
		// print($comp['CName']);
	}
	// print_r($LogoArray[0]);
	return View::make('index')->with("LogoArray",$LogoArray)->with("CNameArray",$CNameArray);//->header('Content-Type', $company_name);
}

public function submit(request $request) {
// \DB::insert("INSERT INTO reports(Name, Email, Phone, Message) 
// 	VALUES(?, ?, ?, ?)", 
// 	[
// $request->input('Name'),
// $request->input('Email'),
// $request->input('Phone'),
// $request->input('Message')
// ]);
// \DB::insert("INSERT INTO reports(CName, Logo, DName, DContact, PFName, PLName, PDOB, PContact, Complaint, Consultation) 
// 	VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
// 	[
// $request->input('CName'),
// $request->input('Logo'),
// $request->input('DName'),
// $request->input('DContact'),
// $request->input('PFName'),
// $request->input('PLName'),
// $request->input('PDOB'),
// $request->input('PContact'),
// $request->input('Complaint'),
// $request->input('Consultation'),
// ]);
// return redirect()->action('Controller@index')->with('status', 'Your Message Sent Successfully !');
	// $count = 0;
	$reports = new Report();
	// dd($reports->Logo);

       request()->validate([
            'Logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ]);
   // var_dump(if($request->file('Logo')));
   if ($files = $request->file('Logo')) {
       // dd($files->getClientOriginalExtension());
       $destinationPath = 'logo/'; // upload path
       $imagename = 'Logo'.".".request('CName').".".date('YmdHis').".".$files->getClientOriginalExtension();
       $files->move($destinationPath, $imagename);
       $reports->Logo = $imagename;
    }
 	// dd("fail");
 	// $reports->Rid = $count++;
    $reports->CName = request('CName');
	// $reports->Logo = request('Logo');
    $reports->DName = request('DName');
    $reports->DContact = request('DContact');
    $reports->PFName = request('PFName');
    $reports->PLName = request('PLName');
    $reports->PDOB = request('PDOB');
    $reports->PContact = request('PContact');
    $reports->Complaint = request('Complaint');
    $reports->Consultation = request('Consultation');
    // dd($reports);
    $reports->save();
	$reports = $reports->toArray();
    $pdf = PDF::loadView('pdf', compact('reports'));
    $name = 'CR_'.$reports['PLName'].'_'.$reports['PFName'].'_'.$reports['PDOB'].'.pdf';
    return $pdf->download($name);
        // return redirect('/index');
}

public function table(Request $request) {
	// $company_name = \DB::table('reports')->value('CName','Logo')->toArray();
	// $posts = Report::all()->toArray();
	$posts = Report::select('Rid','CName','Logo','DName','DContact','PFName','PLName','PDOB','PContact','Complaint','Consultation')->get()->toArray();
	return View::make('table')->with("posts",$posts);
}

public function download($rid) {
	// $company_name = \DB::table('reports')->value('CName','Logo')->toArray();
	// $posts = Report::all()->toArray();
	// $reports = Report::find()->where('Rid', $rid)->toArray();
	$reports = Report::where('Rid', '=', $rid)->get()->toArray()[0];
	$pdf = PDF::loadView('pdf', compact('reports'));
    $name = 'CR_'.$reports['PFName'].'_'.$reports['PFName'].'_'.$reports['PDOB'].'.pdf';
    $pdf->output(['isRemoteEnabled' => true]);
    return $pdf->download($name);
}

public function export(Request $request)
{
   $fileName = 'export.csv';
   $tasks = Report::all();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('Clinic Name','Physician Name','Physician Contact','Patient First Name','Patient Last Name','Patient DOB','Patient Contact','Complaint','Consultation');

        $callback = function() use($tasks, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tasks as $task) {
                $row['CName']  = $task->CName;
                $row['DName']    = $task->DName;
                $row['DContact']  = $task->DContact;
                $row['PFName']  = $task->PFName;
                $row['PLName']  = $task->PLName;
                $row['PDOB']    = $task->PDOB;
                $row['PContact']    = $task->PContact;
                $row['Complaint']  = $task->Complaint;
                $row['Consultation']  = $task->Consultation;

                fputcsv($file, array($row['CName'], $row['DName'], $row['DContact'], $row['PFName'], $row['PLName'], $row['PDOB'], $row['DName'], $row['Complaint'], $row['Consultation']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

public function getlogo() {
	  $rid = $_POST['NameIdValue'];
	  $reports = Report::where('Rid', '=', $rid)->get()->toArray()[0];
      return response()->json(array('logoname'=> $reports['Logo']), 200);
}

use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}