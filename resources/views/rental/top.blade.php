@extends('layout')
@section('title', 'レンタル票作成')
@section('content')
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h2>レンタル票作成フォーム</h2>
        <!-- POST通信で値を渡す。渡す先は登録処理を行うstore。onSubmitで確認ウィンドウを表示 -->
        <form method="POST" action="{{ route('store') }}" onSubmit="return checkSubmit()">
          @csrf
            <div class="form-group">
                <label for="title">
                    タイトル
                </label>
                <input
                    id="title"
                    name="title"
                    class="form-control"
                    value="{{ old('title') }}"
                    type="text"
                >
                <!-- タイトルのバリデーションでエラーがあった場合 -->
                @if ($errors->has('title'))
                    <div class="text-danger">
                      <!-- 一番最初に引っかかったエラー内容を返す -->
                        {{ $errors->first('title') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="content">
                    本文
                </label>
                <textarea
                    id="content"
                    name="content"
                    class="form-control"
                    rows="4"
                >{{ old('content') }}</textarea>
                <!-- 内容のバリデーションでエラーがあった場合 -->
                @if ($errors->has('content'))
                    <div class="text-danger">
                      <!-- 一番最初に引っかかったエラー内容を返す -->
                        {{ $errors->first('content') }}
                    </div>
                @endif
            </div>
            <div class="mt-5">
                <a class="btn btn-secondary" href="{{ route('blogs') }}">
                    キャンセル
                </a>
                <button type="submit" class="btn btn-primary">
                    投稿する
                </button>
            </div>
        </form>
    </div>
</div>
<script>
function checkSubmit(){
if(window.confirm('送信してよろしいですか？')){
    return true;
} else {
    return false;
}
}
</script>
@endsection
