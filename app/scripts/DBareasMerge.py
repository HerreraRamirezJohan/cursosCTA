import pandas as pd
import numpy as np

import mysql.connector

class DBareasMerge:
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
        
        self.cursosTable = pd.DataFrame()
        self.horariosTable = pd.DataFrame()

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
    def mergeAreasWithExcel(self, dfExcelClean = pd.DataFrame()):
        dfAreas = self.get_areas_dataframe()
        dfMergeCompleate = pd.merge(dfExcelClean, dfAreas, on='area', how='inner')
        tableCursos = self.create_CursosTable(dfMergeCompleate)
        
        tableCursos['profesor'] = tableCursos['profesor'].fillna(value='')
        tableCursos['nrc'] = tableCursos['nrc'].astype(str).replace('\.0', '', regex=True)


        # tableCursos = tableCursos.fillna(value=None)
        # return tableCursos
        # print(f'Cursos Unicos: {len(tableCursos)}')
        
        #exportar cursos
        data = tableCursos[['nrc', 'curso_nombre', 'departamento', 'alumnos_registrados', 'cupo', 'ciclo' , 'nivel', 'profesor' ,'codigo']].values.tolist()
        query = "INSERT INTO cursos (nrc, curso_nombre, departamento, alumnos_registrados, cupo, nivel, profesor, codigo, ciclo) VALUES (%s, %s, %s, %s, %s, %s,%s, %s, %s)"
        # Array para almacenar los IDs y correos electrónicos generados
        id_nrc_array = []
        
        cursor = self.connection.cursor()
        # Insertar los registros en lotes
        batch_size = 1000
        for i in range(0, len(data), batch_size):
            batch = data[i:i+batch_size]
            cursor.executemany(query, batch)
            self.connection.commit()
            
            # Obtener los IDs y correos electrónicos generados
            last_insert_id = cursor.lastrowid
            generated_nrc = [row[0] for row in batch]
            
            # Almacenar los pares de ID y correo electrónico en el array
            id_nrc_array.extend(zip(range(last_insert_id, last_insert_id + len(batch)), generated_nrc))

        # Cerrar la conexión
        cursor.close()

        # Imprimir los pares de ID y correo electrónico
        # for id, nrc in id_nrc_array:
        #     print(f"ID: {id}, Email: {nrc}")
        
        # Convertir id_nrc_array en un DataFrame
        df_id_nrc = pd.DataFrame(id_nrc_array, columns=['id_curso', 'nrc'])
        dfIdCursos = pd.merge(tableCursos, df_id_nrc, on='nrc', how='inner')
        dfHorarios = self.create_HorariosTable(dfIdCursos)
        
        #exportar horarios
        dataHorario = dfHorarios[['id_curso', 'id_area', 'dia', 'hora']].values.tolist()
        query = "INSERT INTO horarios_news (id_curso, id_area, dia, hora) VALUES (%s, %s, %s, %s)"
        
        cursor = self.connection.cursor()
        # Insertar los registros en lotes
        batch_size = 500
        for i in range(0, len(dataHorario), batch_size):
            batch = dataHorario[i:i+batch_size]
            cursor.executemany(query, batch)
            self.connection.commit()

        # Cerrar la conexión
        cursor.close()
        
        self.disconnect()
        return
        # Obtener las áreas relacionadas
        areas_relacionadas = dfMergeCompleate['area'].unique().tolist()
    
        # Obtener las áreas no relacionadas
        areas_no_relacionadas = set(dfExcelClean['area']) - set(areas_relacionadas)
        
        # # Imprimir las áreas relacionadas
        # print("areas relacionadas:")
        # print('<br>')
        # for area in areas_relacionadas:
        #     print(area)
        #     print('<br>')
        
        # # Imprimir las áreas no relacionadas
        # print("areas no relacionadas:")
        # print('<br>')
        # for area in areas_no_relacionadas:
        #     print(area)
        #     print('<br>')
        
        #Asignamos el DF completo al realizar el merge
        df = dfMergeCompleate
        # self.cursosTable = self.create_CursosTable(df)
        # self.horariosTable = self.create_HorariosTable(df)
        self.exportCursosAndHorarios(df)
        print('Cursos exportados')
        
        self.disconnect()
        

