#!/bin/bash

# Parameters to change
numzip=$1		# nos cambia el id del job.
endpoint='e1f3c916-fca7-4a28-9c60-41b051999cbc' # endpoint del FE
# wsurl='172.17.12.22/ws/calcGridValue.php'
# wsurl='www.upch.edu.pe/wsmods/calcGridValue.php'
wsurl='192.168.122.49:8080/ws/calcGridValue.php'
#wsurl='192.168.0.250/calcGridValue.php'


filename=F1GRI${numzip}
cp grids2calc/image.jpg grids2calc/${filename}.jpg

# METAINFO en JSON
echo "{\"idgrid\": \"${filename}\"}" > grids2calc/meta.inf

# Se comprime el archivo
zip -r grids2calc/${filename}  grids2calc/${filename}.jpg grids2calc/meta.inf
#rm grids2calc/${filename}.jpg
# Aqui se tiene que hacer un select a la DB del FE  y cambiar los datos de las variables GridID y GridImage
echo "curl -F endpointID=${endpoint} -F gridID=${filename} -F gridImage=@${PWD}/grids2calc/${filename}.zip ${wsurl}"

# Se simula el formulario
curl -F endpointID=${endpoint} -F gridID=${filename} -F gridImage=@${PWD}/grids2calc/${filename}.zip ${wsurl}
