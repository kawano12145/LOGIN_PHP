import requests
from datetime import datetime

def convert_weather_to_japanese(description):
    
    weather_map = {
        "Clear": "晴れ",
        'Sunny':'晴れ',
        'Partly cloudy':'晴れ時々曇り',
        'Cloudy':'曇り',
        'Overcast':'くもり',
        'Mist':'霧',
        'Patchy rain possible':'時折雨',
        'Patchy snow possible':'時折雪',
        'Patchy sleet possible':'時折みぞれ',
        'Patchy freezing drizzle possible':'時折霧雨',
        'Thundery outbreaks possible':'雷雨の可能性あり',
        'Blowing snow':'吹雪',
        'Blizzard':'吹雪',
        'Fog':'霧',
        'Freezing fog':'凍結霧',
        'Patchy light drizzle':'時折小雨',
        'Light drizzle':'小雨',
        'Freezing drizzle':'凍結霧雨',
        'Heavy freezing drizzle':'激しい凍結霧雨',
        'Patchy light rain':'時折小雨',
        'Light rain':'小雨',
        'Moderate rain at times':'時々中雨',
        'Moderate rain':'中雨',
        'Heavy rain at times':'時々大雨',
        'Heavy rain':'大雨',
        'Light freezing rain':'軽い凍結雨',
        'Moderate or heavy freezing rain':'中程度または大雨の凍結',
        'Patchy light snow':'時折小雪',
        'Light snow':'小雪',
        'Patchy moderate snow':'時折中雪',
        'Moderate snow':'中雪',
        'Patchy heavy snow':'時折大雪',
        'Heavy snow':'大雪',
        'Ice pellets':'アイスペレッツ',
        'Light rain shower':'小雨',
        'Moderate or heavy rain shower':'中程度または大雨',
        'Torrential rain shower':'豪雨',
        'Light sleet showers':'小さなみぞ',
        'Moderate or heavy sleet showers':'中程度または激しいみぞれ',
        'Light snow showers':'小雪',
        'Moderate or heavy snow showers':'中程度または激しい雪',
        'Light showers of ice pellets':'小さなアイスペレッツ',
        'Moderate or heavy showers of ice pellets':'中程度または激しいアイスペレッツ',
        'Patchy light rain with thunder':'ときどき雷雨の小雨',
        'Moderate or heavy rain with thunder':'中程度または激しい雷雨',
        'Patchy light snow with thunder':'ときどき雷の小雪',
        'Moderate or heavy snow with thunder':'中程度または激しい雷雪',
    }
    return weather_map.get(description, description)

    

def lambda_handler(event, context):
    api_key = "1e4b8a2b4f9b4cd9a0d63016232507"
    city = "Tokyo"
    date = datetime.now()
    weather_date = date.strftime("%Y-%m-%d")

    api_url = f"http://api.weatherapi.com/v1/history.json?key={api_key}&q={city}&dt={weather_date}"

    token = "pJZTVcJDbWudz2R0usIi7I4iVVBG5NHGB2tAkc7U4If"
    url = "https://notify-api.line.me/api/notify"

    response = requests.get(api_url)
    data = response.json()

    if (
        data
        and "forecast" in data
        and "forecastday" in data["forecast"]
        and data["forecast"]["forecastday"]
    ):
        AM_weather_description = data["forecast"]["forecastday"][0]["hour"][9]["condition"]["text"]
        PM_weather_description = data["forecast"]["forecastday"][0]["hour"][14]["condition"]["text"]
        PMN_weather_description = data["forecast"]["forecastday"][0]["hour"][20]["condition"]["text"]
        max_temp = data["forecast"]["forecastday"][0]["day"]["maxtemp_c"]
        min_temp = data["forecast"]["forecastday"][0]["day"]["mintemp_c"]

        AM_weather_description_jp = convert_weather_to_japanese(AM_weather_description)
        PM_weather_description_jp = convert_weather_to_japanese(PM_weather_description)
        PMN_weather_description_jp = convert_weather_to_japanese(PMN_weather_description)

        message = f"""
        日付：{weather_date}
        午前の天気（8：00）：{AM_weather_description_jp}
        午後の天（13：00）：{PM_weather_description_jp}
        夜の天気（19：00）：{PMN_weather_description_jp}
        最高気温：{max_temp}℃
        最低気温：{min_temp}℃
        """

        auth = {"Authorization": "Bearer " + token}
        content = {"message": message}
        requests.post(url, headers=auth, data=content)