# print(df.columns)
# print('Se mezclaron: ' + str(len(df)) + ' registros.')

    def create_CursosTable(self, df = pd.DataFrame()):
        tableCursos = df.copy()
        #Eliminamos los registros duplicados en nrc para solo obtener los cursos unicos
        tableCursos.drop_duplicates(subset='nrc', keep='first', inplace=True)
        
        return tableCursos
        

    def create_HorariosTable(self, df = pd.DataFrame()):
        df.rename(columns={'id' : 'id_curso'}, inplace=True)
        
        dfHorariosConHora = pd.DataFrame()
        
        for index, row in df.iterrows():
                    
            start = int(row['hora_inicio'].hour)
            end = row['hora_final'].hour if row['hora_final'].minute != 0 else row['hora_final'].hour - 1
            # print('hora_inicio = ' + str(start))
            # print('hora_final = ' + str(end))
            while(start <= end):
                selected_row = row.copy()
                selected_row['hora'] = start
                dfHorariosConHora = pd.concat([dfHorariosConHora, pd.DataFrame([selected_row])], ignore_index=True)
                dfHorariosConHora = dfHorariosConHora.drop(['hora_inicio', 'hora_final'], axis=1)
                # print('Horka:' + str(start))
                start+=1
            # print()
        return dfHorariosConHora

    # def exportCursosAndHorarios(self, tablaCursos = pd.DataFrame()):
    #     nrcs = []
    #     for index, row in tablaCursos.iterrows():
    #         # print([index, row])
    #         nrc = row['nrc']
    #         id_curso = None
    #         if not nrc in nrcs:
    #             nrcs.append(nrc) 
    #             curso_nombre = row['curso_nombre']
    #             departamento = row['departamento']
    #             alumnos_registrados = row['alumnos_registrados']
    #             cupo = row.get('cupo')
    #             ciclo = row.get('ciclo')
    #             nivel = row.get('nivel')
    #             profesor = row.get('profesor')
    #             codigo = row.get('codigo')
                
    #             # Ejemplo de inserción en MySQL
    #             cursor = self.connection.cursor()
    #             query = f"INSERT INTO cursos (nrc, curso_nombre, departamento, alumnos_registrados, cupo, nivel, profesor, codigo, ciclo) VALUES (%s, %s, %s, %s, %s, %s,%s, %s, %s)"
    #             values = (nrc, curso_nombre, departamento, alumnos_registrados, cupo, nivel, profesor, codigo, ciclo)
    #             cursor.execute(query, values)
    #             self.connection.commit()
                
    #             # Obtener el ID del curso insertado
    #             id_curso = cursor.lastrowid
                
    #             cursor.close()            
    #         # Datos necesarios para generar los N registros por N horas de la duracion del curso
    #         start = row['hora_inicio'].hour
    #         end = row['hora_final'].hour if row['hora_final'].minute != 0 else row['hora_final'].hour - 1
    #         # Datos a exportar a horarios
    #         id_area = row['id_area']
    #         dia = row['dia']

            
    #         while(start <= end):
    #             # Ejemplo de update en MySQL
    #             cursor = self.connection.cursor()
    #             query = f"UPDATE horarios_news SET id_curso = %s, status=1 WHERE id_area=%s AND hora=%s AND dia=%s"
    #             values = (id_curso, id_area, start, dia)
    #             start+=1
    #             try:
    #                 cursor.execute(query, values)
    #                 self.connection.commit()
    #             except Exception as e:
    #                 print(f"Error al ejecutar la consulta: {str(e)}")
    #             cursor.close()
        
# tableHorarioNews = create_HorariosTable(df)

# print(tableHorarioNews.columns)
# for index, row in tableHorarioNews.iterrows():
#     print([index, row])
#     id_area = row['id_area']
#     id_curso = row['id_curso'] + 1
#     hora = row['hora']
#     dia = row['dia']

#     # Obtener los valores de las demás columnas que necesites
    
#     # Ejemplo de update en MySQL
#     cursor = connector.connection.cursor()
#     query = f"UPDATE horarios_news SET id_curso = %s WHERE id_area=%s AND hora=%s AND dia=%s"
#     values = (id_curso, id_area, hora, dia)
#     try:
#         cursor.execute(query, values)
#         connector.connection.commit()
#     except Exception as e:
#         print(f"Error al ejecutar la consulta: {str(e)}")
#     break



# print(tableHorarioNews.columns)
# print('Se crearon: ' + str(len(tableHorarioNews)) + ' registros de horarios.')
# tableCursos.to_csv('DataBase/Cursos.csv', index=False, encoding='ISO-8859-1')
# tableHorarioNews.to_csv('DataBase/Horarios.csv', index=False, encoding='ISO-8859-1')