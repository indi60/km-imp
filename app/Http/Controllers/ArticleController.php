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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $jobs = Job::all();
        $articles = Article::all();
        return view('article.index', compact('articles', 'jobs', 'countTotalProject', 'countTotalTicket'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $jobs = Job::all();
        $statusArticles = StatusArticle::all();
        return view('article.create', compact('jobs', 'statusArticles', 'countTotalProject', 'countTotalTicket'));
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
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $articles = Article::find($id);
        $jobs = Job::all();
        return view('article.show', compact('articles', 'jobs', 'countTotalProject', 'countTotalTicket'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countTotalProject = Project::all()->count();
        $countTotalTicket = Ticket::all()->count();
        $articles = Article::find($id);
        $jobs = Job::all();
        $statusArticles = StatusArticle::all();
        return view('article.edit', compact('articles', 'jobs', 'statusArticles', 'countTotalProject', 'countTotalTicket'));
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

        $articles = Article::find($id);
        $articles->user_id = auth()->user()->id;
        $articles->job_id = $request->job_id;
        $articles->title = $request->title;
        $articles->content = $request->content;
        $articles->author_name = auth()->user()->name;
        $articles->author_email = auth()->user()->email;
        $articles->status_article_id = $request->status_article_id;
        $articles->update();
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
        $articles = Article::find($id);
        $articles->delete();
        return redirect('/article')->with('statusDelete', 'Data Berhasil Dihapus!');
    }
}
