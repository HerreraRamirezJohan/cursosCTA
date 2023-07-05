import tkinter as tk
from tkinter import ttk
import ImportExcel as ie

# Función para filtrar los datos en la tabla según el valor de entrada
def filter_table():
    search_value = search_entry.get().strip()
    if search_value:
        filtered_data = df[df['nrc'].astype(str).str.contains(search_value)]
    else:
        filtered_data = df.copy()
    
    # Limpiar la tabla
    table.delete(*table.get_children())
    
    # Agregar los datos filtrados a la tabla
    for index, row in filtered_data.iterrows():
        values = tuple(row.values)
        table.insert("", "end", values=values)

# Crear la ventana principal
window = tk.Tk()
window.title("Tabla con Tkinter")

# Crear el contenedor para la tabla y las barras de desplazamiento
frame = tk.Frame(window)
frame.pack(expand=False)

# Llenar table con el dataframe
rute1 = r"D:\CTA\CleanExcelSchedule\Oferta academiaca 4635 cursos.xlsx"
rute2 = r"C:\PyhonProyects\CleanDataSchedule\Oferta academiaca 4635 cursos.xlsx"
importExcel = ie.ImportExcel(rute2, '2023A')
df = importExcel.df
print(f"Registros en horarios news: {len(df)}")

# Crear la tabla
table = ttk.Treeview(frame)

# Definir las columnas de la tabla
columns = df.columns.tolist()
table["columns"] = tuple(columns)

# Configurar las columnas de la tabla
for column in columns:
    table.heading(column, text=column)

# Agregar los datos del DataFrame a la tabla
for index, row in df.iterrows():
    values = tuple(row.values)
    table.insert("", "end", values=values)

# Colocar la tabla y las barras de desplazamiento en el contenedor
table.pack(expand=True)

# Crear el campo de entrada (input) para filtrar
search_entry = tk.Entry(window)
search_entry.pack(pady=10)

# Configurar una función de retorno de tecla para filtrar automáticamente mientras se escribe
search_entry.bind("<KeyRelease>", lambda event: filter_table())

# Ejecutar el bucle principal de la interfaz
window.mainloop()
