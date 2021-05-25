{{-- 宿アカウントのトップページ(プラン一覧) --}}
@extends('commons.template')

    @section('content')
        <h2 class="mb-3 pt-3">◇プラン一覧</h2>

    <table class="table table-bordered">
        <thead  class="thead-dark">
            <tr class="pd-2">
                <th>プランID</th>
                <th>プラン名</th>
                <th>価格</th>
                <th>プラン説明</th>
                <th>部屋数</th>
                <th>プラン開始時期</th>
                <th>プラン終了時期</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($plans as $plan)
                <tr v-for="(user,index) in users" v-bind:key="index">
                    <td>{{$plan->id}}</td>
                    <td>{{$plan->name}}</td>
                    <td>{{$plan->price}}</td>
                    <td>{{$plan->description}}</td>
                    <td>{{$plan->room}}</td>
                    <td>{{$plan->started_at}}</td>
                     <td>{{$plan->ended_at}}</td>
                    <td>
                        <div class="form-row">
                            <button><a href="{{route('plans.edit', $plan)}}">変更</a></button>
                            <form method="post" action="{{route('plans.destroy', $plan)}}">
                                @csrf
                                @method('delete')
                                    <button class="btn btn-danger">削除
                                                
                                    </button>
                            </form>
                            </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection