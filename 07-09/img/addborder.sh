#!/bin/bash

# 入力画像のファイル名を引数から取得
input_image="$1"

# 出力ファイル名を生成（入力ファイル名に '-b' を追加）
filename=$(basename "$input_image")
extension="${filename##*.}"
filename="${filename%.*}"
output_image="${filename}-b.${extension}"

# 画像の元のサイズを取得
width=$(identify -format "%w" "$input_image")
height=$(identify -format "%h" "$input_image")

# クロップする新しいサイズを計算（左2px, 上下右各1px削除）
new_width=$((width - 3))
new_height=$((height - 2))

# 一時ファイル名を設定
temp_image="temp.png"

# クロップ操作
convert "$input_image" -crop "${new_width}x${new_height}+2+1" "$temp_image"

# 1ピクセルの黒い枠を付ける
convert "$temp_image" -bordercolor black -border 1 "$output_image"

# 一時ファイルを削除
rm "$temp_image"
