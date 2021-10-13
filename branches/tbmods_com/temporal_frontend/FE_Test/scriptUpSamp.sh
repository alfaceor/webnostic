#/bin/bash
# Author: Carlos Olivares
# email: alfaceor@gmail.com
# Script to simultare a form for submit sample

# Parameters to change
numzip=$1					# To change id jod.
cellphone='991234567'	# CellPhone for the sms server.
endpoint='test'			# Front End endpoint.
# wsurl='172.17.12.22/ws/analyzeSample.php'
wsurl='192.168.122.49:8080/ws/analyzeSample.php'

# Variables for the job.
calc_file=F1SAM${numzip}
calc_dir=sams2calc
submit_image=$2
#submit_image='imagesample.jpg'

# Generate zip file
# FIXME
# cp ${calc_dir}/photPosi.jpg ${calc_dir}/${calc_file}.jpg
cp ${calc_dir}/${submit_image} ${calc_dir}/${calc_file}.jpg
# gridValueRandom=1.$RANDOM
gridValueRandom=0.598086 # FIXME: COLOCAR EL VALOR DE CALIBRACION PARA TRUJILLO
# generate json metainfo
echo "{\"idsample\": \"${calc_file}\",\"gridValue\":\"${gridValueRandom}\",\"cellPhoneNumber\":\"${cellphone}\"}" > ${calc_dir}/meta.inf

# Se comprime el archivo
zip -r ${calc_dir}/${calc_file}  ${calc_dir}/${calc_file}.jpg ${calc_dir}/meta.inf
# rm ${calc_dir}/${calc_file}.jpg
# Aqui se tiene que hacer un select a la DB del FE  y cambiar los datos de las variables GridID y GridImage
echo "curl -F endpointID=${endpoint} -F sampleID=${calc_file} -F gridValue=${gridValueRandom} -F cellNumber=${cellphone} -F sampleImage=@${PWD}/${calc_dir}/${calc_file}.zip ${wsurl}"

# Se simula el formulario
curl -F endpointID=${endpoint} \
-F sampleID=${calc_file} \
-F gridValue=${gridValueRandom} \
-F cellNumber=${cellphone} \
-F sampleImage=@${PWD}/${calc_dir}/${calc_file}.zip ${wsurl}

# TODO: escribir en la database

# sampleid, gridvalue,..., diagnostic(0,1), score(), observations
