import json
import requests
import html

# データをエスケープして挿入
print('<span class="temple-name">' + html.escape(temple["name"]) + "</span><br>")

# APIのURL
api_url = "http://localhost:8080/API/create_api/Python/API.py"

# APIからデータを取得
response = requests.get(api_url)
data = response.json()

# HTMLの出力
print("<!DOCTYPE html>")
print('<html lang="ja">')
print("<head>")
print('    <meta charset="UTF-8">')
print('    <meta name="viewport" content="width=device-width, initial-scale=1.0">')
print('    <link rel="stylesheet" href="./index.css">')
print("    <title>東京有名な寺院10選</title>")
print("</head>")
print("<body>")
print('    <div class="bg_pattern"></div>')
print('    <div class="container">')
print('        <div class="header">')
print("            <h1>東京の有名な寺院</h1>")
print("        </div>")
print("        <h2>寺院一覧</h2>")
print('        <ul class="temple-list">')

# 寺院のデータを表示
for temple in data["data"]:
    print('            <li class="temple-list-item">')
    print('                <span class="temple-name">' + temple["name"] + "</span><br>")
    print(
        '                <a class="temple-location" href="'
        + temple["url"]
        + '" target="_blank">'
        + temple["location"]
        + "</a>"
    )
    print("            </li>")

print("        </ul>")
print('        <div class="csv">')
print('            <a href="generate_csv.php" class="csv-link">CSV形式出力</a>')
print("        </div>")
print("</body>")
print("</html>")
