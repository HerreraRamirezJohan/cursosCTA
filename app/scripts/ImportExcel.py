import pandas as pd
from DBareasMerge import DBareasMerge as db

class ImportExcel:
    def __init__(self, file, ciclo) -> None:
        #Variable de horarios los cuales tienen mas de un dia en su horario
        self.newSchedules = pd.DataFrame()
        #Indices de los horarios anteriores
        self.indexNewSchedules = []
        self.ciclo = ciclo
        
        self.df = self.importFromExcelFile(file, ciclo)
        print('Exito.')
        # print(self.df.to_json())
       
        
    def importFromExcelFile(self, file, ciclo):
        # Extraemos el excel que nos devuelve un array de hojas de excel.
        necesaryColumns = ['NRC', 'Departamento', 'Materia', 'Carga Horaria', 'CUP', 'REG', 'Hora', 'Codigo ', 'Aula ', 'Profesores', 'Nivel']
        # dtypes = {'NRC':str, 'Departamento':str, 'Materia':str, 'Carga Horaria':str, 'CUP':str, 'REG':int, 'Hora':str, 'Codigo ':str, 'Aula ':str, 'Profesores':str, 'Nivel':str}
        sheetExcel = pd.read_excel(file, sheet_name='Hoja1', usecols=necesaryColumns, engine='openpyxl')
        # Renombrar las columnas como en la DB
        sheetExcel.columns = ['nrc', 'departamento', 'curso_nombre', 'dia',  'cupo', 'alumnos_registrados','horario', 'area', 'codigo', 'profesor', 'nivel']
        sheetExcel['ciclo'] = ciclo
        #Definimimos columnas
        sheetExcel = self.defineTypeOfColumns(sheetExcel)
        print(f'Registros Totales = {len(sheetExcel)}')
        sheetExcel = self.change_day_value(sheetExcel)
        # print(f'Registros Horarios separados = {len(sheetExcel)}')
        
        # #Una vez limpios los datos realizamos el merge en relacion a las Areas
        # connectionDBAreas = db("localhost", "root", "", "cursos")
        # connectionDBAreas.mergeAreasWhitExcel(dfExcelClean=df)
        
        # print('despues de eliminar y agregar:' + (str)(len(df)))
        
        
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
        df['codigo'] = df['codigo'].apply(lambda x: str(x).replace('.0', '') if pd.notnull(x) else x)

        # Pasar el cupo y alumnos registrados a tipo entero
        df['alumnos_registrados'] = pd.to_numeric(df['alumnos_registrados'], errors='coerce').fillna(0).astype(int)
        df['cupo'] = pd.to_numeric(df['cupo'], errors='coerce').fillna(0).astype(int)

        df[['dia', 'nivel']] = df[['dia', 'nivel']].astype(str)

        # Modificar prefijos a nombre completo de nivel
        df['nivel'] = df['nivel'].apply(self.actualizar_nivel)

        df = self.detect_NaN_rows(df)
        return df
    
    def detect_NaN_rows(self, df):
        NaN_rows = df['nrc'].isna()  # Obtener una máscara booleana de filas con NaN en la columna 'nrc'
        NaN_indices = NaN_rows[NaN_rows].index  # Obtener los índices de las filas con NaN en la columna 'nrc'

        for index in NaN_indices:
            previusRow = df.loc[index - 1]  # Obtener la fila anterior
            self.compare_to_rows(df.loc[index], previusRow, index, df)

        return df

    def compare_to_rows(self, rowNaN, previusRow, index, df):
        # Comparamos ambas filas y eliminamos los valores NaN
        for column in previusRow.index:
            if pd.isna(previusRow[column]) and not pd.isna(rowNaN[column]):
                df.loc[index - 1, column] = rowNaN[column]
            elif pd.isna(rowNaN[column]) and not pd.isna(previusRow[column]):
                df.loc[index, column] = previusRow[column]
            
    def change_day_value(self, df = pd.DataFrame()):
        for index, row in df.iterrows():#Iteramos por cada row del DataFrame para generar los registros y obtener los index a eliminar
            self.had2orMoreSchedule(row, index, df)
        #
        # print('Antes de eliminar: ' + (str)(len(df)))
        #Limpiamos los horarios con (dia > 1)
        df = df.drop(self.indexNewSchedules)
        #Agregamos todos los registros con los dias separados
        df = pd.concat([df, self.newSchedules], ignore_index=True)
        print(f'Registros Horarios separados = {len(self.newSchedules)}')
                
            # print(str(type(row['dia'])) + 'nrc: ' + str(row['nrc']))
            # #Convertimos el codigo del dia a nombre
        for index, row in df.iterrows():
            if 'L' in str(row['dia']):
                df.at[index, 'dia'] = 'lunes'
            if 'M' in str(row['dia']):
                df.at[index, 'dia'] = 'martes'
            if 'I' in str(row['dia']):
                df.at[index, 'dia'] = 'miercoles'
            if 'J' in str(row['dia']):
                df.at[index, 'dia'] = 'jueves'
            if 'V' in str(row['dia']):
                df.at[index, 'dia'] = 'viernes'
            if 'S' in str(row['dia']):
                df.at[index, 'dia'] = 'sabado'     
        return df
               
    def had2orMoreSchedule(self, schedule, index, df = pd.DataFrame()):
        schedules = {
            'lunes' : False,
            'martes': False,
            'miercoles':False,
            'jueves':False,
            'viernes':False,
            'sabado':False,
        }
        #detectamos cuantos dias tiene en el horario
        if 'L' in schedule['dia']: schedules['lunes'] = True
        if 'M' in schedule['dia']: schedules['martes'] = True
        if 'I' in schedule['dia']: schedules['miercoles'] = True
        if 'J' in schedule['dia']: schedules['jueves'] = True
        if 'V' in schedule['dia']: schedules['viernes'] = True
        if 'S' in schedule['dia']: schedules['sabado'] = True
        daysRow=schedule['dia']
        # Averiguamos cuantos dias tiene registrados el curso.
        count = sum(value == True for value in schedules.values())
        
        if(count > 1):
            self.indexNewSchedules.append(index)#guardamos el indice del elemento con (horario > 1)
            newSchedulesOfCourse = pd.DataFrame()
            for day, value in schedules.items():
                if value:
                    selected_row = df.loc[index].copy()
                    selected_row['dia'] = day
                    newSchedulesOfCourse = pd.concat([newSchedulesOfCourse, pd.DataFrame([selected_row])], ignore_index=True)
                    print(f'Tiene los horarios {daysRow} y su array de horarios es: {len(newSchedulesOfCourse)}')
            self.newSchedules = pd.concat([self.newSchedules, newSchedulesOfCourse], ignore_index=True)
    
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


rute = r"C:\PyhonProyects\CleanDataSchedule\Oferta academiaca 4635 cursos.xlsx" 
obj = ImportExcel(rute, '2023B')