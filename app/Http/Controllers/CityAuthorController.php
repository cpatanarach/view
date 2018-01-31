<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use App\LinkData;
use App\CityAuthor;
use Illuminate\Http\Request;


class CityAuthorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index($linkdata_id)
    {
        $linkData = LinkData::findOrFail($linkdata_id);
        if(!empty($linkData->city->newCityAdmin || Auth::user()->level >= ADMIN)){
            if(Auth::user()->level >= ADMIN || $linkData->city->newCityAdmin->user->id == Auth::user()->id){
                return view('link.author.index')->with('linkData', $linkData);
            }else{
                return view('error404');
            }
        }else{
            return view('error404');
        }
    }
    public function store(Request $request)
    {
        $linkData = LinkData::findOrFail($request->ref);
        $input = $request->all();
        if(!empty($linkData->city->newCityAdmin || Auth::user()->level >= ADMIN)){
            $validate = $this->validateInput($request->all());
            if($validate->passes()){
                $author = new CityAuthor();
                $author->name = $input['name'];
                $author->linkdata_id = $linkData->id;
                $author->type = $input['type'];
                $author->number = $input['number'.$input['type']];
                $author->save();
                return redirect()->back()->with('success', '1');
            }else{
                return redirect()->back()->withErrors($validate)->withInput();
            }
        }else{
            return view('error404');
        }
    }

    public function show(CityAuthor $cityAuthor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CityAuthor  $cityAuthor
     * @return \Illuminate\Http\Response
     */
    public function edit($author_id){
        $author = CityAuthor::findOrFail($author_id);
        if(!empty($author->linkData->city->newCityAdmin || Auth::user()->level >= ADMIN)){
            return view('link.author.edit')->with('author', $author);
        }else{
            return view('error404');
        }
    }
    public function update(Request $request){
        $author = CityAuthor::findOrFail($request->ref);
        if(!empty($author->linkData->city->newCityAdmin || Auth::user()->level >= ADMIN)){
            $validate = $this->validateInput($request->all());
            if($validate->passes()){
                $input = $request->all();
                $author->name = $input['name'];
                $author->type = $input['type'];
                $author->number = $input['number'.$input['type']];
                $author->save();
                return redirect()->back()->with('success', '1');
            }else{
                return redirect()->back()->withErrors($validate)->withInput();
            }
        }else{
            return view('error404');
        }
    }
    public function destroy($linkdata_id , $author_id){
        $linkData = LinkData::findOrFail($linkdata_id);
        if(!empty($linkData->city->newCityAdmin || Auth::user()->level >= ADMIN)){
            $author = CityAuthor::findOrFail($author_id);
            $author->delete();
            return redirect()->back()->with('deleted','1');
        }else{
            return view('error404');
        }
    }
    protected function validateInput(array $data){
        $min = 6;
        if($data['type'] == 1 || $data['type'] == 2){
            $min += 5;
        }else if($data['type'] == 3){
            $min += 6;
        }
        return Validator::make($data, [
            'name' => 'required|max:255|unique:city_authors,name,'.$data['ref'],
            'type' => 'required|numeric|max:255',
            'number'.$data['type'] => 'required|min:'.$min.'|max:'.$min,
        ],[
            'name.unique' => 'มีข้อมูลอยู่ในระบบแล้ว',
        ]);
    }
}
