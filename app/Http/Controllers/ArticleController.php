<?php

namespace App\Http\Controllers;

use App\Article;
use App\Job;
use App\Project;
use App\StatusArticle;
use App\Ticket;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Jobs = Job::all();
        $Articles = Article::all();
        return view('article.index', compact('Articles', 'Jobs', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Jobs = Job::all();
        $StatusArticles = StatusArticle::all();
        return view('article.create', compact('Jobs', 'StatusArticles', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'job_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
            'status_article_id' => 'required',
        ]);
        Article::create($request->all());
        return redirect('/article')->with('status', 'Data ' . $request->title . ' Berhasil Ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Articles = Article::find($id);
        $Jobs = Job::all();
        return view('article.show', compact('Articles', 'Jobs', 'count_total_project', 'count_total_tiket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count_total_project = Project::all()->count();
        $count_total_tiket = Ticket::all()->count();
        $Articles = Article::find($id);
        $Jobs = Job::all();
        $StatusArticles = StatusArticle::all();
        return view('article.edit', compact('Articles', 'Jobs', 'StatusArticles', 'count_total_project', 'count_total_tiket'));
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
        $request->validate([
            'user_id' => 'required',
            'job_id' => 'required',
            'title' => 'required',
            'content' => 'required',
            'author_name' => 'required',
            'author_email' => 'required',
            'status_article_id' => 'required',
        ]);

        $Articles = Article::find($id);
        $Articles->user_id = auth()->user()->id;
        $Articles->job_id = $request->job_id;
        $Articles->title = $request->title;
        $Articles->content = $request->content;
        $Articles->author_name = auth()->user()->name;
        $Articles->author_email = auth()->user()->email;
        $Articles->status_article_id = $request->status_article_id;
        $Articles->update();
        return redirect('/article')->with('status', 'Data ' . $request->title . ' Berhasil Diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Articles = Article::find($id);
        $Articles->delete();
        return redirect('/article')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
}
