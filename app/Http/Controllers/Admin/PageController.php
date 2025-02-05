<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use \App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    public function index()
    {

        $dbPages = Page::paginate(10);

        return view('admin.pages.index', ['pages' => $dbPages]);
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $data = $request->only(['title', 'content']);
        $data['slug'] = Str::slug($data['title'], '-');

        $validator = Validator::make($data, [
            'title' => ['required', 'string', 'max:100'],
            'content' => ['string'],
            'slug' => ['required', 'string', 'max:100', 'unique:pages'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('painel.pages.create')
                ->withErrors($validator)
                ->withInput();
        }

        $newPage = new Page();
        $newPage->title = $data['title'];
        $newPage->slug = $data['slug'];
        $newPage->content = $data['content'];
        $newPage->save();

        return redirect()->route('painel.pages.index');
    }

    public function edit($id)
    {
        $page = Page::find($id);
        if ($page) {
            return view('admin.pages.edit', ['page' => $page]);
        }
        return redirect()->route('painel.pages.index');
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);

        if ($page) {
            $data = $request->only(['title', 'content']);

            if ($page['title'] != $data['title']) {
                $data['slug'] = Str::slug($data['title'], '-');

                $validator = Validator::make($data, [
                    'title' => ['required', 'string', 'max:100'],
                    'content' => ['string'],
                    'slug' => ['required', 'string', 'max:100', 'unique:pages'],
                ]);
            } else {
                $validator = Validator::make($data, [
                    'title' => ['required', 'string', 'max:100'],
                    'content' => ['string'],

                ]);
            }

            if ($validator->fails()) {
                return redirect()->route('painel.pages.edit', ['id' => $id])
                    ->withErrors($validator)
                    ->withInput();
            }

            $page->title = $data['title'];
            $page->content = $data['content'];
            if (!empty($data['slug'])) {
                $page->slug = $data['slug'];
            }

            $page->save();
        }
        return redirect()->route('painel.pages.index');
    }

    public function destroy($id)
    {
        $page = Page::find($id);
        if ($page) {
            $page->delete();
        }
        return redirect()->route('painel.pages.index');
    }
}
