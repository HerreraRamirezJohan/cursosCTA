# -*- coding: utf-8 -*-
import pandas as pd
import unicodedata
from DBareasMerge import DBareasMerge as db

class ImportExcel:
    def __init__(self, file, ciclo) -> None:
        self.ciclo = ciclo
        self.df = self.importFromExcelFile(file, ciclo)
        # print('Exito.')
       
        
    def importFromExcelFile(self, file, ciclo):
        # Extraemos el excel que nos devuelve un array de hojas de excel.
        # necesaryColumns = ['NRC', 'Departamento', 'Materia', 'Dia', 'CUP', 'REG', 'Hora', 'Codigo ', 'Aula ', 'Profesores', 'Nivel']
        # dtypes = {'NRC':str, 'Departamento':str, 'Materia':str, 'Carga Horaria':str, 'CUP':str, 'REG':int, 'Hora':str, 'Codigo ':str, 'Aula ':str, 'Profesores':str, 'Nivel':str}
        sheetExcel = pd.read_excel(file, sheet_name='Hoja1', engine='openpyxl', header=None)
        sheetExcel = sheetExcel.drop(0)
        sheetExcel = sheetExcel.drop(sheetExcel.columns[[1, 3, 5, 6, 7, 8, 11, 12, 15, 17, 18, 21]], axis=1)
        # Renombrar las columnas como en la DB
        sheetExcel.columns = ['nrc', 'departamento', 'curso_nombre',  'cupo', 'alumnos_registrados', 'horario', 'dia', 'area', 'codigo', 'profesor', 'nivel']
        sheetExcel['ciclo'] = ciclo
        #Definimimos columnas
        sheetExcel = self.defineTypeOfColumns(sheetExcel)
        sheetExcel = self.change_day_value(sheetExcel)
        # return sheetExcel
        # Exportamos los datos a la base de datos.
        dbConecction = db('localhost', 'root', '', 'sige')
        sheetExcel=dbConecction.mergeAreasWithExcel(sheetExcel)
        # Retornamos el unico en formato dataframe para asignarlo en el constructor
        return sheetExcel
    
    def defineTypeOfColumns(self, df = pd.DataFrame()):
        # Separar la columna 'horario' en 'hora_inicio' y 'hora_final'
        df[['hora_inicio', 'hora_final']] = df['horario'].str.split('-', expand=True)
        # Convertir las columnas 'hora_inicio' y 'hora_final' al formato de tiempo
        df['hora_inicio'] = pd.to_datetime(df['hora_inicio'], format='%H%M').dt.time
        df['hora_final'] = pd.to_datetime(df['hora_final'], format='%H%M').dt.time
        # Eliminar la columna original (no es necesaria)
        df.drop(['horario'], axis=1, inplace=True)

        # Pasamos a str el codigo
        df['codigo'] = df['codigo'].apply(lambda x: str(x).replace('.0', '') if pd.notnull(x) else '')

        # Pasar el cupo y alumnos registrados a tipo entero
        df['alumnos_registrados'] = pd.to_numeric(df['alumnos_registrados'], errors='coerce').fillna(0).astype(int)
        df['cupo'] = pd.to_numeric(df['cupo'], errors='coerce').fillna(0).astype(int)

        df[['dia', 'nivel','area']] = df[['dia', 'nivel','area']].astype(str)

        # Modificar prefijos a nombre completo de nivel
        df['nivel'] = df['nivel'].apply(self.actualizar_nivel)
        df['area'] = df['area'].apply(lambda x: unicodedata.normalize('NFKD', x).encode('ASCII', 'ignore').decode('utf-8'))


        df = self.detect_NaN_rows(df)
        return df
    
    def detect_NaN_rows(self, df = pd.DataFrame()):
        NaN_rows = df['nrc'].isna()  # Obtener una máscara booleana de filas con NaN en la columna 'nrc'
        NaN_indices = NaN_rows[NaN_rows].index  # Obtener los índices de las filas con NaN en la columna 'nrc'

        for index in NaN_indices:
            previusRow = df.loc[index - 1]  # Obtener la fila anterior
            self.compare_to_rows(df.loc[index], previusRow, index, df)

        return df

    def compare_to_rows(self, rowNaN, previusRow, index, df = pd.DataFrame()):
        # Comparamos ambas filas y eliminamos los valores NaN
        # if(previusRow['nrc'] == 56612.0):
        #     print(f"Es nulo la fila actual?: {pd.isna(rowNaN['nivel'])} el valor es: {rowNaN['nivel']}")
        #     print(f"Es nulo la fila anterior?: {pd.isna(previusRow['nivel'])} el valor es: {previusRow['nivel']}")
                            
        for column in previusRow.index:
            if pd.isna(previusRow[column]) and not pd.isna(rowNaN[column]):
                df.loc[index - 1, column] = rowNaN[column]
            elif (pd.isna(rowNaN[column]) and not pd.isna(previusRow[column]) or rowNaN[column] == 'nan' or rowNaN[column] == 0):
                df.loc[index, column] = previusRow[column]
            
    def change_day_value(self, df = pd.DataFrame()):
        #Variable de horarios los cuales tienen mas de un dia en su horario
        newSchedules = pd.DataFrame()
        #Indices de los horarios anteriores
        indexNewSchedules = []
        for index, row in df.iterrows():#Iteramos por cada row del DataFrame para generar los registros y obtener los index a eliminar
            days = self.detect_days(row['dia'])    
            if sum(days.values()) > 1:
                indexNewSchedules.append(index)
                for day, value in days.items():
                    if value:
                        selected_row = df.loc[index].copy()
                        selected_row['dia'] = day # La copia le asignamos el dia correspondiente.
                        newSchedules = pd.concat([newSchedules, pd.DataFrame([selected_row])], ignore_index=True)
            else: # Cambiamos los registros con 1 solo día
                if 'L' in str(row['dia']):
                    df.at[index, 'dia'] = 'lunes'
                elif 'M' in str(row['dia']):
                    df.at[index, 'dia'] = 'martes'
                elif 'I' in str(row['dia']):
                    df.at[index, 'dia'] = 'miercoles'
                elif 'J' in str(row['dia']):
                    df.at[index, 'dia'] = 'jueves'
                elif 'V' in str(row['dia']):
                    df.at[index, 'dia'] = 'viernes'
                elif 'S' in str(row['dia']):
                    df.at[index, 'dia'] = 'sabado'
        #Limpiamos los horarios con (dia > 1)
        df = df.drop(indexNewSchedules)
        #Agregamos todos los registros con los dias separados
        df = pd.concat([df, newSchedules], ignore_index=True)
        return df

            
    #Funcion de validacion para cambiar el valor.
    def actualizar_nivel(self, nivel):
        if 'DO' in nivel:
            return 'doctorado'
        elif 'MA' in nivel:
            return 'maestria'
        elif 'LI' in nivel:
            return 'licenciatura'
        else:
            return nivel
        
    # Funcion de validacion para detectar dias del curso
    def detect_days(self, schedule):
        days = {
            'lunes': 'L' in schedule,
            'martes': 'M' in schedule,
            'miercoles': 'I' in schedule,
            'jueves': 'J' in schedule,
            'viernes': 'V' in schedule,
            'sabado': 'S' in schedule
        }
        return days


# rute2 = r"D:\CTA\Oferta academiaca 4635 cursos.xlsx"
# importExcel = ImportExcel(rute2, '2023A')