import json

import pandas as pd

excel_file_path = './resources/assets/timetable.xlsx'

df = pd.read_excel(excel_file_path)

df.to_csv('timetable.csv', index=True)

timetable = []

start = 0
columns_names = []
for index, row in df.iterrows():
    if 'LECTURER' in row.values:
        start = index + 1
        columns_names = row.values
        break

for j in range(len(columns_names)):
    if 'lecturer' in str(columns_names[j].lower()):
        columns_names[j] = 'lecturer_name'

    elif all(substring in str(columns_names[j].lower()) for substring in ('course', 'code', 'title')):
        columns_names[j] = 'course_code|course_name'

    elif 'credit' in str(columns_names[j].lower()):
        columns_names[j] = 'credit_hours'

    elif 'day' in str(columns_names[j].lower()):
        columns_names[j] = 'day'

df = pd.read_excel(excel_file_path, skiprows=start)

for index, row in df.iterrows():
    if isinstance(row.values[0], str):
        data = {}
        for i in range(len(columns_names)):
            if all(substring in str(row.values[i]) for substring in (':', '-')):
                timings = row.values[i].split()
                data['time_start'] = timings[0]
                data['time_end'] = timings[-1]

            elif 'course_code|course_name' in str(columns_names[i]):
                course = row.values[i].split()
                data['course_code'] = course[0] + course[1]
                data['course_name'] = " ".join(course[2:])

            else:
                data[columns_names[i].lower()] = row.values[i]

        timetable.append(data)
with open('./timetable.json', 'w') as json_file:
    json.dump(timetable, json_file, indent=4)
