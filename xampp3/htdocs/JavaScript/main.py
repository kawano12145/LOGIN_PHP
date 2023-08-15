def calculate_years_notSchool(age, schoolYears):
    years_notSchool = age - schoolYears
    return years_notSchool


age = 27
schoolYears = 16

years_notSchool = calculate_years_notSchool(age, schoolYears)

print("学校に行かなかった年数:", years_notSchool, "年")
