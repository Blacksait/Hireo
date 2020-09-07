<?php

namespace App\Http\Controllers;

use App\Vacancy;
use App\Article;
use App\Job;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd(request());

        $this->validate($request,[
           'name' => 'required|max:40',
           'title' => 'required|max:60',
           'place' => 'required|max:60',
           'payment' => 'required|max:60',
           'logo' => 'nullable|image|max:1999'
        ]);

        if ($request->hasFile('logo')){
            $file = $request->file('logo')->getClientOriginalName();//находим имя файла с разрешением
            $img_name_without_ext = pathinfo($file,PATHINFO_FILENAME);//удалаяем разрешение,получаем название файла
            $ext = $request->file('logo')->getClientOriginalExtension();//получаем разрешение
            $logo = $img_name_without_ext ."_".time().".".$ext;
            $path = $request->file('logo')->storeAs('public/images', $logo);//произвел php artisan storage:link
        }else{
            $logo = 'company-logo-05.png';
        }

        $articles = new Article();
        $articles->name = $request->input('name');
        $articles->title = $request->input('title');
        $articles->place = $request->input('place');
        $articles->logo = $logo;
        $articles->payment = $request->input('payment');
        $articles->verified = $request->input('verified');

        $articles->save();



        $article = Article::first();



        $jobID = $request->job_types;//находим id job
        $articles->jobs()->attach($jobID);//приравниваем к артиклу



        $categoriesID = $request->category_types;//находим id job
        $articles->categories()->attach($categoriesID);//приравниваем к артиклу

        $tagID = $request->tag_types;//находим id job
        $articles->tags()->attach($tagID);//приравниваем к артиклу

//        $job->articles()->save($article); ЭТО НАДО?

        return redirect('/articles')->with('success', 'articles был добавлен');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function edit(Vacancy $vacancy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vacancy $vacancy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vacancy  $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        //
    }

}

//         ----------TRASH----------


//        $article = Article::find(3);//находим id нужного Article
//        $job = Job::find($request->input('id'));
////        $job = $request->job_types;//находим id нужного job
//
//
//        $article->jobs()->save($job);//сохраняем связь
//        $job->articles()->save($article);//сохраняем связь
//        $articles->id = $request->input('name');
//        $art = get_resource_id($articles);
