# -*- coding: utf-8 -*-

import json

class response:
    def __init__(self, errors=None, areasReg = None, areasOcup=None):
        self.cursosImportados = None
        self.errors = errors
        self.areasReg = areasReg
        self.areasOcup = areasOcup
    def setErrors(self, error):
        self.errors.append(error) 
    def setAreasReg(self, areasReg):
        self.areasReg = areasReg 
    def setAreasOcup(self, areasOcup):
        self.areasOcup = areasOcup   
        
    def setCursosImportados(self, n):
        self.cursosImportados = n    
        
    def printJSON(self):
        responseJSON = {}
        
        # Obtener los resultados de los prints
        resultado_1 = json.dumps(self.errors)
        resultado_2 = json.dumps(self.areasReg)
        resultado_3 = json.dumps(self.areasOcup)
        resultado_4 = json.dumps(self.cursosImportados)
        

        # Crear un diccionario con ambos resultados
        resultados = {
            "errores": resultado_1,
            "areasRegistradas": resultado_2,
            "areasOcupadas": resultado_3,
            "cursosImportados": resultado_4,
        }

        # Convertir el diccionario en JSON
        resultado_json = json.dumps(resultados)
        # Retornar el JSON
        print(resultado_json)
        
        # responseJSON.append(self.errors)
        # responseJSON.append(self.areasReg)
        # responseJSON.append(self.areasOcup)
        
        # print(responseJSON, end="")
        
# objresponse = response(['error1', 'error2'], ['FBA 1', 'FBA 2'], ['FBA 3', 'FBA 4'])
# objresponse.printJSON()