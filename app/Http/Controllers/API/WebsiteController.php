<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Website;

class WebsiteController extends BaseController
{
    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:websites,name',
                'url' => 'required|url|unique:websites,url',
            ]);

            $website = Website::create([
                'name' => $request->name,
                'url' => $request->url,
            ]);

            return $this->successResponse($website);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }

    // controller method to handle when users subscribe to a website
    public function subscribe(Request $request, Website $website)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
            ]);

            // Subscribe the user to the website
            $website->subscribers()->create([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            return $this->successResponse([]);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
