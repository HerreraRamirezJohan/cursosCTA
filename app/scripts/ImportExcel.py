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
        sheetExcel = pd.read_excel(file, sheet_name=None, engine='openpyxl')
        dataframes = [df for _, df in sheetExcel.items()]
        # Obtenemos las columnas que nos interesa
        df = dataframes[0]
        df = df.drop(['ST', 'Clave', 'Carga Horaria', 'Unnamed: 6', 'Sec', 'CR', 'DIS', 'Seccion ', 'Unnamed: 21', 'Periodo ', 'Sec.1'], axis=1)
        # Renombrar las columnas como en la DB 
        df.columns = ['nrc', 'departamento', 'curso_nombre', 'cupo', 'alumnos_registrados', 'horario', 'dia', df.columns[7], 'area', 'codigo', 'profesor', 'nivel']
        df['ciclo'] = ciclo
        #Definimimos columnas
        df = self.defineTypeOfColumns(df)
        df = self.change_day_value(df)
        
        #Una vez limpios los datos realizamos el merge en relacion a las Areas
        connectionDBAreas = db("localhost", "root", "", "sige")
        connectionDBAreas.mergeAreasWithExcel(dfExcelClean=df)
        
        # print('despues de eliminar y agregar:' + (str)(len(df)))
        
        
        # Retornamos el unico en formato dataframe para asignarlo en el constructor
        return df
    
    def defineTypeOfColumns(self, df = pd.DataFrame()):
        # Separar la columna 'horario' en 'hora_inicio' y 'hora_final'
        df[['hora_inicio', 'hora_final']] = df['horario'].str.split('-', expand=True)
        # Convertir las columnas 'hora_inicio' y 'hora_final' al formato de tiempo
        df['hora_inicio'] = pd.to_datetime(df['hora_inicio'], format='%H%M').dt.time
        df['hora_final'] = pd.to_datetime(df['hora_final'], format='%H%M').dt.time
        #eliminamos la columna orginal (no es necesaria)
        df = df.drop(['horario'], axis=1)
        
        # Convertir la columna 'nrc' a int para no tener decimales, nan o SIN CRN dejando los datos originales en X
        df['nrc'] = df['nrc'].astype(object)
        df['nrc'] = df['nrc'].apply(lambda x: str(int(x)) if not pd.isna(x) and x != 'SIN CRN' else x)
        #Pasar el cupo y alumnos registrados a tipo entero
        df['alumnos_registrados'] = df['alumnos_registrados'].apply(lambda x: int(x) if pd.notna(x) and pd.notnull(x) else None)
        df['cupo'] = df['cupo'].apply(lambda x: int(x) if pd.notna(x) and pd.notnull(x) else None)
        
        df['dia'] = df['dia'].astype(str)
        
        #Definimos el dato de nivel a los datos que recive la DB
        df['nivel'] = df['nivel'].astype(str)
        #modificar prefijos a nombre completo de nivel
        df['nivel'] = df['nivel'].apply(self.actualizar_nivel)
        
        df = self.detect_NaN_rows(df)
        return df
    
    def detect_NaN_rows(self, df = pd.DataFrame()):
        for index, row in df.iterrows():#Iteramos por cada row del DataFrame
            if(pd.isna(row['nrc'])):#Detectamos una row con NRC en NaN o Null
                df = self.compare_to_rows(row, df.loc[index-1], index, df)
        return df
                
    def compare_to_rows(self, rowNaN, previusRow, index, df = pd.DataFrame()):
        #comparamos ambas con la row superir la cual siempre sera el nrc de la nan
        #Comparamos y eliminamos todos los valores NaN
        for column in previusRow.index:
            if(pd.isna(previusRow[column]) ):
                if not(pd.isna(rowNaN[column])):
                    df.loc[index-1, column] = rowNaN[column]
            else:
                if(pd.isna(rowNaN[column]) ):
                    df.loc[index, column] = previusRow[column]
        return df
            
    def change_day_value(self, df = pd.DataFrame()):
        for index, row in df.iterrows():#Iteramos por cada row del DataFrame para generar los registros y obtener los index a eliminar
            self.had2orMoreSchedule(row, index, df)
        #
        # print('Antes de eliminar: ' + (str)(len(df)))
        #Limpiamos los horarios con (dia > 1)
        df = df.drop(self.indexNewSchedules)
        #Agregamos todos los registros con los dias separados
        df = pd.concat([df, self.newSchedules], ignore_index=True)
                
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


# rute2 = r"D:\CTA\Oferta academiaca 4635 cursos.xlsx"
# importExcel = ImportExcel(rute2, '2023A')