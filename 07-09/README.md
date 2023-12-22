# 第7，8，9章のための実験環境

第7，8，9章で解説したことを，実際に試す方法を紹介する。

<!-- vscode-markdown-toc -->
* [Dockerの動作確認](#Docker)
* [実験用コンテナの構築](#)
	* [サンプルファイルのダウンロード](#-1)
* [本編](#-1)

<!-- vscode-markdown-toc-config
	numbering=false
	autoSave=true
	/vscode-markdown-toc-config -->
<!-- /vscode-markdown-toc -->

WebサーバはApache HTTP Server（以下，**Apache**）を使う。Webサーバ上で動作するプログラムの記述言語は**PHP**とする。

> [!TIP]
> ApacheやPHPは**コンテナ**内で動作させる。ApacheやPHPがうまく動かない場合には，コンテナを破棄してやり直せばよい。コンテナを構築するためのソフトウェアは**Docker**を想定する。作業用のコンピュータに直接インストールするのはDockerだけだから，そのコンピュータが本章のための実践でおかしくなることはないだろう。

## <a name='Docker'></a>Dockerの動作確認

Dockerの動作を確認してから先に進む。コンテナのための環境構築は，本書の範囲を超えるため，割愛する。

次のコマンドを実行する。

```bash
docker run --rm curlimages/curl curl -s http://example.net | tail
```

このコマンドについて補足する。

部分|意味
--|--
`docker run`|コンテナを構築し，実行する。
`--rm`|終了時にコンテナを削除する。
`curlimages/curl`|コンテナのイメージ（テンプレート）。
`curl -s http://example.net`|http://example.net にアクセスしてその結果を表示する（「`-s`」は進行状況を非表示にするためのオプション）。
`\| tail`|結果の最後の10行を表示する。

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

## <a name=''></a>実験用コンテナの構築

> [!IMPORTANT]
> この後の作業は，次のコマンドで構築するコンテナ内で行う。このコマンドは空のフォルダで実行することが望ましい。特に，後で作成するフォルダtechappwebとの重複を避けるため，この名前のファイルやフォルダはあってはいけない。

```bash
docker run --rm -it -v "$(pwd)":/root/host -p 80:80 -p 3000:3000 ubuntu:jammy
```

このコマンドについて補足する。

部分|意味
--|--
`-it`|コンテナ内で対話的に作業する。
`-v "$(pwd)":/root/host`|ホストのカレントディレクトリ（コマンドを実行したフォルダ）をコンテナの/root/hostにマウントする（ホストのフォルダとコンテナのフォルダを同一視する）。
`-p 80:80`|ホストの80番ポートをコンテナの80番ポートにマッピングする（localhost:80へのアクセスがコンテナの80番ポートへのアクセスになる）。
`-p 3000:3000`|ホストの3000番ポートをコンテナの3000番ポートにマッピングする（localhost:3000へのアクセスがコンテナの3000番ポートへのアクセスになる）。
`ubuntu:jammy`|コンテナのイメージ（テンプレート）。

実行すると，次のようなプロンプトが表示される。このプロンプトでコマンドを入力して，実験を進める。`39c41e27367c`の部分はコンテナのIDで，実行するたびに変わる。

```bash
root@39c41e27367c:/#
```

### <a name='-1'></a>サンプルファイルのダウンロード

Gitをインストールして，このリポジトリをクローンする。

```bash
apt update && apt install -y git # Gitをインストールする。
cd /root/host # ホストのカレントディレクトリに移動する。
git clone https://github.com/taroyabuki/techappweb.git # このリポジトリをクローンする。
```

## <a name='-1'></a>本編

- [第7章 Webアプリケーション入門](07.md)
- [第8章 Webアプリケーションの構築](08.md)
- [第9章 Webアプリケーションのセキュリティ](09.md)
