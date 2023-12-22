# 第7，8，9章のための実験環境

第7，8，9章で解説したことを，実際に試す方法を紹介する。

[!CAUTION]
ここで紹介する例は，概念を説明するための最低限のものである。セキュリティ上の問題（脆弱性）が存在するため，公開された環境でそのまま使うべきではない。また，HTMLは最低限の要素だけを使う場合がある。HTMLの全体を構文エラーの無いものにすることにはこだわらない。

[!NOTE]
ここでは，WebサーバはApache HTTP Server（以下，**Apache**）を使う。Webサーバ上で動作するプログラムの記述言語は**PHP**とする。

[!TIP]
ApacheやPHPは**コンテナ**内で動作させる。ApacheやPHPがうまく動かない場合には，コンテナを破棄してやり直せばよい。コンテナを構築するためのソフトウェアは**Docker**を想定する。作業用のコンピュータに直接インストールするのはDockerだけだから，そのコンピュータが本章のための実践でおかしくなることはないだろう。

## 実行環境の準備（Docker）

Dockerの動作を確認してから先に進む。コンテナのための環境構築は，本書の範囲を超えるため，割愛する。

次のコマンドを実行する。

```bash
docker run --rm curlimages/curl curl -s http://example.net | tail
```

実行結果は次のとおり。この結果から，コンテナを構築できること，コンテナからのWebにアクセスできることがわかる。

```

<body>
<div>
    <h1>Example Domain</h1>
    <p>This domain is for use in illustrative examples in documents. You may use this
    domain in literature without prior coordination or asking for permission.</p>
    <p><a href="https://www.iana.org/domains/example">More information...</a></p>
</div>
</body>
</html>
```

このコマンドについて補足する。

部分|意味
--|--
`docker run`|コンテナを構築し，実行する。
`--rm`|終了時にコンテナを削除する。
`curlimages/curl`|コンテナのイメージ（テンプレート）。
`curl -s http://example.net`|http://example.net にアクセスしてその結果を表示する（「`-s`」は進行状況を非表示にするためのオプション）。
`\| tail`|結果の最後の10行を表示する。

[!IMPORTANT]
この後の作業は，次のコマンドで構築するコンテナ内で行う。

```bash
docker run --rm -it -v "$(pwd)":/var/www/html -p 80:80 -p 3000:3000 ubuntu:jammy
```

このコマンドについて補足する。

部分|意味
--|--
`-it`|コンテナ内で対話的に作業する。
`-v "$(pwd)":/var/www/html`|ホストのカレントディレクトリ（コマンドを実行したフォルダ）をコンテナの/var/www/htmlにマウントする（ホストのフォルダとコンテナのフォルダを同一視する）。
`-p 80:80`|ホストの80番ポートをコンテナの80番ポートにマッピングする（localhost:80へのアクセスがコンテナの80番ポートへのアクセスになる）。
`-p 3000:3000`|ホストの3000番ポートをコンテナの3000番ポートにマッピングする（localhost:3000へのアクセスがコンテナの3000番ポートへのアクセスになる）。
`ubuntu:jammy`|コンテナのイメージ（テンプレート）。
