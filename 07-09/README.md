# 第7，8，9章のための実験環境

第7，8，9章で解説したことを，実際に試す方法を紹介する。

WebサーバはApache HTTP Server（以下，**Apache**）を使う。Webサーバ上で動作するプログラムの記述言語は**PHP**とする。

> [!TIP]
> ApacheやPHPは**コンテナ**内で動作させる。ApacheやPHPがうまく動かない場合には，コンテナを破棄してやり直せばよい。コンテナを構築するためのソフトウェアは**Docker**を想定する。作業用のコンピュータに直接インストールするのはDockerだけである。

## Dockerの動作確認

Dockerの動作を確認する。コンテナのための環境構築は，本書の範囲を超えるため，割愛する。

Dockerが動作している状態で，次のコマンドを実行する。（Windowsでは，Windows TerminalかPowerShellを使う。WSLのターミナルも使えるかもしれない。）

```bash
docker run --rm curlimages/curl curl -s http://example.net
```

このコマンドについて補足する。

部分|意味
--|--
`docker run`|コンテナを構築し，実行する。
`--rm`|終了時にコンテナを削除する。
`curlimages/curl`|コンテナのイメージ（テンプレート）。
`curl -s http://example.net`|http://example.net にアクセスしてその結果を表示する（「`-s`」は進行状況を非表示にするためのオプション）。

実行結果は次のとおり。この結果から，コンテナを構築できること，コンテナからのWebにアクセスできることがわかる。

```
（省略）
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

## 実験用コンテナの構築

> [!WARNING]
> この後の作業は，次のコマンドで構築するコンテナ内で行う。コンテナ内での作業の結果は残さない。コンテナは停止時に削除される。

> [!TIP]
> 作業の結果を残したい場合は，VS CodeのDev Containersを使うのが簡単。`docker run`の実行時にオプション`-v`でコンテナのディレクトリにホストのディレクトリをマウントしてもよい（詳細は割愛）。

```bash
docker run --rm -it -p 80:80 -p 3000:3000 ubuntu:24.04
```

このコマンドについて補足する。

部分|意味
--|--
`docker run`|コンテナを構築し，実行する。
`--rm`|終了時にコンテナを削除する。
`-it`|コンテナ内で対話的に作業する。
`-p 80:80`|ホストの80番ポートをコンテナの80番ポートにマッピングする（localhost:80へのアクセスがコンテナの80番ポートへのアクセスになる）。
`-p 3000:3000`|ホストの3000番ポートをコンテナの3000番ポートにマッピングする（localhost:3000へのアクセスがコンテナの3000番ポートへのアクセスになる）。
`ubuntu:24.04`|コンテナのイメージ（テンプレート）。

実行すると，次のようなプロンプトが表示される。`39c41e27367c`の部分はコンテナのIDで，実行するたびに変わる。`#`は管理者（root）であることを表している（一般には危険だが，壊れてよいコンテナだから心配は無用である）。

```bash
root@39c41e27367c:/#
```

コンテナは，`exit`あるいはCtrl-`d`で終了する。Docker DesktopのContainersタブでコンテナを削除してもよい。

終了を試した場合は，もう一度`docker run...`を実行してから先に進む。

ここからはコンテナ内での作業である。

### ソフトウェアのインストール

必要なソフトウェア（Git，Apache，PHP）をインストールする。

```bash
apt-get update && DEBIAN_FRONTEND=noninteractive apt-get install -y curl git apache2 libapache2-mod-php php-mbstring
```

> [!TIP]
> `DEBIAN_FRONTEND=noninteractive`は，インストール時に対話的な質問をしないようにするための設定である。

### サンプルファイルの準備

サンプルファイルをダウンロードして，Webサーバで配信する準備をする。

作業ディレクトリを移動して，このリポジトリをクローンする。

```bash
cd /var/www
git clone https://github.com/taroyabuki/techappweb.git
```

ドキュメントルートを変更する。

```bash
cp html/index.html techappweb/07-09/html/
rm -rf html
ln -s techappweb/07-09/html html
```

Apache起動時の警告を抑制するために，ServerNameを設定する（必須ではない）。

```bash
echo 'ServerName localhost' >> /etc/apache2/apache2.conf
```

## 本編

- [第7章 Webアプリケーションの基礎](07.md)
- [第8章 Webアプリケーションの構築](08.md)
- [第9章 Webアプリケーションのセキュリティ](09.md)
