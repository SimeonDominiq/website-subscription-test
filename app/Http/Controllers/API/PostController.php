<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use \App\Models\Post;
use App\Models\Website;

class PostController extends BaseController
{
    public function create(Request $request, Website $website)
    {
        try {
            // Validate the request data
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
            ]);

            $post = $website->posts()->create([
                'title' => $request->post('title'),
                'description' => $request->post('description'),
            ]);

            return $this->successResponse($post);
        } catch (\Exception $e) {
            return $this->exceptionResponse($e);
        }
    }
}
