@extends('commons.template')

@section('content')
<h1 class="text-center py-3">口コミ情報の修正画面</h1>

<form action="{{ route('posts.update', $post) }}" method="post" id="post-form">
    @csrf
    @method('PUT')
    <table class="w-100">
        <tr>
            <td style="width:100px" class="text-center">口コミ名</td>
            <td><input type="text" name="poster_name" class="form-control w-50" value="{{old('poster_name', $post->poster_name)}}" required></td>
        </tr>
        <tr>
            <td class="text-center">タイトル</td>
            <td><input type="text" name="title" class="form-control w-50" value="{{old('title', $post->title)}}" required></td>
        </tr>
        <tr>
            <td class="text-center">感想</td>
            <td><textarea name="content" class="form-control" rows="3"  required>{{old('content', $post->content)}}</textarea></td>
        </tr>
        <tr>
            <td class="text-center">評価</td>
            <td>
                <dl>
                    <dd class="pt-3">
                        
                            <select name="value" size="1" class="">
                                <option value="1" @if(old('value',$post->value)==1)selected @endif>★</option>
                                <option value="2" @if(old('value',$post->value)==2)selected @endif>★★</option>
                                <option value="3" @if(old('value',$post->value)==3)selected @endif>★★★</option>
                                <option value="4" @if(old('value',$post->value)==4)selected @endif>★★★★</option>
                                <option value="5" @if(old('value',$post->value)==5)selected @endif>★★★★★</option> 
                            </select>
                    </dd>
                </dl>
            </td>
        </tr>
    </table>
    <button type="submit" class="btn btn-primary d-block mx-auto">更新</button>
</form>    
@endsection