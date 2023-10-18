import requests
import csv

# JSONデータを再度取得
api_url = "http://localhost:8080/API/create_api/Python/API.py"
response = requests.get(api_url)
data = response.json()

# ヘッダーを設定してCSVファイルをダウンロードさせる
headers = {
    "Content-Type": "text/csv",
    "Content-Disposition": 'attachment; filename="temple_data.csv"',
}

# CSVデータを出力
csv_data = []
csv_data.append(["name", "location", "url"])
for temple in data["data"]:
    csv_data.append([temple["name"], temple["location"], temple["url"]])

# CSVファイルを作成
with open("temple_data.csv", "w", newline="") as csv_file:
    csv_writer = csv.writer(csv_file)
    csv_writer.writerows(csv_data)
