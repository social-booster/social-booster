
<div>
  <h1>ボランティアを募集しています！</h1>
  <hr>
  <strong>{{ $concept->name }}</strong><br>
  <p>{{ $concept->content }}</p>
    <hr>
    <p>上記のコンセプトはメール送信時に”着手率”が最も低かったものです。</p>
    <strong>着手率とは？</strong><br>
    <a target="_blank" href="{{url('/document/priority')}}">着手率の詳細はこちら</a>
    <p>着手率の低さはそのコンセプトが世間の期待の割に進展がないことを表します。</p>
    <h2>やってほしい事！</h2>
    @if ($concept->layer === 5)
    <h3>協力</h3>
    <p><a target="_blank" href="{{url('/concept/'.$concept->id)}}">こちらのコミュニティ</a>の運営に協力してください！
    @endif
    @if ($concept->layer !== 5)
    <h3>投票</h3>
    <p><a target="_blank" href="{{url('/concept/'.$concept->id)}}">こちらのコンセプト</a>
    @endif
    @if ($concept->layer === 4)
    にアクセスして紐付けられている上位のコミュニティのうち、うまくプロジェクトを運営してくれそうなコミュニティに投票してください！</p>
    @elseif ($concept->layer === 3)
    にアクセスして紐付けられている上位のプロジェクトのうち、アイデアを実現してくれそうなプロジェクトに投票してください！</p>
    @elseif ($concept->layer === 2)
    にアクセスして紐付けられている上位のアイデアのうち、ニーズを満たす方向として賛同できるものに投票してください！</p>
    @elseif ($concept->layer === 1)
    にアクセスして紐付けられている上位のニーズのうち、共感するものに投票してください！</p>
    @endif
    <p>投票が集まったコンセプトは表示順位が上がり社会の協力が得やすくなります。</p>
    @if ($concept->layer !== 5)
    <h3>紐付け</h3>
    @endif
    @if ($concept->layer === 4)
    <p>投票できるものがありませんでしたか？その時は貴方がこのプロジェクトの運用に相応しいと思う理想の”コミュニティ”を設立してください！</p>
    @elseif ($concept->layer === 3)
    <p>投票できるものがありませんでしたか？その時は貴方がこのアイデアを実現しうると思う理想の”プロジェクト”を投稿してください！</p>
    @elseif ($concept->layer === 2)
    <p>投票できるものがありませんでしたか？その時は貴方がこのニーズを満たしうると思う理想の”アイデア”を投稿してください！</p>
    @elseif ($concept->layer === 1)
    <p>投票できるものがありませんでしたか？その時は貴方がこのストレスを解決する方向性として理想の”ニーズ”を投稿してください！</p>
    @endif
    @if ($concept->layer !== 5)
    <p>紐付けされたコンセプトは投票候補の一つとなります。</p>
    <a target="_blank" href="{{url('/document/cover')}}">紐付けの詳細はこちら</a>
    @endif
</div>
