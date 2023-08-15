import requests
from datetime import datetime, timedelta


def convert_weather_to_japanese(description):
    weather_map = {
        "Sunny": "晴れ",
        "Partly cloudy": "晴れ時々曇り",
        "Cloudy": "曇り",
        "Overcast": "くもり",
    }
    return weather_map.get(description, description)


api_key = "1e4b8a2b4f9b4cd9a0d63016232507"
city = "Tokyo"
api_url = f"http://api.weatherapi.com/v1/history.json?key={api_key}&q={city}&dt="

print("東京の５日間の気象情報：\n")

# ５日前から今日までの天気と気温を表示
for i in range(5):
    date = datetime.now() - timedelta(days=i)
    weather_date = date.strftime("%Y-%m-%d")

    # APIからデータを取得
    response = requests.get(api_url + weather_date)
    data = response.json()

    # 日付が今日以前の場合に表示
    if (
        data
        and "forecast" in data
        and "forecastday" in data["forecast"]
        and data["forecast"]["forecastday"]
    ):
        weather_description = data["forecast"]["forecastday"][0]["day"]["condition"][
            "text"
        ]
        max_temp = data["forecast"]["forecastday"][0]["day"]["maxtemp_c"]
        min_temp = data["forecast"]["forecastday"][0]["day"]["mintemp_c"]

        # 天気の日本語表現に変換
        weather_description_jp = convert_weather_to_japanese(weather_description)

        print(f"日付: {weather_date}")
        print(f"天気: {weather_description_jp}")
        print(f"最高気温: {max_temp}℃")
        print(f"最低気温: {min_temp}℃\n")
    else:
        print(f"日付: {weather_date}")
        print("データが取得できませんでした\n")
