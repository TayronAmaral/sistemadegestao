<?php

namespace App\Http\Controllers;

use OwenIt\Auditing\Models\Audit;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        $audits = Audit::latest()->paginate(10);
        return view('audits.index', compact('audits'));
    }

    public function show($id)
    {
        $audit = Audit::findOrFail($id);
        return view('audits.show', compact('audit'));
    }
}
