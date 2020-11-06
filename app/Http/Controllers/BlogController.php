<?php

//namespace とは？
namespace App\Http\Controllers;



//ここが大事。何ができるようになるかなど詳しくはもう少し後で
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Http\Requests\BlogRequest;

//extends で　LaravelのControllerを呼び出している。ここに書くのは拡張するものだけ。
class BlogController extends Controller
{
    /**
    *ブログ一覧を表示する
    *@param int $id
    *@return view
    */

    public function showList(){

        $blogs = Blog::all();

        //dd($blogs);

        return view('blog.list', ['blogs' => $blogs]);
      //view('resources/blog/list')という意味になる
      //ドットは階層の区切りを表す
    }

    public function showDetail($id){

        $blog = Blog::find($id);

        if (is_null($blog)){
        //
        //   // sessionの作成
          \Session::flash('err_msg', 'データがありません。');
        //   //エイリアスを利用してリダイレクト
          return redirect(route('blogs'));
        }

        return view('blog.detail', ['blog' => $blog]);
    }


    /**
    *ブログ一覧を表示する
    *
    *@return view
    */

    public function showCreate() {
        return view('blog.form');
    }

    /**
    *ブログを登録する
    *
    *@return view
    */

    public function exeStore(BlogRequest $request) {
      // 入力内容を受け取る
      $inputs = $request->all();

      \DB::beginTransaction();

      try{
        // ブログを登録
        Blog::create($inputs);
        \DB::commit();
      } catch(\Throwable $e) {
        \DB::rollback();
        // 500errorのエラーページに飛ばす。ほんとはここでエラーログを取るとよい。
        abort(500);
      }

      \Session::flash('err_msg', 'ブログを登録しました。');
      return redirect(route('blogs'));

    }


    /**
    *ブログを編集フォームを表示する
    *
    *@return view
    */

    public function showEdit($id){

        $blog = Blog::find($id);

        if (is_null($blog)){
        //
        //   // sessionの作成
          \Session::flash('err_msg', 'データがありません。');
        //   //エイリアスを利用してリダイレクト
          return redirect(route('blogs'));
        }

        return view('blog.edit', ['blog' => $blog]);
    }

    /**
    *ブログを更新する
    *
    *@return view
    */

    public function exeUpdate(BlogRequest $request) {
      // 入力内容を受け取る
      $inputs = $request->all();

      \DB::beginTransaction();

      try{
        // ブログを更新
        $blog = Blog::find($inputs['id']);
        $blog->fill([
          'title' => $inputs['title'],
          'content' => $inputs['content'],
        ]);
        $blog->save();
        \DB::commit();
      } catch(\Throwable $e) {
        \DB::rollback();
        // 500errorのエラーページに飛ばす。ほんとはここでエラーログを取るとよい。
        abort(500);
      }

      \Session::flash('err_msg', 'ブログを更新しました。');
      return redirect(route('blogs'));

    }



    /**
    *ブログを削除
    */

    public function exeDelete($id){

      if (empty($id)){
        // sessionの作成
        \Session::flash('err_msg', 'データがありません。');
        //エイリアスを利用してリダイレクト
        return redirect(route('blogs'));
      }

      try{
        // ブログを削除
        $blog = Blog::destroy($id);
      } catch(\Throwable $e) {
        // 500errorのエラーページに飛ばす。ほんとはここでエラーログを取るとよい。
        abort(500);
      }

      \Session::flash('err_msg', 'ブログを削除しました。');
      return redirect(route('blogs'));
    }

}
