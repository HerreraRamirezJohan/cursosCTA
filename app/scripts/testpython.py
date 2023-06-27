import sys
from ImportExcel import ImportExcel

file = sys.argv[1]
ciclo = sys.argv[2]
data = ImportExcel(file, ciclo)
