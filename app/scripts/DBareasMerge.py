# -*- coding: utf-8 -*-

import pandas as pd
import numpy as np
from response import response
import json


import mysql.connector

class DBareasMerge:
    def __init__(self, host, username, password, database):
        self.response = response()
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
        # Eliminar el carácter "-" de la columna "area"
        dfExcelClean['area'] = dfExcelClean['area'].str.replace('-', ' ')
        dfMergeCompleate = pd.merge(dfExcelClean, dfAreas, on='area', how='inner')
        dfMergeCompleate['nrc'] = dfMergeCompleate['nrc'].astype(str).replace('\.0', '', regex=True)
        # print(f"Cursos con merge y dias duplicados: {len(dfMergeCompleate)}")
        tableCursos = self.create_CursosTable(dfMergeCompleate)
        self.response.setCursosImportados(len(tableCursos))
        # print(f"Cursos unicos: {len(tableCursos)}")
        tableCursos['profesor'] = tableCursos['profesor'].fillna(value='')
        
        #exportar cursos
        data = tableCursos[['nrc', 'curso_nombre', 'departamento', 'alumnos_registrados', 'cupo', 'ciclo' , 'nivel', 'profesor' ,'codigo']].values.tolist()
        # print(f"Registros del query: {len(data)}")
        query = "INSERT INTO cursos (nrc, curso_nombre, departamento, alumnos_registrados, cupo, ciclo , nivel, profesor ,codigo) VALUES (%s, %s, %s, %s, %s, %s,%s, %s, %s)"
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
        
        # Convertir id_nrc_array en un DataFrame
        df_id_nrc = pd.DataFrame(id_nrc_array, columns=['id_curso', 'nrc'])
        dfIdCursos = pd.merge(dfMergeCompleate, df_id_nrc, on='nrc', how='inner')
        dfHorarios = self.create_HorariosTable(dfIdCursos)
        
        #exportar horarios
        dataHorario = dfHorarios[['id_curso', 'id_area', 'dia', 'hora']].values.tolist()
        query = "UPDATE horarios_news SET id_curso = %s, status = 1 WHERE id_area=%s and dia=%s and hora=%s"
        
        cursor = self.connection.cursor()
        # Insertar los registros en lotes
        batch_size = 500
        for i in range(0, len(dataHorario), batch_size):
            batch = dataHorario[i:i+batch_size]
            cursor.executemany(query, batch)
            self.connection.commit()

        # Cerrar la conexión
        cursor.close()
        
        # Obtener las áreas relacionadas
        areas_relacionadas = dfMergeCompleate['area'].unique().tolist()
    
        # Obtener las áreas no relacionadas
        areas_no_relacionadas = set(dfExcelClean['area']) - set(areas_relacionadas)
        areas_no_relacionadas.discard(float('nan'))
        areas_no_relacionadas.discard(None)
        

        # Imprimir las áreas relacionadas en formato JSON
        # print("areas relacionadas:")
        self.response.setAreasReg(areas_relacionadas)
        self.response.setAreasOcup(list(areas_no_relacionadas))

        self.response.printJSON()
        # print(json.dumps(areas_relacionadas))

        # Imprimir las áreas no relacionadas en formato JSON
        # print("areas no relacionadas:")
        # print(json.dumps(list(areas_no_relacionadas)))

        
        self.disconnect()
                
        return dfHorarios
        

# print(df.columns)
# print('Se mezclaron: ' + str(len(df)) + ' registros.')

    def create_CursosTable(self, df = pd.DataFrame()):
        tableCursos = df.copy()
        #Eliminamos los registros duplicados en nrc para solo obtener los cursos unicos
        tableCursos.drop_duplicates(subset='nrc', keep='first', inplace=True)
        
        return tableCursos
        


    def create_HorariosTable(self, df=pd.DataFrame()):
        # Generar un rango de horas para cada fila y convertir a enteros
        # df['hora'] = df.apply(lambda row: list(range(int(row['hora_inicio'].hour), int(row['hora_final'].hour + 1 ))), axis=1).astype(object)
        df['hora'] = df.apply(lambda row: list(range(int(row['hora_inicio'].hour), int(row['hora_final'].hour))) if int(row['hora_final'].minute) == 0 else list(range(int(row['hora_inicio'].hour), int(row['hora_final'].hour +1))), axis=1).astype(object)
        # df['hora'] = df.apply(lambda row: (print(True) or list(range(int(row['hora_inicio'].hour), int(row['hora_final'].hour + 1)))) if int(row['hora_final'].minute) == 0 else (print(False) or list(range(int(row['hora_inicio'].hour), int(row['hora_final'].hour)))), axis=1).astype(object)
        # Explotar la columna 'hora' solo si es una lista
        dfHorariosConHora = df.explode('hora', ignore_index=True) if isinstance(df['hora'].iloc[0], list) else df.copy()

        # Limpiar valores no finitos (NaN o infinito) en la columna 'hora'
        dfHorariosConHora = dfHorariosConHora.dropna(subset=['hora']).replace([np.inf, -np.inf], np.nan)

        # Convertir los valores de 'hora' a enteros
        dfHorariosConHora['hora'] = dfHorariosConHora['hora'].astype(float).astype(int)
        # print(f"Registros de horarios: {len(dfHorariosConHora)}")

        # print(dfHorariosConHora['hora'].sample(10))
        # return 
        return dfHorariosConHora.drop(['hora_inicio', 'hora_final'], axis=1)