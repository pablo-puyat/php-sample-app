<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Resources\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new Categories(Category::all());
    }
}
