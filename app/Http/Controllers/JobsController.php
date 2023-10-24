<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class JobsController extends Controller
{
    //

    public function index() {
        return Job::latest()->paginate();
    }

    public function show($id) {
        return Job::find($id);
    }
    // Lưu trữ job
    public function store() {
        $validated = request()->validate([
            'title' => 'required',
            'bussiness_account_id' => 'required',
            'end_date' => 'required|after:today',
        ]);

        Job::create($validated);

        Toast::info('Job created successfully');
    }
    // update job
    public function update($id) {
        $validated = request()->validate([
            'title' => 'required',
            'bussiness_account_id' => 'required',
            'end_date' => 'required|after:created_at',
        ]);

        Job::find($id)->update($validated);

        Toast::info('Job updated successfully');
    }
    // xóa job
    public function destroy($id) {
        Job::find($id)->delete();

        Toast::info('Job deleted successfully');
    }

}
