<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagController extends Controller
{

    public function index()
    {
        $tags = Tag::paginate(env('PAGINATEION_COUNT'));
        return view('admin.tags.tags')->with([
            'tags' => $tags,
            'showLinks' => true,
        ]);
    }

    public function tagNameExists($tagName)
    {
        $tag = Tag::where(
            'tag',
            '=',
            $tagName
        )->first();
        if (!is_null($tag)) {
            return false;
        } else {
            return true;
        }
    }

    public function store(Request $request)
    {
        dd($request);
        $validate = $request->validate([
            'tag_name' => 'required',
        ]);
        if (!$validate) {
            toastr()->warning('Tag name is required');
        }
        $tagName = $request->input('tag_name');
        if (!$this->tagNameExists($tagName)) {
            toastr()->info('Tag name already exists');
            return redirect()->back();
        }

        $tag = new Tag();
        $tag->tag = $tagName;
        $tag->save();

        toastr()->success('Tag ' . $tag->tag . ' has been added');
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        $validate = $request->validate([
            'tag_id' => 'required',
        ]);
        if (!$validate) {
            toastr()->warning('Tag id is required');
            return redirect()->back();
        }
        $tagId = intval($request->input('tag_id'));
        Tag::destroy($tagId);
        toastr()->success('Tag has been deleted');
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validate = $request->validate([
            'edit_tag_id'   => 'required',
            'tag_name' => 'required',
            'tag_code' => 'required',
        ]);

        if (!$validate) {
            toastr()->warning('Tag name is required');
            return redirect()->back();
        }

        $tagName = $request->input('tag_name');
        $tag_code = $request->input('tag_code');

        if (!($this->tagNameExists($tagName) || $this->tagCodeExists($tag_code))) {
            toastr()->info('The tag already exists');
            return redirect()->back();
        }

        $tagId = intval($request->input('edit_tag_id'));
        $tag = tag::find($tagId);
        $tag->tag_name = $tagName;
        $tag->tag_code = $tag_code;
        $tag->save();
        toastr()->success('Tag has been updated');
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $validate = $request->validate([
            'tag_search' => 'required',
        ]);
        if (!$validate) {
            toastr()->warning('Please enter your search data tag name');
            return redirect()->back();
        }
        $searchtag = $request->input("tag_search");
        $tags = tag::where(
            'tag',
            'LIKE',
            '%' . $searchtag . '%'
        )->get();
        if (count($tags) > 0) {
            return view('admin.tags.tags')->with([
                'tags' => $tags,
                'showLinks'=>false,
            ]);
        }
        toastr()->warning('Nothing found!!!');
        return redirect()->route('tags');
    }
}
