import pandas as pd
import mysql.connector
import ImportExcel as ie

class DatabaseConnector:
    def __init__(self, host, username, password, database):
        self.host = host
        self.username = username
        self.password = password
        self.database = database
        self.connection = mysql.connector.connect(
            host=self.host,
            user=self.username,
            password=self.password,
            database=self.database
        ) 

    def disconnect(self):
        if self.connection:
            self.connection.close()

    # Genera solo consultas selects
    def executeSelect(self, query):
        cursor = self.connection.cursor()
        cursor.execute(query)
        result = cursor.fetchall()
        cursor.close()
        return result

    # Nos convierte el resultado de nuestra consulta select en un DF
    def get_areas_dataframe(self):
        query = "SELECT id, area FROM areas where (tipo_espacio = 'Aula' OR tipo_espacio = 'Laboratorio') AND activo = 1 AND sede = 'Belenes'"
        result = self.executeSelect(query)
        df = pd.DataFrame(result, columns=["id", "area"])
        df.columns = ["id_area", "area"]
        return df
    
    # Funcion para obtener el id_area en relacion de la columna de area de la base de datos.
    def mergeAreasWhitExcel(self, dfExcelClean):
        connector = DatabaseConnector("localhost", "root", "", "cursos")
        
        dfAreas = connector.get_areas_dataframe()
        # rute1 = r"D:\CTA\CleanExcelSchedule\Oferta academiaca 4635 cursos.xlsx"
        # rute2 = r"C:\PyhonProyects\CleanDataSchedule\Oferta academiaca 4635 cursos.xlsx"
        # importExcel = ie.ImportExcel(rute2)
        # df = importExcel.df 
        dfMergeCompleate = pd.merge(dfExcelClean, dfAreas, on='area', how='inner')
        
        connector.disconnect()
        return dfMergeCompleate

# print(df.columns)
# print('Se mezclaron: ' + str(len(df)) + ' registros.')

# tableCursos = df[['nrc', 'curso_nombre', 'departamento', 'alumnos_registrados', 'cupo', 'nivel', 'profesor', 'codigo']].copy()
# tableCursos.drop_duplicates(subset='nrc', keep='first', inplace=True)
# tableCursos['id'] = range(len(tableCursos))

# def actualizar_nivel(nivel):
#     if 'DO' in nivel:
#         return 'doctorado'
#     elif 'MA' in nivel:
#         return 'maestria'
#     elif 'LI' in nivel:
#         return 'licenciatura'
#     else:
#         return nivel
# #modificar prefijos a nombre completo de nivel
# tableCursos['nivel'] = tableCursos['nivel'].apply(actualizar_nivel)

# def create_HorariosTable(df = pd.DataFrame()):
#     horariosSinhora = df[['id_area', 'nrc', 'dia', 'hora_inicio', 'hora_final']].copy()
#     horariosSinhora = pd.merge(horariosSinhora, tableCursos[['id', 'nrc']], on='nrc', how='inner')
#     horariosSinhora = horariosSinhora.drop(['nrc'], axis=1)
#     horariosSinhora.rename(columns={'id' : 'id_curso'}, inplace=True)
    
#     dfHorariosConHora = pd.DataFrame()
    
#     for index, row in horariosSinhora.iterrows():
                  
#         start = int(row['hora_inicio'].hour)
#         end = int(row['hora_final'].hour)
#         # print('hora_inicio = ' + str(start))
#         # print('hora_final = ' + str(end))
#         while(start <= end):
#             selected_row = row.copy()
#             selected_row['hora'] = start
#             dfHorariosConHora = pd.concat([dfHorariosConHora, pd.DataFrame([selected_row])], ignore_index=True)
#             dfHorariosConHora = dfHorariosConHora.drop(['hora_inicio', 'hora_final'], axis=1)
#             # print('Horka:' + str(start))
#             start+=1
#         # print()
#     return dfHorariosConHora

# tableHorarioNews = create_HorariosTable(df)

# print(tableHorarioNews.columns)
# for index, row in tableHorarioNews.iterrows():
#     print([index, row])
#     id_area = row['id_area']
#     id_curso = row['id_curso'] + 1
#     hora = row['hora']
#     dia = row['dia']

#     # Obtener los valores de las demás columnas que necesites
    
#     # Ejemplo ficticio de update en MySQL
#     cursor = connector.connection.cursor()
#     query = f"UPDATE horarios_news SET id_curso = %s WHERE id_area=%s AND hora=%s AND dia=%s"
#     values = (id_curso, id_area, hora, dia)
#     try:
#         cursor.execute(query, values)
#         connector.connection.commit()
#     except Exception as e:
#         print(f"Error al ejecutar la consulta: {str(e)}")
#     break

# for index, row in tableCursos.iterrows():
#     print([index, row])
#     nrc = row['nrc']
#     curso_nombre = row['curso_nombre']
#     departamento = row['departamento']
#     alumnos_registrados = row['alumnos_registrados']
#     cupo = row['cupo']
#     nivel = None if pd.isna(row['nivel']) else row['nivel']
#     profesor = None if pd.isna(row['profesor']) else row['profesor']
#     codigo = None if pd.isna(row['codigo']) else row['codigo']

#     # Obtener los valores de las demás columnas que necesites
    
#     # Ejemplo ficticio de inserción en MySQL
#     cursor = connector.connection.cursor()
#     query = f"INSERT INTO cursos (nrc, curso_nombre, departamento, alumnos_registrados, cupo, nivel, profesor, codigo) VALUES (%s, %s, %s, %s, %s, %s,%s, %s)"
#     values = (nrc, curso_nombre, departamento, alumnos_registrados, cupo, nivel, profesor, codigo)
#     cursor.execute(query, values)
#     connector.connection.commit()
#     cursor.close()

# print(tableHorarioNews.columns)
# print('Se crearon: ' + str(len(tableHorarioNews)) + ' registros de horarios.')
# tableCursos.to_csv('DataBase/Cursos.csv', index=False, encoding='ISO-8859-1')
# tableHorarioNews.to_csv('DataBase/Horarios.csv', index=False, encoding='ISO-8859-1')