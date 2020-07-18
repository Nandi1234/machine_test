<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Subscribers;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function addFile(Request $request)
    {
        if ($request->hasFile('attachment')) {
            $attachName = Str::uuid().'.'.request()->attachment->getClientOriginalExtension();
            request()->attachment->move(public_path('attach'), $attachName);
            
            $filePath = public_path() . "/attach/".$attachName;
        $sheet = IOFactory::load($filePath);
        $workSheet = $sheet->getActiveSheet();
        
        $rows = [];        
        foreach ($workSheet->getRowIterator() as $row) { // looping through all the rows
            $celIterator = $row->getCellIterator();
            $cells = [];
            foreach ($celIterator as $cell) { // looping through all the columns/cells
                $cells[] = $cell->getValue();
            }
            $rows[] = $cells;
        }
        // dd($rows);
        // creating array to perform mass insertion
        $items = [];
        foreach ($rows as $row) {
            if (filter_var($row[1], FILTER_VALIDATE_EMAIL)) {
                Subscribers::create([
                    'name'=>$row[0],
                    'email'=> $row[1]
                ]);
              }
            
        }

        
        }

        dd("Data Added Sucessfully");
    }
}
