<?php

namespace App\Http\Controllers;

use App\Article;
use App\Job;
use App\Job_type;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpParser\Builder;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $articlesQuery = Article::query();//запрос


//        dd(request('tags'));
//        dd($articlesQuery->find(1)->tag_types);

        if ($request->filled('name')) {//если наш запрос имеет name
            $articlesQuery->where('name', 'like', "%$request->name%");

        }

        if ($request->filled('place')) {//если наш запрос имеет place
            $articlesQuery->where('place', 'like', "%$request->place%");
        }

        if ($request->filled('slider')) {//проврека ползунка цены
            $value = explode(',', request('slider'));//разделяет значение , и передает их в массив
            $min = $value[0];
            $max = $value[1];
            $articlesQuery->where('payment', '>=', $min)->where('payment', '<=', $max);
        }

        if($request->has('job_types')) {
            $articlesQuery->whereHas('jobs', function ($jobs) {//обращение к дочерней таблице
                $jobs->whereIn('name', request('job_types'));//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
            });
        }

        if($request->has('tag_types')) {
            $articlesQuery->whereHas('tags', function ($tags) {//обращение к дочерней таблице
                $tags->whereIn('name', request('tag_types'));//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
            });
        }


        if($request->has('category_types')) {
            $articlesQuery->whereHas('categories', function ($category) {//обращение к дочерней таблице
                $category->whereIn('label', request('category_types'));//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
            });
        }



        $articles = $articlesQuery->paginate(4);

        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $jobs = new Job();
        $jobs->name = $request->input('title');
        $jobs->label = $request->input('title');
        $jobs->save();

//        $article = Article::find(2);
//
//        $job = Job::find(10);
//        $article->jobs()->save($job);
//
//        $job->articles()->save($article);


//        $article = Article::find(3);
////        $job = Job::find(4);
//
//        $jobID = $request->job_types;
//        $article->jobs()->attach($jobID);
        return redirect('/articles')->with('success', 'job был добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        $job = $article->jobs->get(0);

//        foreach ($article->jobs as $job){
//            return view('articles.show')->with('article',$article)->with('job',$job);
//        }

        return view('articles.show')->with('article',$article)->with('job',$job);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

//---------------------TRASH----------------------------




//        foreach (['freelance', 'full-time', 'part-time', 'internship', 'temporary'] as $field_job) {
//            if ($request->has($field_job)) {
//
//                dd($field_job);
//                $articlesQuery->whereHas('job_types', function ($job_subsidiary) use($field_job) {//обращение к дочерней таблице
////                    global $field_job;
//                    $job_subsidiary->where($field_job, 'like', 1);//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
//                });
//            }
//        }

//        global $field;//Tag
//            foreach (['front-end', 'angular', 'react', 'vue-js', 'web-apps','design','wordpress'] as $field) {
//                if ($request->has($field)) {
//                    $articlesQuery->whereHas('tags', function ($tag_subsidiary){//обращение к дочерней таблице
//                        global $field;
//                        $tag_subsidiary->where($field, 'like', 1);//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
//                    });
//                }
//            }



//        global $rec;//category
//        global $field_category;
//
//        $rec = $request->category;//помещаем запрос в массив
//            if ($request->filled('category')) {//смотрим передается ли массив
//                foreach ($rec as $field_category) {//перебираем его
//                    $articlesQuery->whereHas('categories', function ($category_subsidiary){
//                        global $field_category;
//                        foreach (['admin-support','customer-service','data-analytics','design-creative','legal','software-developing','it-networking','writing','translation','sales-marketing'] as $same_category){
//                            $category_subsidiary->where($same_category,'like',$field_category);
//                            break;
//                        }
//                    });
//                }
//            }
//        $category_subsidiary->where('admin-support','like','Admin Support');

//            return;

//                foreach (['legal' , 'writing'] as c) {
////                    if ($category->has($field_category)) {
//                        $articlesQuery->whereHas('categories', function ($category_subsidiary) {//обращение к дочерней таблице
//                            global $field_category;
////                        dd($field_category);
//                            $category_subsidiary->where($field_category, 'like', 'legal');//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
//                        });
////                    }
//                }

//        global $i;
//        global $more;
//        $center = array('freelance', 'full-time', 'part-time', 'internship', 'temporary');
//        $more = array();
////        $more == 'freelance';
////        $more == 'internship';
////        return $more;
//        for ($i = 0;$i < count($center);$i++){
//            if ($request->has($center[$i])) {
//
//                $articlesQuery->whereHas('job_types', function ($job_subsidiary) {//обращение к дочерней таблице
//                    global $i;
//                    global $center;
//                    $job_subsidiary->where($center[1], 'like', 1)->orWhere($center[2], 'like', 1);//выбор значений и вывод поста,связанный отношением, из дочерней таблицы
//
//                });
//            }
//            return;
//            }elseif($request->has($center[$i])){
//                $articlesQuery->orWhereHas('job_types', function ($job_subsidiary_1){//обращение к дочерней таблице
//                    global $center;
//                    $job_subsidiary_1->where($center[2], 'like', 1);
//                });
//            }
//        }
//return $more;


//        if ($request->filled('category')) {//если наш запрос имеет category
//            $category = $request->category;
//            if (count($category) <= 1 ){
//                $articlesQuery->where('category', 'like', $category[0]);
//            }else{
//                $articlesQuery->where('category', 'like', $category[0])
//                            ->orWhere('category', 'like', $category[1]);
//            }
//        }


////
////        foreach (['front-end', 'angular', 'react', 'vue-js', 'web-apps','design','wordpress'] as $field) {
////            if ($request->has($field)) {
////                $articlesQuery->where($field, 1);
////            }
////        }
////
////        foreach (['freelance', 'full_time', 'part_time', 'internship', 'temporary'] as $field) {
////            if ($request->has($field)) {
////                $articlesQuery->where($field, 1);
////            }
////        }
////
